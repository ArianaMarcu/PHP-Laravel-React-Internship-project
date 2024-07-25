<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function(){
   $post = Post::create(['name'=>'My first post ']);
   $tag1 = Tag::findOrFail(1);
   $post->tags()->save($tag1);
   $video = Video::create(['name'=>'video.mov']);
   $tag2 = Tag::findOrFail(2);
   $video->tags()->save($tag2);
});

Route::get('/read',function(){
    $post = Post::findOrFail(1);
    foreach($post->tags as $tag){
        echo $tag;
    }
});

Route::get('/update', function(){
//    $post = Post::findOrFail(1);
//    foreach($post->tags as $tag){
//        return $tag->whereName('PHP')->update(['name'=>'Updated PHP']);
//    }

    $post = Post::findOrFail(1);
    $tag = Tag::findOrFail(3);
    //$post->tags()->save($tag);
    //$post->tags()->attach($tag);
    $post->tags()->sync([1]);
});

Route::get('/delete', function(){
   $post = Post::find(1);
   foreach($post->tags as $tag){
       $tag->whereId(2)->delete();
   }
});
