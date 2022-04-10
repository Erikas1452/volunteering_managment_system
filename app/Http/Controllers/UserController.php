<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Image;

class UserController extends Controller
{
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
                return redirect()->route('volunteering');
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
}
