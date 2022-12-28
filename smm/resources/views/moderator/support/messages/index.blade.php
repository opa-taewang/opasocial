@extends('moderator.layouts.app')
@section('title', getOption('app_name') . ' - Ticket - '.$ticket->subject)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/moderator') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/moderator/support/tickets') }}"><i class="fa fa-dashboard"></i> @lang('menus.ticket')</a></li>
                <li class="active">@lang('menus.show')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @lang('general.status'):
            <span class="label label-{{ ($ticket->status === title_case('OPEN') ) ? 'success' : 'danger'  }}">
                {{ $ticket->status }}
            </span>
            <h4><span class="label label-warning">Topic : {{$ticket->topic}}</span></h4> 
            <h4>{{ $ticket->subject }}</h4>
            <p>
                {!! $ticket->description !!}
            </p>
            Ticket By: <span class="label label-default">{{ $ticket->user->name }}</span>
            <div id="messages-container">
                @if( ! $ticketMessages->isEmpty() )
                    @foreach($ticketMessages as $ticketMessage)
                        <div class="panel panel-default panel-custom-bordered">
                            <div class="panel-heading">
                                <strong>{{ $ticketMessage->user->name }}</strong>
                                &nbsp;<span class="text-muted">{{ $ticketMessage->created_at }}</span>
                            </div>
                            <div class="panel-body">
                                {!! $ticketMessage->content !!}
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    @endforeach
                @else
                    <p>
                        @lang('general.no_messages')
                    </p>
                @endif
            </div>
            @if($ticket->status === 'Open')
                <div class="panel panel-default panel-custom-bordered">
                    <div class="panel-heading">
                        @lang('general.new_message')
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              role="form"
                              method="POST"
                              action="{{ url('/moderator/support/'.$ticket->id.'/message') }}">

                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <textarea
                                            class="form-control"
                                            id="content"
                                            name="content"
                                            rows="4"></textarea>
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button class="btn btn-block btn-warning" name='send'  type="submit" value='sendclose' style="margin-top: 5px">Send & Close</button>&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-block btn-primary" name='send'  type="submit" value='send'>Send</button>&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-block btn-danger" name='send'  type="submit" value='close'>Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('/moderator/support/'.$ticket->id.'/message') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-2">
                            <button class="btn btn-block btn-primary" name='send'  type="submit" value='reopen'>Reopen</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
<script src="/js/nicedit2/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
     new nicEditor({
        buttonList : [
        'upload'
        ]}).panelInstance('content')
    });
</script>
@endpush