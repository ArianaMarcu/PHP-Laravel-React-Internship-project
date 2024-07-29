<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function setPostImageAttribute($value){
//        $this->attributes['post_image'] = asset($value);
//    } //mutator

//    public function getPostImageAttribute($value){
//        return asset($value);
//    }

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }

//So on the next lecture, I show you how to use an Accessor for images,
// just in case you guys use HTTP images or local images
// for your path AND you encounter some issues, here is a quick fix for that.


}
