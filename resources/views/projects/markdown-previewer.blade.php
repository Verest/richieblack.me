@extends('layout.main')

@section('title')
    Simon Game
@endsection

@section('css')
    <link href="{{url("/assets/css/markdown.css")}}" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="{{url("assets/js/markdown-preview.js")}}"></script>
@endsection

@section('content')
    <div id="root"></div>
@endsection
