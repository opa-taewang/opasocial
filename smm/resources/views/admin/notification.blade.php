@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Notification')
@section('content')
    <style>
        .btn-default {
            color: #444;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #fff;
        }
    </style>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <h1>{{$notification->title}}</h1>
                <hr>
                <p>{!! $notification->description !!}</p>
                <hr>
                {!! $notification->details !!}
                <hr>
                <p>Date: {{date('d-F-Y, g:i a', strtotime($notification->created_at))}}</p>
            </div>
        </div>
    </div>
@endsection