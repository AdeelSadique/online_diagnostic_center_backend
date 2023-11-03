<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\patientController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\managerController;
use App\Http\Controllers\testController;
use App\Http\Controllers\appointmentController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\billingController;
use App\Http\Controllers\adminMessageController;
use App\Http\Controllers\managerMessageController;
use App\Http\Controllers\ratingController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\adminController;



// total 12 APIs routes
// http://127.0.0.1:8000/fasttest/admin     for first time registration using postman or thunder client
// http://127.0.0.1:8000/fasttest/login
// http://127.0.0.1:8000/fasttest/logout
// http://127.0.0.1:8000/fasttest/patient
// http://127.0.0.1:8000/fasttest/manager
// http://127.0.0.1:8000/fasttest/adminMessage
// http://127.0.0.1:8000/fasttest/managerMessage
// http://127.0.0.1:8000/fasttest/rating
// http://127.0.0.1:8000/fasttest/feedback
// http://127.0.0.1:8000/fasttest/test
// http://127.0.0.1:8000/fasttest/appointment
// http://127.0.0.1:8000/fasttest/report
// http://127.0.0.1:8000/fasttest/billing



// patient, manager and admin login route
Route::post('login', [loginController::class, 'login']);
Route::post('passwordResetRequest', [loginController::class, 'passwordResetRequest']);
Route::post('passwordReset', [loginController::class, 'passwordReset']);
//admin registeration route
Route::post('admin', [adminController::class, 'store']);

// pulic routes
Route::post('patient', [patientController::class, 'store']);
Route::post('manager', [managerController::class, 'store']);
Route::get('rating', [ratingController::class, 'index']);
Route::post('rating', [ratingController::class, 'store']);
Route::get('feedback', [feedbackController::class, 'index']);
Route::post('feedback', [feedbackController::class, 'store']);
Route::get('test', [testController::class, 'index']);
Route::post('adminMessage', [adminMessageController::class, 'store']);


// prtotected routes. These routes will be accessible only if you have a token
Route::middleware('auth:sanctum')->group(function(){
    // logout routes
    Route::post('logout', [loginController::class, 'logout']);
    // patients routes
    Route::get('patient', [patientController::class, 'index']);
    Route::get('patient/{id}', [patientController::class, 'show']);
    Route::put('patient/{id}', [patientController::class, 'update']);
    //admin can update patient password using this route
    Route::put('patient/updatePassword/{id}', [patientController::class, 'updatePassword']);
    //patient can password using this route
    Route::put('patient/changePassword/{id}', [patientController::class, 'changePassword']);
    Route::delete('patient/{id}', [patientController::class, 'destroy']);
    // managers routes
    Route::get('manager', [managerController::class, 'index']);
    Route::get('manager/{id}', [managerController::class, 'show']);
    Route::put('manager/{id}', [managerController::class, 'update']);
    // only admin change password
    Route::put('manager/updatePassword/{id}', [managerController::class, 'updatePassword']);
    // manager can change password
    Route::put('manager/changePassword/{id}', [managerController::class, 'changePassword']);
    Route::delete('manager/{id}', [managerController::class, 'destroy']);

    // tests all routes protected

    Route::get('managerTests/{id}', [testController::class, 'managerTests']);
    Route::get('test/{id}', [testController::class, 'show']);
    Route::put('test/{id}', [testController::class, 'update']);
    Route::post('test', [testController::class, 'store']);
    Route::delete('test/{id}', [testController::class, 'destroy']);


    // appointments routes protected
    Route::get('appointment', [appointmentController::class, 'index']);
    Route::get('managersAppointment/{id}', [appointmentController::class, 'show']);
    Route::put('appointment/{id}', [appointmentController::class, 'update']);
    Route::post('appointment', [appointmentController::class, 'store']);
    Route::delete('appointment/{id}', [appointmentController::class, 'destroy']);

    Route::get('patientAppointments/{id}', [appointmentController::class, 'patientAppointments']);

    // reports routes protected
    Route::resource('report', reportController::class);
    Route::get('patientReports/{id}', [reportController::class, 'patientReports']);
    Route::get('downloadReport/{file}', [reportController::class, 'downloadReport']);
    Route::get('managerReports/{id}', [reportController::class, 'managerReports']);

    // billing routes protected
    Route::resource('billing', billingController::class);
    Route::get('managerBills/{id}', [billingController::class,'managerBills']);

    // adminMessage routes protected
    Route::get('adminMessage', [adminMessageController::class, 'index']);
    Route::get('adminMessage/{id}', [adminMessageController::class, 'show']);

    Route::put('adminMessage/{id}', [adminMessageController::class, 'update']);
    Route::delete('adminMessage/{id}', [adminMessageController::class, 'destroy']);

    // managerMessage routes protected
    Route::get('managerMessage', [managerMessageController::class, 'index']);

    Route::post('managerMessage', [managerMessageController::class, 'store']);
    Route::get('managerMessage/{id}', [managerMessageController::class, 'show']);
    Route::get('patientMessage/{id}', [managerMessageController::class, 'patientMessage']);
    Route::get('managerMessages/{id}', [managerMessageController::class, 'managerMessages']);
    Route::put('managerMessage/{id}', [managerMessageController::class, 'update']);
    Route::delete('managerMessage/{id}', [managerMessageController::class, 'destroy']);

    // rating routes protected
    Route::get('rating/{id}', [ratingController::class, 'show']);
    Route::put('rating/{id}', [ratingController::class, 'update']);
    Route::delete('rating/{id}', [ratingController::class, 'destroy']);

    // feedback routes protected
    Route::get('feedback', [feedbackController::class, 'index']);
    Route::get('feedback/{id}', [feedbackController::class, 'show']);
    Route::put('feedback/{id}', [feedbackController::class, 'update']);
    Route::delete('feedback/{id}', [feedbackController::class, 'destroy']);

    //admin information route protected
Route::get('admin/{id}', [adminController::class, 'show']);

});
