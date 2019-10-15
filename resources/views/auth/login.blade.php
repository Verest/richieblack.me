@extends('layout.admin')

@section('title')
    Admin Section
@endsection

@section('content')
    <div class="row">
        <h1>Login</h1>

        <p>
            This website does not allow registering of accounts.
        </p>

        <div class="col-12">
            <form method="post" action="{{route('login')}}">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label for="email">Email: </label>
                    </div>
                    <div class="col-8">
                        <input id="email" name="email" type="text">
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-8">
                        <input id="password" name="password" type="password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
