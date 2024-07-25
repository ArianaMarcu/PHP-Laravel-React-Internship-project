@extends('layouts.app')
@section('content')
    <h1>Edit Post</h1>
    {!! html()->form(method:"PATCH",action: "/posts/{$post->id}")->open() !!}
    {{csrf_field()}}
    {!! html()->input('text','title',$post->title)->placeholder('Enter Title:') !!}
    {!! html()->input('submit','submit','UPDATE')->class('btn btn-info') !!}
    {!! html()->form()->close() !!}


    {!! html()->form(method:"DELETE",action:"/posts/{$post->id}")->open() !!}
    {!! html()->input('submit','DELETE','DELETE')->class('btn btn-danger') !!}
@endsection
@yield('footer')
