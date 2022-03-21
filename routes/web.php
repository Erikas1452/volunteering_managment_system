<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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

Route::middleware(['auth:sanctum', 'verified'])->get('/volunteer/logout',[UserController::class, 'logout'])->name('volunteer.logout');
Route::middleware(['auth:sanctum', 'verified'])->post('/volunteer/profile/update',[UserController::class, 'updateVolunteer'])->name('volunteer.profile.update');
Route::post('/volunteer/register',[UserController::class, 'registerVolunteer'])->name('register.volunteer');
Route::post('/volunteer/login',[UserController::class, 'authenticate'])->name('authenticate.volunteer');

Route::post('/search',function(Request $request){
    $search_word = $request->search_word;
    $user = User::where('full_name','LIKE','%'.$search_word.'%')->orWhere('email','LIKE','%'.$search_word.'%')->get();

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