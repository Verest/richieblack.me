@extends('layout.main')

@section('title')
    Projects
@endsection

@section('content')
    <h1>Projects</h1>

    @foreach($projects as $project)
        @include("partials.project")
    @endforeach

@endsection
