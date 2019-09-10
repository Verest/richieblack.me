@extends('layout.layout')

@section('title', 'Home of richieblack.me')

@section('content')
    <div class="row">
        <h1 class="col-12">
            About Me
            <img class='richie-image image-round' src="assets/images/richie.jpg" alt="Picture of Richie Black">
        </h1>

        <div class="col-s-12">
            <p>
                I am a life long learner and currently working as a self taught web developer. My current role is
                focused on development using PHP/JS/MySQL within the Laravel Framework. My main goal is to solve
                problems while polishing and updating my current skill set. Outside of development, my main interests
                are personal development, healthy eating, and a budding interest in music.
            </p>
        </div>
    </div>

    <div class="row">
        <h2 class="col-12">Purpose Of Site</h2>
        <p class="col-12">
            The primary purpose of this site is to serve as a host for any <a href="/projects">projects</a> I complete
            as well as to be a "playground" for messing around with new technologies or showing my skill set. At the
            moment, I am working on generating a simple blog platform with a backend interface for an admin to use.
            This entire website is hosted on my
            <a target="_blank" href="https://github.com/Verest/richieblack.me">GitHub</a>.
        </p>
    </div>
@endsection