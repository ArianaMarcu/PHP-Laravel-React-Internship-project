@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! html()->form(method:"POST",action: "/posts")->acceptsFiles()->open() !!}

    {!! html()->div()->class("form-group")->open() !!}
    {!! html()->label('Title','title') !!}
    {!! html()->file('file')->class('fa fa-eye') !!}
    {{--    'file' is a ^(this)    Post Super Global Value --}}
    {!! html()->div()->close() !!}

    {!! html()->div()->class("form-group")->open() !!}
    {!! html()->label('Title','title') !!}
    {!! html()->text('title')->class('fa fa-eye') !!}
    {!! html()->div()->close() !!}
    {!! html()->input("submit","send","Send") !!}
    {!! html()->form()->close() !!}
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>    @endif
@endsection
@yield('footer')
