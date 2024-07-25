<?php

use App\Http\Controllers\PostsController;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\select;
use App\Models\Post;


//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/about', function () {
//    return "About Page";
//});
//
//Route::get('/contact', function () {
//    return "Contact Page";
//});
//
//Route::get('post/{id}', function($id){
//    return "This is post number ". $id;
//});
//
//Route::get('admin/posts/example',array('as'=> 'admin.home', function(){
//    $url = route('admin.home');
//    return "this url is ". $url;
//}));

//Route::get('/post/{id}', '\App\Http\Controllers\PostsController@index');
//Route::resource('/posts', '\App\Http\Controllers\PostsController');

//Route::get('/contact', '\App\Http\Controllers\PostsController@contact');
//
//Route::get('post/{id}', '\App\Http\Controllers\PostsController@show_post');

///DATABASE Raw SQL Quaries

//Route::get('/insert', function(){
//
//    DB::insert('insert into posts (title, content) values (?, ?)', ['Laravel is awesome with Edwin', 'Laravel is the best, PERIOD']);
//
//});


//Route::group(['middleware' =>['web']], function () {
//
//
//});

// DATABASE Raw SQL Quaries CRUD

//Route::get('/read', function()
//{
//   $results = DB::select('select * from posts where id = ?', [1]);
//    return $results;
////   foreach ($results as $post)
//////   {
//////       return $post->title;
//////   }
//});


//Route::get('/update', function(){
//    $updated = DB::update('update posts set title = "Update title" where id = ?', [1]);
//    return $updated;
//});

//ELOQUENT


//Route::get('/read', function(){
//   $posts = Post::all();
//
//   foreach($posts as $post){
//       return $post->title;
//   }
//});

//Route::get('/find', function(){
//    $post = Post::find(2);
//    return $post->title;
//});

//Route::get('/findwhere', function(){
//    $posts = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
//    return $posts;
//});

//Route::get('/findmore', function(){
////   $posts = Post::FindOrFail(1);
////   return $posts;
//
//    $posts = Post::where('users_count', '<', 50)->firstOrFail();
//});

//Route::get('/basicinsert', function(){
//    $post = Post::find(3); //new Post
//    $post->title = 'new Eloquent title insert 2';
//    $post->content = 'Wow, Eloquent is cool 2';
//    $post->save();
//});


//Route::get('/create', function(){
//    Post::create(['title'=>'the create method', 'content'=>'WOW I\'m learning a lot with Edwin Diaz']);
//});


//Route::get('/update', function(){
//  Post::where('id', 2)->where('is_admin', 0)->update(['title'=> 'NEW PHP TITLE', 'content'=>'I love my instructor Edwin']);
//});

//////Deleting data using eloquent

//Route::get('/delete', function(){
//    $post = Post::find(2);
//    $post->delete();
//});
//
//Route::get('/delete2', function(){
//    Post::destroy(3);
//});
//
//Route::get('/delete3', function(){
//    Post::destroy([4,5]);
//    //Post::where('is_admin', 0)->delete();
//});

//(soft) deleting AND putting it in the trash
//Route::get('/softdelete', function(){
//    Post::find(3)->delete();
//});
//
//Route::get('/readsoftdelete', function(){
////    $post = Post::find(1);
////    return $post;
//    $post = Post::onlyTrashed()->where('is_admin', 0)->get();
//    return $post;
//});
//
//Route::get('/restore', function(){
//    Post::withTrashed()->where('is_admin',0)->restore();
//});
//
////delete something permanently
//Route::get('/forcedelete', function(){
//    Post::withTrashed()->where('is_admin',0)->forceDelete();
//});

///ELOQUENT Relationships
///
/// ONE TO ONE RELATIONSHIPS
Route::get('/user/{id}/post', function($id){
    $user = User::findOrFail($id);
    return $user->post->content;
});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

///ONE TO MANY
///
Route::get('/posts', function(){
    $user = User::findOrFail(1);
    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

//MANY TO MANY
Route::get('/user/{id}/role', function($id){
    $user = User::findOrFail($id)->roles()->orderBy('id', 'desc')->get();
    return $user;
//    foreach ($user->roles as $role) {
//        return $role->name;
//    }
});

//Accessing the intermediate table / pivot
Route::get('/user/pivot', function(){
   $user = User::findOrFail(1);
   foreach ($user->roles as $role) {
       return $role->pivot;
   }
});

///HAS MANY THROUGH

Route::get('/user/country', function(){
    $country = Country::findOrFail(4);
    foreach ($country->posts as $post) {
        return $post->title;
    }
});

//Polymorphic Relations

Route::get('/post/photos', function(){
   $post = Post::findOrFail(1);
   foreach ($post->photos as $photo) {
       echo $photo->path . "<br>";
   }
});

//pull the owner of the image
Route::get('/photo/{id}/post', function($id){
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

//polymorphic many to many
Route::get('/post/tag', function(){
    $post = Post::findOrFail(1);
    foreach ($post->tags as $tag) {
        echo $tag->name . "<br>";
    }
});

Route::get('/tag/post', function(){
    $tag = Tag::findOrFail(2);
    foreach ($tag->posts as $post) {
        echo $post->title . "<br>";
    }
});


/***
 * CRUD APPLICATION
 */
Route::resource('/posts', PostsController::class);

Route::group(['middleware'=>'web'],function (){
    Route::resource('/posts',PostsController::class);
});

Route::get('/dates',function(){
    $date = new DateTime('+1 week');
    echo $date->format('d.m.Y')."<br>";
    echo Carbon::now()->addDays(10)->diffForHumans()."<br>";
    echo Carbon::now()->subMonth(2)->diffForHumans()."<br>";
    echo Carbon::now()->yesterday()->diffForHumans();
});

Route::get('/getname',function(){
    $user = User::findOrFail(1);
    echo $user->name;
});

Route::Get('/setname',function(){
    $user = User::findOrFail(1);
    $user->name = "william";
    $user->save();
});
