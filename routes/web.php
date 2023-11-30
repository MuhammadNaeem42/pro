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
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/booklet_doc', function () {
    return redirect("https://drive.google.com/file/d/1JwjsS4nkCc6Z0ArBHIKAUhZ6_2PH33g_/view?usp=sharing");
});
Route::get('/booklet_doc_eng', function () {
    return redirect('https://drive.google.com/file/d/1aDZzt4sL04xRQDHzDbrZMajLpXGNx4-g/view?usp=sharing');
});