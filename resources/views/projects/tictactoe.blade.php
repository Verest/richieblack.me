@extends('layout.layout')

@section('title')
  Tic Tac Toe Game
@endsection

@section('css')
    <style>
        #ticTacToeCanvas {
            text-align: center;
            width:90%;
            max-width: 600px;
            border:8px #555555 solid;
            border-radius:5%;
            display: block;
            margin: 1em auto;

        }
        .button {
            display: block;
            margin:1em auto;
            border:none;
            background-color: #555555;
            color:white;
            font-size:20px;
            padding:5px 10px;
            text-align: center;
        }

        .tictactoe-container{
            width: 100%;
        }
    </style>
@endsection

@section('content')
      <!-- start tic tac toe -->
      <div class='tictactoe-container'>
        <button type='submit' class='button' id='resetButton'>Reset Game</button>
        <canvas id='ticTacToeCanvas'></canvas>
      </div>
      <!-- end tic tac toe-->
@endsection

@section('js')
    <script src="{{url("assets/js/tictactoe.js")}}"></script>
@endsection
