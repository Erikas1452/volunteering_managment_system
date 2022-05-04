<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\VolunteeringActivities;
use App\Models\RegistrationForm;
use App\Models\Category;
use App\Models\ExtraQuestions;
use App\Models\Organization;
use Carbon\Carbon;
use Session;
use Image;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
  


class UserController extends Controller
{

    public function viewActivity($activity_id){
        $activity = VolunteeringActivities::with('category')->where('id', $activity_id)->get();
        $questions = VolunteeringActivities::find($activity_id)->questions;
        $organization = Organization::where('id', $activity[0]->organization_id)->get();
        
        $data = array(
            'activity' => $activity,
            'questions' => $questions,
            'organization' => $organization,
        );

        return view('volunteer.volunteer-view-activity')->with(compact('data'));
    }

    public function filterCategory($category_id)
    {
        $activities = VolunteeringActivities::with('category')->where('category_id',$category_id)->get();//->paginate(3);
        $categories = Category::get();

        if ($activities->isEmpty()){
                $data = array(
                'categories' => $categories,
            );
        }
        else{
            $activities = VolunteeringActivities::with('category')->where('category_id',$category_id)->paginate(8);
            $data = array(
                'activities' => $activities,
                'categories' => $categories,
            );
        }
        return view('volunteer/volunteering')->with(compact('data'));
    }

    public function volunteering(){
        $activities = VolunteeringActivities::with('category')->paginate(8);//->paginate(3);
        $categories = Category::get();
        $data = array(
            'activities' => $activities,
            'categories' => $categories,
        );
        return view('volunteer/volunteering')->with(compact('data'));
    }

    public function myVolunteerings(){

        $activities = VolunteeringActivities::with('category')->get();//->paginate(3);
        $categories = Category::get();
        $registeredActivities = [];

        foreach ($activities as $act){
            $form = RegistrationForm::where('activity_id', $act->id)
                                ->where('volunteer_id', Auth::guard('web')->user()->id)
                                ->get();
            if(!$form->isEmpty()) array_push($registeredActivities,$act);
        }

        $registeredActivities = $this->paginate($registeredActivities);

        $data = array(
            'activities' => $registeredActivities,
            'categories' => $categories,
        );

        return view('volunteer/volunteer-my-activities')->with(compact('data'));
    }

    public function search(Request $request){
        $search_word = $request->search_word;
        $activities = VolunteeringActivities::with('category')->where('name','LIKE','%'.$search_word.'%')->orWhere('short_desc','LIKE','%'.$search_word.'%')->paginate(8);//->paginate(3);
        $categories = Category::get();
        if(count($activities) > 0){
            $data = array(
                'activities' => $activities,
                'search_word' => $search_word,
                'categories' => $categories,
            );
            return view('volunteer/volunteering')->with(compact('data'));
        } else {
            $data = array(
                'message' => 'Nieko nepavyko rasti',
                'categories' => $categories,
            );
            return view('volunteer/volunteering')->with(compact('data'));
        }
    }

    public function search2(){
        $activities = VolunteeringActivities::with('category')->paginate(8);//->paginate(3);
        $categories = Category::get();
        $data = array(
            'activities' => $activities,
            'categories' => $categories,
        );
        return view('volunteer/volunteering')->with(compact('data'));
    }


    public function logout()
    {
        Session::flush();
        
        auth('web')->logout();

        return redirect()->route('home');
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if(!$user) return redirect()->back()->with('email','Neteisingas el.pašto adresas');

        if($user) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::guard('web')->attempt($credentials)) {

                if(isset($user->suspended)){
                  if(Carbon::createFromFormat('Y-m-d', $user->suspended)->gte(Carbon::now())){
                    Session::flush();
    
                    auth('web')->logout();

                    $notification = array(
                        'message' => 'Jūsų vartotojo profilis sustabdytas',
                        'alert-type' => 'warning'
                    );

                    return redirect()->route('home')->with($notification);
                    }
                    else{
                        $notification = array(
                            'message' => Carbon::parse($user->date),
                            'alert-type' => 'warning'
                        );
                        return redirect()->route('volunteering')->with($notification);
                    }  
                } else {
                    return redirect()->route('volunteering');
                }
            } else {
                return redirect()->back()->with('password', 'Neteisingas slaptažodis');
            } 
        } else {
        return redirect()->back()->with('status', 'Not found!');
        }
    }

    public function registerVolunteer(Request $request){
        $request->validate([
            'full_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
            'profile_img' => "https://bootdey.com/img/Content/avatar/avatar7.png",
        ]);

        $notification = array(
            'message' => 'Užsiregistruota sėkmingai',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
    }

    public function updateVolunteerPhoto(Request $request)
    {
        $old_img = $request->old_image;

        $image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(300,300)->save('uploads/profile_pictures/'.$name_gen);
    	$save_url = 'uploads/profile_pictures/'.$name_gen;

        $user = User::findOrFail(Auth::user()->id)->update([
            'profile_img' => $save_url,
        ]);

        return redirect()->back();
    }

    public function updateVolunteer(Request $request){

        // $request->validate([
        //     'full_name' => ['required'],
        // ]);

        $user = User::findOrFail(Auth::user()->id)->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'full_name' => $request->full_name,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
