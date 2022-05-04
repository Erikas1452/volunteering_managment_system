<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Admin;
use App\Models\VolunteeringActivities;
use App\Models\Category;
use App\Models\ExtraQuestions;
use App\Models\Organization;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\VolunteeringActivitiesController;
use App\Mail\loginData;

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/edit', function () {
    $user = Auth::user();
    return view('volunteer/profile_edit')->with(compact('user'));
})->name('profile.edit');

Route::get('/profile/{id}', function ($id) {
    
    $user = User::where('id', $id)->first();
    
    if(!$user) return redirect()->back();
    else return view('volunteer/profile')->with(compact('user'));

})->name('volunteer.profile');


//Main pages
Route::get('/', function () {
    return view('main/index');
})->name('home');

Route::get('/register', function(){
    if(Auth::check()) return redirect()->route('volunteering');
    return view('main/register');
})->name('register');

Route::get('/login', function(){
    if(Auth::check()) return redirect()->route('volunteering');
    return view('main/login');
})->name('login');

//Volunteer
Route::middleware(['auth:sanctum', 'verified'])->get('/volunteer/logout',[UserController::class, 'logout'])->name('volunteer.logout');
Route::middleware(['auth:sanctum', 'verified'])->post('/volunteer/profile/update',[UserController::class, 'updateVolunteer'])->name('volunteer.profile.update');
Route::middleware(['auth:sanctum', 'verified'])->post('/volunteer/profile/photo/update/',[UserController::class, 'updateVolunteerPhoto'])->name('volunteer.profile.photo.update');
Route::post('/volunteer/register',[UserController::class, 'registerVolunteer'])->name('register.volunteer');
Route::post('/volunteer/login',[UserController::class, 'authenticate'])->name('authenticate.volunteer');
Route::get('/volunteer/my/volunteerings',[UserController::class,'myVolunteerings'])->name('my.volunteerings');

