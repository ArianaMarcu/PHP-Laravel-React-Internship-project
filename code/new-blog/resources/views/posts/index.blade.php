@extends('layouts.app')

@section('content')
    <h1>Index Post</h1>
    <ul>        @foreach($posts as $post)
            <div class="image-container">
                <img src="{{$post->path}}" alt="">
            </div>
            <li><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></li>
        @endforeach
    </ul>
@endsection
