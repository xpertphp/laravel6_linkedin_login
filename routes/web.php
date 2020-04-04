<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

 Auth::routes();
Route::get('/', function () {
    return view('linkedinLogin');
});
Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback'); 