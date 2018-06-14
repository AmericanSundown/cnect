<?php

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

use App\Member;

Route::get('/', function () {

    $members = Member::orderBy('total', 'desc')->orderBy('nickname', 'asc')->get();
    $updated_at = Member::latest()->first()["updated_at"]->diffForHumans();

    return view('welcome', compact(['members','updated_at']));
});
