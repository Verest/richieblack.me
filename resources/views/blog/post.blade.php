@extends('layout.main')

@section('title')
    Richie Black's Blog
@endsection

@section('content')
    <h1>{{$post->title}}</h1>

    {!! Markdown::defaultTransform($post->body) !!}
@endsection
