<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //

    public function index(){
        //$posts = Post::all();
        $posts = auth()->user()->posts();
        dd($posts);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post){

        return view('blog-post', ['post' => $post]);
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(){
//        auth()->user();
//        dd(request()->all());

        $inputs = request()->validate([
           'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message', 'Post was created!');
        return redirect()->route('post.index');
        //return back();

        //dd($request->post_image);
    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post){
        $post->delete();
        Session::flash('message', 'Post was deleted!');
        return back();
    }
    public function update(Post $post){
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

//        $post = new Post();
//        $post->title = request('title');

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        //$post->save(); //nu schimba owner ul

        auth()->user()->posts()->save($post);

        session()->flash('post-updated-message', 'Post was updated!');

        return redirect()->route('post.index');

        //auth()->user()->posts()->save($inputs);
        //dd($inputs);
    }
}
