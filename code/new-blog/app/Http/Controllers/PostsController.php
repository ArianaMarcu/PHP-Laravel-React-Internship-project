<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function contact()
    {
        $people = ['Edwin', 'Jose', 'James', 'Peter', 'Maria'];
        return view('contact', compact('people'));
    }

    public function show_post($id)
    {
        //return view('post')->with('id', $id);

        return view('post', compact('id'));
    }

    /*public function store(Request $request){
        //return $request->all();

        Post::create($request->all());

        return redirect('/posts');

//        $input = $request->all();
//        $input['title'] = $request->title;
//        Post::create($request->all());

//        $post = new Post();
//        $post->title = $request->title;
//        $post->save();
    }*/

    /*public function store(CreatePostRequest $request)
    {
//        request()->validate([
//            'title' => 'required|max:10'
//        ]);
        Post::create($request->all());

        return redirect('/posts');
        //return $request->file('file');
    }*/


//    public function store(CreatePostRequest $request)
//    {
//        $file = $request->file('file');
//
//        echo "<br>";
//
//        echo $file->getClientOriginalName();
//
//        echo "<br>";
//
//        echo $file->getSize();
//    }


//    public function store(CreatePostRequest $request)
//    {
//        $input = $request->all();
//        if($file = $request->file('file')) {
//            $name = $file->getClientOriginalName();
//            $file->move('images', $name);
//            $input['path'] = $name;
//        }
//        Post::create($input);
//    }

    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        $filePath = "Not Given";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName);
            Post::create([
                'title' => $fileName,
                'path' => $filePath,
            ]);
            return redirect('/posts');
        }
        Post::create([
            'title' => $input['title'],
            'path' => $filePath
        ]);
        return redirect('/posts');
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::whereId($id)->delete();
        return redirect('/posts');
    }
}
