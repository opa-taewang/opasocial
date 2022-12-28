@extends('layouts.app')
@section('title', getOption('app_name') . ' - Admin Messages')
@section('content')
    <div class="inner-dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <h4 class="panel-heading">@lang('new.messagefromadmin')</h4>
                    <div class="note-from-admin-body">
                        {!! $note !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
