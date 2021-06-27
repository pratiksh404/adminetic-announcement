<?php

use Adminetic\Announcement\Http\Controllers\Admin\AnnouncementController;
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

Route::resource('announcement', AnnouncementController::class);
Route::get('timeline', [AnnouncementController::class, 'timeline']);
