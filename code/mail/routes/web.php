<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/send', function () {
    //return view('welcome');

    $data = [
        'title'=>'Hi student I hope you like the course',
        'content'=>'This laravel course was created with a lot of love and dedication for you'
    ];

    Mail::send('emails.test', $data, function ($message) {
        $message->to('arianamarcu6@gmail.com', 'Marcu Ariana')->subject('Hello, student! How are you?');
    });
    echo "Email Sent Successfully!";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
