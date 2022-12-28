@extends('errors::layout')

@section('title', 'License Invalid Error')

@section('message')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <div style="font-size: 22px">
    <span><b>{{getOption('notice_error')}}</b></span><br/>
    
    </div>
@endsection