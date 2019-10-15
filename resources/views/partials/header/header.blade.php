@extends('partials.header.header-shared')

@section('header-links')
    <li class="center"><a class='btn btn-light' href='{{route('blog')}}'>View Posts</a></li>
    <li class='center'><a class='btn btn-light' href="{{route('projects')}}">Projects</a></li>
@endsection
