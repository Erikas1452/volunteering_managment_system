<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Organization;
use Session;
use Image;


class OrganizationController extends Controller
{

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
            'message' => 'Užsiregistruota sėkmingai',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
