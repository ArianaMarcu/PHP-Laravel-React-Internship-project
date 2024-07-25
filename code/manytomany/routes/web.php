<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
   $user = User::findOrFail(1);
   $role = new Role(['name' => 'Subscriber']);
   $user->roles()->save($role);
});

Route::get('/read', function () {
    $user = User::findOrFail(1);
    foreach ($user->roles as $role) {
        echo $role->name . "<br>";
    }
});

Route::get('/update', function () {
    $user = User::findOrFail(1);
    if($user->has('roles')){
        foreach ($user->roles as $role) {
            if($role->name == 'Administrator'){
                $role->name = 'subscriber';
                $role->save();
            }
        }
    }
});

Route::get('/delete', function () {
   $user = User::findOrFail(1);
   $user->roles()->delete(); //$role->whereId(5)->delete();
});

Route::get('/attach', function () {
    $user = User::findOrFail(1);
    $user->roles()->attach(2);
});

Route::get('/detach', function () {
    $user = User::findOrFail(1);
    $user->roles()->detach(2);
});

Route::get('/sync', function () {
    $user = User::findOrFail(1);
    $user->roles()->sync([3]);
});