//Admin
Route::get('/admin/login', function(){
    if(Auth::guard('admin')->check()) return redirect()->route('admin.dashboard');
    else if(Auth::guard('web')->check()) return redirect()->route('volunteering');
    else if(Auth::guard('organization')->check()) return redirect()->route('home');
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/register',[AdminController::class, 'registerAdmin'])->name('register.admin');
Route::post('/admin/authenticate',[AdminController::class, 'authenticate'])->name('authenticate.admin');
Route::get('/admin/logout',[AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard/',[AdminController::class, 'dashboard'])->name('admin.dashboard');

//adminUsers
Route::get('/admin/dashboard/users',[AdminController::class, 'volunteers'])->name('admin.dashboard.volunteers');
Route::get('/admin/dashboard/organizations',[AdminController::class, 'organizations'])->name('admin.dashboard.organizations');
Route::get('/admin/dashboard/organizations/register',[AdminController::class, 'registerOrganizationPage'])->name('organizations');
Route::post('/admin/organization/register',[OrganizationController::class, 'registerOrganization'])->name('organization.registration');
Route::post('/admin/dashboard/volunteers/suspend',[AdminController::class, 'suspendVolunteer'])->name('volunteer.suspend');
//adminCategories
Route::get('/admin/dashboard/categories',[AdminController::class, 'categories'])->name('admin.dashboard.categories');
Route::post('/admin/dashborad/categories/create',[CategoryController::class, 'storeCategory'])->name('category.store');
Route::get('/admin/dashborad/categories/delete/{id}',[CategoryController::class, 'deleteCategory'])->name('category.delete');
Route::get('/admin/dashborad/categories/edit/{id}',[CategoryController::class, 'editCategory'])->name('category.edit');
Route::post('/admin/dashborad/categories/update/{id}',[CategoryController::class, 'updateCategory'])->name('category.update');

//adminOrganizations
Route::get('/admin/dashboard/organization/requests',[OrganizationController::class, 'organizationRequests'])->name('admin.organization.requests');
Route::get('/admin/dashborad/organization/requests/download/{path}',[OrganizationController::class, 'downloadFile'])->name('organization.request.file');
Route::get('/admin/dashborad/organization/requests/confirm/{email}',[OrganizationController::class, 'confirmRequest'])->name('organization.request.confirm');
Route::get('/admin/dashborad/organization/requests/deny/{email}',[OrganizationController::class, 'denyRequest'])->name('organization.request.deny');

//Organizations
Route::get('/organization/home',[OrganizationController::class, 'companyPage'])->name('company.main');
Route::get('/organization/register/request', [OrganizationController::class, 'companyRequest'])->name('company.request');
Route::post('/organization/login/authenticate', [OrganizationController::class, 'authenticate'])->name('company.authenticate');
Route::get('/organization/login/', [OrganizationController::class, 'login'])->name('company.login');
Route::post('/organization/register/request/create', [OrganizationController::class, 'companyRequestCreate'])->name('company.request.create');
Route::get('/organization/dashboard/', [OrganizationController::class, 'dashboard'])->name('company.dashboard');
Route::get('/organization/dashboard/activities', [OrganizationController::class, 'dashboardActivities'])->name('company.dashboard.activities');
Route::get('/organization/dashboard/activities/create', [OrganizationController::class, 'createActivityPage'])->name('company.dashboard.activities.create');
Route::get('/organization/logout',[OrganizationController::class, 'logout'])->name('organization.logout');
Route::get('/organization/dashborad/activities/volunteer/request/confirm/{email}/{activity}/{formId}',[VolunteeringActivitiesController::class, 'confirmRequest'])->name('volunteer.request.confirm');
Route::get('/organization/dashborad/activities/volunteer/request/deny/{email}/{activity}/{formId}',[VolunteeringActivitiesController::class, 'denyRequest'])->name('volunteer.request.deny');
Route::get('/organization/dashborad/activities/volunteer/request/remove/{email}/{activity}/{formId}',[VolunteeringActivitiesController::class, 'removeVolunteer'])->name('volunteer.remove');
Route::post('/organization/dashboard/activities/{activity}/send/email',[VolunteeringActivitiesController::class, 'sendEmails'])->name('participants.send.mail');

Route::get('/organization/dashboard/{form}/answers',[VolunteeringActivitiesController::class, 'getAnswers'])->name('participants.answers');

//Activities
Route::post('/organization/dashboard/activities/submit',[VolunteeringActivitiesController::class, 'createActivity'])->name('activity.submit');
Route::get('/organization/dashboard/activities/{id}',[VolunteeringActivitiesController::class, 'openActivity'])->name('activity.info');

//Emails
Route::get('/email', function(){
    Mail::to('test@gmail.com')->send(new loginData());
});

//TEST
Route::get('test/test', function(){
    return "Hello";
});

Route::get('/volunteering',[UserController::class, 'volunteering'])->name('volunteering');
Route::post('/volunteering/search',[UserController::class, 'search'])->name('search');
Route::get('/volunteering/search',[UserController::class, 'search2'])->name('search');
Route::get('/volunteering/filter/{category_id}',[UserController::class, 'filterCategory'])->name('filter');
Route::get('/volunteering/view/{activity_id}',[UserController::class, 'viewActivity'])->name('volunteer.activity.view');
Route::get('/volunteering/activity/register/{activity_id}',[VolunteeringActivitiesController::class, 'activityRegisterForm'])->name('volunteer.activity.register');
Route::post('/volunteering/activity/register/',[VolunteeringActivitiesController::class, 'register'])->name('activity.register.volunteer');

//Reviews/Comments
Route::post('/volunteer/review',[CommentsController::class, 'submitComment'])->name('submit.comment');
Route::post('/volunteer/badge',[CommentsController::class, 'submitBadge'])->name('submit.badge');
Route::post('/volunteer/complaint',[CommentsController::class, 'submitComplaint'])->name('submit.complaint');
