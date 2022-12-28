@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - View Post')
@section('content')
<style>
    .ed-youtube {
        height: 400px;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/blog') }}"> Posts</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <h1>{{$post->title}}</h1>
            </div>
            <div class="row">
                <img src="{{ ($post->image)?asset('blog/images/'.$post->image):'http://placehold.it/750x420' }}" style="width: 750px; height: 420px;" />
            </div>
            <hr>
            <div class="row">
                {{ $post->short_description }}
            </div>
            <hr>
            <div class="row">
                {!! $post->description !!}
            </div>
        </div>
@endsection