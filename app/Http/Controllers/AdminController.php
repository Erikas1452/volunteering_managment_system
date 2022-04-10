<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
      return view('admin.dashboard');
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
