<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\OrganizationRequests;
use App\Models\VolunteeringActivities;
use App\Models\ActivityLog;
use App\Models\VolunteersLog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginData;
use App\Mail\denied;
use File;
use Session;
use Image;


class OrganizationController extends Controller
{

    public function activitiesHistory(){
        $activities = ActivityLog::sortable()->where('organization_id',Auth::guard('organization')->user()->id)->paginate(10);//->paginate(3);
        if(count($activities) > 0){
            $data = array(
                'activities' => $activities,
            );
            return view('company.company-dashboard-history')->with(compact('data'));
        }
        else return view('company.company-dashboard-history');
    }

    public function activitiesHistoryVoluteers($id){
        $volunteers = VolunteersLog::sortable()->where('activity_log_id', $id)->paginate(20);
        if(count($volunteers) > 0){
            $data = array(
                'volunteers' => $volunteers,
            );
            return view('company.company-dashboard-history-volunteers')->with(compact('data'));
        }
        else return view('company.company-dashboard-history-volunteers');
    }

    public function dashboardActivitiesHandle()
    {
        $activities = VolunteeringActivities::sortable()->with('category')->where('organization_id',Auth::guard('organization')->user()->id)->paginate(10);
        if(count($activities) > 0){
            $data = array(
                'activities' => $activities,
            );
            return view('company.company-dashboard-activities-handle')->with(compact('data'));
        }
        else return view('company.company-dashboard-activities-handle');   
    }

    public function logout()
    {
        Session::flush();
        
        auth('organization')->logout();

        return redirect()->route('company.login');
    }

    public function createActivityPage(){
        $category = Category::orderBy('category_name_en')->get();
        $data = array(
            'categories' => $category,
        );
        return view('company.company-dashboard-create-activity')->with(compact('data'));
    }

    public function dashboardActivities(){
        $activities = VolunteeringActivities::sortable()->with('category')->where('organization_id',Auth::guard('organization')->user()->id)->paginate(10);//->paginate(3);
        if(count($activities) > 0){
            $data = array(
                'activities' => $activities,
            );
            return view('company.company-dashboard-activities')->with(compact('data'));
        }
        else return view('company.company-dashboard-activities');
    }

    public function login(){
        return view('company.company-login');
    }

    public function dashboard(){
        return view('company.company-dashboard');
    }

    public function authenticate(Request $request){
        $user = Organization::where('email',$request->email)->first();

        if(!$user) return redirect()->back()->with('email','Neteisingas el.pa??to adresas');

        if($user) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::guard('organization')->attempt($credentials)) {
                    $notification = array(
                        'message' => 'Prisijungta s??kmingai',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('company.dashboard')->with($notification);
            }else {
                return redirect()->back()->with('password', 'Neteisingas slapta??odis');
            } 
        } else {
        return redirect()->back()->with('status', 'Not found!');
        }
    }

    public function companyRequest(){
        return view('company.company-register');
    }

    public function companyPage(){
        return view('company.company-page');
    }

    public function registerOrganization(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:organizations'],
        ]);

        $password = Str::random(12);

        Organization::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($password),
            'profile_img' => "https://bootdey.com/img/Content/avatar/avatar7.png",
        ]);

        $notification = array(
            'message' => 'U??siregistruota s??kmingai',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function organizationRequests(){
        if(Auth::guard('admin')->check()){

            $requests = OrganizationRequests::paginate(10);//->paginate(3);
                if(count($requests) > 0){
                    $data = array(
                        'requests' => $requests,
                    );
                    return view('admin.dashboard-organization-requests')->with(compact('data'));
                }
            return view('admin.dashboard-organization-requests');
        }
        else return view('admin.login');
    }

    public function downloadFile($path){

        $file = Storage::disk('public')->get($path);

        return Storage::download('public/'.$path, $path);
    }

    public function confirmRequest($email){

        $password = Str::random(12);

        $request = OrganizationRequests::where('email',$email)->first();

        Organization::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($password),
            'profile_img' => "https://bootdey.com/img/Content/avatar/avatar7.png",
        ]);

        $notification = array(
            'message' => 'U??siregistruota s??kmingai',
            'alert-type' => 'success'
        );

        Mail::to($email)->send(new loginData($email, $password));
        $request->delete();
        return redirect()->back()->with($notification);
    }

    public function denyRequest($email){
        Mail::to($email)->send(new denied());
        $request = OrganizationRequests::where('email',$email)->first();
        $request->delete();

        $notification = array(
            'message' => 'U??klausa at??aukta s??kmingai',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function companyRequestCreate(Request $request){
        // $request->validate([
        //     'name' => ['required'],
        //     'email' => ['required', 'email', 'unique:organization_requests'],
        //     'phone' => ['required'],
        //     'address' => ['required'],
        //     'file_upload' => ['required'],
        // ]);


        $file = $request->file('upload_file');

        if ($file->getClientMimeType() !== 'application/pdf')
        {
            $notification = array(
                'message' => 'Netinkamas dokumento formatas',
                'alert-type' => 'warning'
            );
            return "Netinkamas formatas";
            return redirect()->back()->with($notification);
        }

        $extension= $request->file("upload_file")->getClientOriginalExtension();
        $name_gen= hexdec(uniqid()).'.'.$extension;
        $FileEnconded=File::get($request->file('upload_file'));
        Storage::disk('local')->put('public/Paper'.$name_gen, $FileEnconded);

        OrganizationRequests::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'file_upload_path' => 'Paper'.$name_gen,
        ]);
        $notification = array(
            'message' => 'Registracijos u??klausa i??si??sta s??kmingai',
            'alert-type' => 'success'
        );
        return redirect()->route('company.main')->with($notification);
    }
}
