<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizationController;

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/volunteering', function () {
    return view('volunteer/volunteering');
})->name('volunteering');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/edit', function () {
    $user = Auth::user();
    return view('volunteer/profile_edit')->with(compact('user'));
})->name('profile.edit');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{id}', function ($id) {
    
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
Route::get('/admin/dashboard/users',[AdminController::class, 'volunteers'])->name('admin.dashboard.volunteers');
Route::get('/admin/dashboard/organizations',[AdminController::class, 'organizations'])->name('admin.dashboard.organizations');
Route::get('/admin/dashboard/organizations/register',[AdminController::class, 'registerOrganizationPage'])->name('organizations');
Route::post('/admin/organization/register',[OrganizationController::class, 'registerOrganization'])->name('organization.registration');

//Organizations

//TEST
Route::get('test/test', function(){
    return "Hello";
});

Route::post('/search',function(Request $request){
    $search_word = $request->search_word;
    $user = User::where('full_name','LIKE','%'.$search_word.'%')->orWhere('email','LIKE','%'.$search_word.'%')->get();//->paginate(3);

    if(count($user) > 0){
        $data = array(
            'users' => $user,
            'search_word' => $search_word,
        );
        return view('volunteer/volunteering')->with(compact('data'));
    } else {
        $data = array(
            'message' => 'Nieko nepavyko rasti',
        );
        return view('volunteer/volunteering')->with(compact('data'));
    }
})->name('search');

Route::middleware(['auth:sanctum', 'verified'])->get('/search', function () {
    return view('volunteer/volunteering');
})->name('search');