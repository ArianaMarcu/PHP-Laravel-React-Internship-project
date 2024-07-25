<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $user = User::findOrFail(1);
    $post = new Post(['title' => 'My first post', 'body' => 'My first post']);
    $user->posts()->save($post);
});

Route::get('/read', function () {
   $user = User::findOrFail(1);
    //return $user->posts;
    //dd($user->posts);
    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

Route::get('/update', function () {
   $user = User::findOrFail(1);
   $user->posts()->where('id', 1)->update(['title' => 'New title', 'body' => 'New body']);
});

Route::get('/delete', function () {
   $user = User::findOrFail(1);
   $user->posts()->where('id', 1)->delete();
});
