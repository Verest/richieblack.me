@extends('layout.layout')

@section('title')
    Stateful Calculator
@endsection

@section('css')
    <link href="{{url("/assets/css/stateful-calculator.css")}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{url("assets/js/stateful-calculator.js")}}"></script>
@endsection

@section('content')
    <div id="root"></div>
@endsection
