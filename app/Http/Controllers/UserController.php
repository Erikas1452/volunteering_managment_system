<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('home');
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if($user) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($credentials)) {
                return redirect()->route('volunteering');
            } else {
                return redirect()->back()->with('status', 'Invalid credentials!');
            } 
        } else {
        return redirect()->back()->with('status', 'Not found!');
        }
    }

    public function registerVolunteer(Request $request){
        $request->validate([
            'full_name' => ['required', 'email'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        User::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('home');
    }
}
