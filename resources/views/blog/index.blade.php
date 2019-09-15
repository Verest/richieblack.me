@extends('layout.layout')

@section('title')
    Richie Black's Blog
@endsection

@section('content')
    <h1>Richie Black's Blog</h1>

    <div class="row">
        @foreach($posts as $post)
            <a class="post col-12" href="{{url("/blog/{$post->slug}")}}">
                <h2 class="title">{{$post->title}}</h2>
                <p class="meta">{{$post->meta}}</p>
            </a>
        @endforeach
    </div>
@endsection
