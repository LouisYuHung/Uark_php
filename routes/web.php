<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('layouts/login');
});

Route::post('/verify', [AccountController::class, 'verify']);

Route::get('/home', function () {
    return view('layouts/home', ['response' => Lang::get('messages.welcome')]);
});

Route::get('/review', function () {
    switch (Session::get('status')) {
        case 0:
            $response = Lang::get('messages.account') . Lang::get('messages.not_exist');
            break;
        case 1:
            $response = Lang::get('messages.account') . Lang::get('messages.not_verify');
            break;
        default: // -1
            $response = Lang::get('messages.wrong_password');
    }

    return view('layouts/review', ['response' => $response]);
});

Route::get('/create_org', function () {
    return view('layouts/create_org');
});

Route::get('/create_org/submit', [AccountController::class, 'createOrg']);
Route::get('/create_org/result', function () {
    return view('layouts/create_org_result', ['response' => Session::get('message')]);
});

Route::get('/create_user', function () {
    return view('layouts/create_user', ['orgs' => DB::connection('uark_php')->table('orgs')->select(['org_no', 'title'])->where('status', 1)->get()]);
});

Route::get('/create_user/submit', [AccountController::class, 'createUser']);
Route::get('/create_user/result', function () {
    return view('layouts/create_user_result', ['response' => Session::get('message')]);
});
Route::get('/logout', [AccountController::class, 'logout']);
