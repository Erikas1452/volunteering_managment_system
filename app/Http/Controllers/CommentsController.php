<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\OrganizationRequests;
use App\Models\VolunteeringActivities;
use App\Models\Category;
use App\Models\RegistrationAnswers;
use App\Models\RegistrationForm;
use App\Models\ExtraQuestions;
use App\Models\Comments;
use App\Models\Badges;
use App\Models\Complaints;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use File;
use Session;
use Image;

class CommentsController extends Controller
{

    public function submitBadge(Request $request){

        print_r($request->all());

        $comment = $request->comment;
        $image = $request->file('upload_file');

        $allowedMimeTypes = ['image/jpeg','image/png'];
        $contentType = $image->getClientMimeType();

        if(! in_array($contentType, $allowedMimeTypes) ) return response('Įkeltas failas nėra tinkamo formato');
        

    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(200,200)->save('uploads/profile_pictures/'.$name_gen);
    	$save_url = 'uploads/profile_pictures/'.$name_gen;

        Badges::insert([
            'user_id' => $request->user_id,
            'organization_id' => $request->organization_id,
            'comment' => $comment,
            'img_path' => $save_url,
        ]);

        return "Made it";
    }

    public function submitComment(Request $request){

        Comments::insert([
            'user_id' => $request->user_id,
            'organization_id' => $request->organization_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        
        return json_encode("Comment Submited");
    }

    public function submitComplaint(Request $request){

        Complaints::insert([
            'user_id' => $request->user_id,
            'organization_id' => $request->organization_id,
            'complaint' => $request->complaint,
            'created_at' => now(),
        ]);
        
        return json_encode("Complaint Submited");
    }
}
