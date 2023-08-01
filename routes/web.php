<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MailController;
use App\Mail\UserStatusChange;
use App\Domains\Auth\Models\User;


/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

Route::get('register-success',[MailController::class,'sendRegistrationEmail']);

Route::get('/user-status', function(){
    return new UserStatusChange();
});

Route::get('/register-success', function(){
    return view('frontend.register-success');
});

Route::get('/log', function(){
    return view('backend.auth.log.index');
});

