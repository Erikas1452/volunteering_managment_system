<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Organization;
use App\Models\Category;
use App\Models\SystemBadges;
use Carbon\Carbon;
use Image;
use Session;

class AdminController extends Controller
{

    public function badgeView(){
        if(auth::guard('admin')->check()){
            $badges = SystemBadges::latest()->get();
            return view('admin.dashboard-badges', compact('badges'));
        }
        else return view('admin.login');
    }

    public function createBadge(Request $request){
        print_r($request->all());

        $title = $request->title;
        $image = $request->file('upload_file');

        $allowedMimeTypes = ['jpeg','png','jpg'];
        $contentType = $image->getClientOriginalExtension();

        if(! in_array($contentType, $allowedMimeTypes) ) return response('Įkeltas failas nėra tinkamo formato');
        

    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(200,200)->save('uploads/profile_pictures/'.$name_gen);
    	$save_url = 'uploads/profile_pictures/'.$name_gen;

        SystemBadges::insert([
            'title' => $title,
            'img_path' => $save_url,
        ]);

        $notification = array(
			'message' => 'Pagyrimo ženkliupkas sukurtas sėkmingai',
			'alert-type' => 'success'
		);

        return redirect()->back()->with($notification);
    }

    public function deleteBadge($id){
        
    }

    public function categories(){
        if(auth::guard('admin')->check()){
            $category = Category::latest()->get();
            return view('admin.dashboard-categories', compact('category'));
        }
        else return view('admin.login');
    }

    public function volunteers(){
      if(Auth::guard('admin')->check()){

        $user = User::paginate(10);//->paginate(3);

        if(count($user) > 0){
            $data = array(
                'users' => $user,
            );
            return view('admin.dashboard-volunteers')->with(compact('data'));
        }
          return view('admin.dashboard-volunteers')->with();
      }
      else return view('admin.login');
    }

    public function removeSuspension(Request $request){
        $userID = $request->user;
        $user = User::findOrFail($userID);

        $user->suspended = null;
        $user->suspension_reason = null;
        $user->save();

        $response = "Vartotojo paskyra".$userID." nebėra stabdoma";

        return $response;
    }

    public function suspendVolunteer(Request $request){

        $userID = $request->user;
        $reason = $request->reason;

        $dateformat = Carbon::parse($request->date);
        $date = $dateformat->format('Y-m-d');

        $user = User::findOrFail($userID);

        $user->suspended = $date;
        $user->suspension_reason = $reason;
        $user->save();

        $response = "Vartotojo paskyra: ".$userID." sustabdyta iki: ".$date;

        return $response;
    }

    public function dashboard(){
        if(Auth::guard('admin')->check()){
            return view('admin.dashboard');
        }
        else return redirect()->route('admin.login');
    }

    public function deleteOrganization($id){
        Organization::findOrFail($id)->delete();
    	$notification = array(
			'message' => 'Organizacija pašalinta sėkmingai',
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);
    }

    public function organizations(){
        if(Auth::guard('admin')->check()){
  
          $organization = Organization::paginate(10);//->paginate(3);
  
          if(count($organization) > 0){
              $data = array(
                  'organizations' => $organization,
              );
              return view('admin.dashboard-organizations')->with(compact('data'));
          }
            return view('admin.dashboard-organizations')->with();
        }
        else return view('admin.login');
      }

    public function registerOrganizationPage()
    {
        return view('admin.register-organization');
    }

    public function logout()
    {
        Session::flush();
        
        auth('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function authenticate(Request $request)
    {
        $admin = Admin::where('email',$request->email)->first();

        if(!$admin) return redirect()->back()->with('email','Neteisingas el.pašto adresas');

        if($admin) {

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('password', 'Neteisingas slaptažodis');
            } 
        } else {
        return redirect()->back()->with('status', 'Not found!');
        }
    }

    public function registerAdmin(){
        Admin::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        $notification = array(
            'message' => 'Užsiregistruota sėkmingai',
            'alert-type' => 'success'
        );
    }
}
