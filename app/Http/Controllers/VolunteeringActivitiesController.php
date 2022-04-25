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
use App\Models\ExtraQuestions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use File;
use Session;
use Image;

class VolunteeringActivitiesController extends Controller
{
    public function createActivity(Request $request){

        $document_needed = false;
        $document_path = null;

        //Image
        if(isset($request->activity_photo)){
            $image = $request->file('activity_photo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(917,1000)->save('uploads/activity_pictures/'.$name_gen);
            $save_url = 'uploads/activity_pictures/'.$name_gen;
        }
        

        //File
        if(isset($request->upload_file)){

            $document_needed = true;

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

            $document_path = 'Paper'.$name_gen;
        }

        $activity = VolunteeringActivities::create([
            'name' => $request->activity_name,
            'organization_id' => Auth::guard('organization')->user()->id,
            'category_id' => $request->category_id,
            'activity_photo' => $save_url,
            'people_registered' => null,
            'people_limit' => $request->people_limit,
            'papers_required' => $document_needed,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'file_upload_path' => $document_path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        if(isset($request->questions)){
            foreach($request->questions as $key => $value){
                ExtraQuestions::create([
                    'activity_id' => $activity->id,
                    'question' => $value['question'],
                ]);
            }
        }
        
        $notification = array(
            'message' => 'Veikla sukurta sėkmingai',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
