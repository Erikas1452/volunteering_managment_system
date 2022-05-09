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
use App\Models\ActivityLog;
use App\Models\VolunteersLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use File;
use Session;
use Image;
use App\Mail\VolunteerAccepted;
use App\Mail\VolunteerDnied;
use App\Mail\removedFromActivity;
use App\Mail\MessageFromOrganization;
use App\Mail\ThankYouLetter;
use App\Mail\ApologyLetter;

class VolunteeringActivitiesController extends Controller
{

    public function removeActivity($id){
        $activity = VolunteeringActivities::find($id);
        $forms = VolunteeringActivities::find($id)->acceptedForms;
        foreach($forms as $form){
            Mail::to($form->email)->send(new ApologyLetter($activity->organization->name,
                $activity->organization->email,
                $activity->name,
            ));
        }
        $activity->delete();

        $notification = array(
            'message' => 'Veikla pašalinta sėkmingai',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function endActivity(Request $request){

        $activity = VolunteeringActivities::find($request->id);
        $volunteers = VolunteeringActivities::find($request->id)->acceptedForms;

        $activityLog = ActivityLog::create([
            'name' => $activity->name,
            'organization_id' => $activity->organization_id,
            'activity_photo' => $activity->activity_photo,
            'city' => $activity->city,
            'hours' => $activity->hours,
            'short_desc' => $activity->short_desc,
            'long_desc' => $activity->long_desc,
            'file_upload_path' => $activity->file_upload_path,
            'start_date' => $activity->start_date,
            'end_date' => $activity->end_date,
            "created_at" => now(),
        ]);

        foreach($volunteers as $vol){
            VolunteersLog::create([
                'full_name' => $vol->full_name,
                'email' => $vol->email,
                'phone' => $vol->phone,
                'city' => $vol->city,
                'upload_file' => $vol->upload_file,
                'activity_log_id' => $activityLog->id,
                'volunteer_id' => $vol->volunteer_id,
            ]);

            Mail::to($vol->email)->send(new ThankYouLetter($activity->organization->name,
                $activity->organization->email,
                $request->message,
                $activity->name,
                $activity->hours,
            ));
        }

        // $activity->delete();
        
        return json_encode("{message: \"Savanorystė sėkmingai užbaigta\"}");

    }

    public function sendEmails($activity_id, Request $request){

        $message = $request->message;
        $activity = VolunteeringActivities::with('organization')->where('id',$activity_id)->first();
        $volunteers = VolunteeringActivities::find($activity_id)->acceptedForms;

        foreach ($volunteers as $volunteer)
        {
            Mail::to($volunteer->email)->send(new MessageFromOrganization($activity->organization->name,
            $activity->organization->email,
            $message,
            $activity->name,));
        }

        $notification = array(
            'message' => 'Žinutė išsiūsta sėkmingai',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function confirmRequest($email, $activity, $formId){

        $form = RegistrationForm::where('id',$formId)->first();
        $act = VolunteeringActivities::where('id', $form->activity_id)->first();
        $act->people_registered++;
        $act->save();
        $form->accepted = true;
        $form->update();

        Mail::to($email)->send(new VolunteerAccepted($activity));

        $notification = array(
            'message' => 'Patvirtinta sėkmingai',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function removeVolunteer($email, $activity, $formId){
        $form = RegistrationForm::where('id',$formId)->first();
        $act = VolunteeringActivities::where('id', $form->activity_id)->first();
        $form->delete();
        $act->people_registered--;
        $act->update();
        Mail::to($email)->send(new removedFromActivity($activity));
        return redirect()->back();
    }

    public function denyRequest($email, $activity, $formId){

        $form = RegistrationForm::where('id',$formId)->first();
        $act = VolunteeringActivities::where('id', $form->activity_id)->first();
        $form->delete();
        $act->people_registered--;
        $act->update();
        Mail::to($email)->send(new VolunteerDnied($activity));
        return redirect()->back();
    }

    public function register(Request $request){

        $activity = VolunteeringActivities::where('id', $request->activity_id)->first();

        $document_path = null;

        if($activity->papers_required  === 1){

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

        $form = RegistrationForm::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'comments' => $request->comments,
            'upload_file' => $document_path,
            'activity_id' => $request->activity_id,
            'volunteer_id' => $request->volunteer_id,
        ]);

        if(isset($request->answer))
        {
                foreach($request->answer as $key => $value){
                RegistrationAnswers::create([
                    'answer' => 1,
                    'registration_form_id' => $form->id,
                    'question_id' => $value['answer'],
                ]);
            }
        }

        $notification = array(
            'message' => 'Į savanorystę užsiregistruota sėkmingai',
            'alert-type' => 'success'
        );
        
        return redirect()->route('volunteering')->with($notification);
    } 

    public function activityRegisterForm($activity_id){

        $activity = VolunteeringActivities::with('category')->where('id', $activity_id)->get();
        $questions = VolunteeringActivities::find($activity_id)->questions;
        $organization = Organization::where('id', $activity[0]->organization_id)->get();
        
        $data = array(
            'activity' => $activity,
            'questions' => $questions,
            'organization' => $organization,
        );

        return view('volunteer.volunteer-activity-register')->with(compact('data'));

    }

    public function getAnswers($formID){

        $response = [];

        $answers = RegistrationAnswers::where('registration_form_id',$formID)->get();
        foreach($answers as $a)
        {
            $question = ExtraQuestions::where('id', $a->question_id) ->first();
            array_push($response,$question->question);
        }
        return json_encode($response);

    }

    public function openActivity($id){


        $activity = VolunteeringActivities::with('category')->where('id', $id)->get();
        $questions = VolunteeringActivities::find($id)->questions;
        // $forms = VolunteeringActivities::find($id)->registrationForms;
        $volunteers = VolunteeringActivities::find($id)->acceptedForms;
        $requests = VolunteeringActivities::find($id)->notAcceptedForms;

        $data = array(
            'activity' => $activity,
            'questions' => $questions,
            'requests' => $requests,
            'volunteers' => $volunteers,
        );

        return view('company.company-dashboard-activity-info')->with(compact('data'));
    }

    public function createActivity(Request $request){

        $document_needed = false;
        $document_path = null;

        //Image
        if(isset($request->activity_photo)){
            $image = $request->file('activity_photo');
            if($image->getClientOriginalExtension() !== "jpg" && $image->getClientOriginalExtension() !== "png" && $image->getClientOriginalExtension() !== "jpeg"){
                $notification = array(
                    'message' => 'Netinkamas nuotraukos formatas',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            // return $image->getClientOriginalExtension();
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
                return back()->with($notification);
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
            'people_registered' => 0,
            'people_limit' => $request->people_limit,
            'city' => $request->city,
            'hours' => $request->hours,
            'papers_required' => $document_needed,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'file_upload_path' => $document_path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        if(isset($request->questions)){
            foreach($request->questions as $key => $value){
                if(isset($value['question'])){
                    ExtraQuestions::create([
                        'activity_id' => $activity->id,
                        'question' => $value['question'],
                    ]);
                }
            }
        }
        
        $notification = array(
            'message' => 'Veikla sukurta sėkmingai',
            'alert-type' => 'success'
        );
        return redirect()->route('company.dashboard.activities')->with($notification);
    }
}
