<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmailTest;

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-mail', [TaskController::class,'sendmail']);

Route::get('email-test', function(){
  
    $details['email'] = 'sikhaouvady@gmail.com';
  
    // $email = new SendEmailTest();
    //Mail::to($this->details['email'])->send($email);
    // Mail::to('sikhaouvady@gmail.com')->send($email);
    
    dispatch(new SendEmailJob($details));
  
    dd('done');
});