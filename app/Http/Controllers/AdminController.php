<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Organization;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
      if(Auth::guard('admin')->check()){

        $user = User::paginate(3);//->paginate(3);

        if(count($user) > 0){
            $data = array(
                'users' => $user,
            );
            return view('admin.dashboard')->with(compact('data'));
        }
          return view('admin.dashboard')->with();
      }
      else return view('admin.login');
    }

    public function organizations(){
        if(Auth::guard('admin')->check()){
  
          $organization = Organization::paginate(3);//->paginate(3);
  
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
