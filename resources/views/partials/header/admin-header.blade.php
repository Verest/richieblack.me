@extends('partials.header.header-shared')

@section('header-links')
    <li class="center"><a class='btn btn-light' href="{{route('posts.index')}}">View Posts</a></li>
@endsection