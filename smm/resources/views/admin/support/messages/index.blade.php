@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Ticket - '.$ticket->subject)
@section('content')
<style>
.hr-line {
  display: flex;
  font-size:12px;
}

.hr-line:before,
.hr-line:after {
  /* color:white; */
  content: '';
  flex: 1;
  border-bottom: 0.5px solid;
  margin: auto 0.25em;
   /*box-shadow: 0 -1px; */
}
.grp-btn{
    position: absolute;
    right: 17px;
    margin-top: -4px;
}
@media only screen and (max-width: 415px) {
  .grp-btn {
    position: inherit;
  }
}
 .modal .modal-header .close{
        position: absolute;
        margin: 0px;
        right: 10px;
        top: 10px;
    }
   .modal .modal-header .modal-title{
        font-size: 19px;
    }
    .modal .form-group{
        width: 100%;
        margin: 15px;
    }
    .modal .form-group label {
        display: block;
        margin-bottom: 10px;
    }
    .modal .form-group .form-control {
        display: block;
        width: 100%;
    }
    .modal-footer {
        border-top:0px;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/support/tickets') }}"><i class="fa fa-dashboard"></i> @lang('menus.ticket')</a></li>
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
                @if($ticket->subject == "Order")
                    <h6>Order IDs: {{ $ticket->orderids }}</h6></br>
                    <h6>Request: {{ $ticket->request }}</h6></br>
                    @elseif($ticket->subject == "Payment")
                    <h6>Payment Mode: {{ $ticket->paymentmode }}</h6></br>
                    <h6>Transaction ID: {{ $ticket->transaction }}</h6></br>
                    <h6>Email/Phone: {{ $ticket->email }}</h6></br>
                    <h6>Amount Sent: {{ $ticket->amount }}</h6>
                    @endif            <p>
                {!! $ticket->description !!}
            </p>
            Ticket By: <span class="label label-default"><a style = color:#FFFFFF; href='{{ url("/admin/users/" . $ticket->user_id . "/edit") }}'>{{ $ticket->user->name }}</a></span>
            <div id="messages-container">
                @if( ! $ticketMessages->isEmpty() )
                    @foreach($ticketMessages as $ticketMessage)
                        <div class="panel panel-default panel-custom-bordered">
                            <div class="panel-heading">
                                <strong>{{ $ticketMessage->user->name }}</strong>
                                &nbsp;<span class="text-muted">{{ $ticketMessage->created_at }}</span>
                                <span class="grp-btn">
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit{{$ticketMessage->id}}">Edit</button>
                                    <div class="modal fade" id="edit{{$ticketMessage->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form method="post" action="{{url('admin/support/message/'.$ticketMessage->id)}}">
                                              {{csrf_field()}}
                                              <div class="modal-body">
                                                <div class="row col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="message">Message</label>
                                                        <textarea name="message" id="message" required class="form-control" rows="6">{{$ticketMessage->content}}</textarea>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <form method="POST" action="{{url('/admin/support/message/destroy/'.$ticketMessage->id)}}" accept-charset="UTF-8" class="form-inline" style="display: inline-block">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-xs btn-delete-record" type="button">Delete</button>
                                    </form>
                                </span>
                            </div>
                            <div class="panel-body">
                                {!! $ticketMessage->content !!}
                                @if($ticketMessage->is_read == '1')
                                            <span class="label label-success">
                Read
            </span>
            @endif
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    @endforeach
                @else
                    <p>
                        @lang('general.no_messages')
                    </p>
                @endif
            </div>
            @if($ticket->status !== 'Closed')
            
                <div class="panel panel-default panel-custom-bordered">
                    <div class="panel-heading">
                        @lang('general.new_message')
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              role="form"
                              method="POST"
                              action="{{ url('/admin/support/'.$ticket->id.'/message') }}">

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
                                    
                                    <button class="btn btn-block btn-primary" name='send'  type="submit" value='send'>Send</button>&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-block btn-warning" name='send'  type="submit" value='sendclose' style="margin-top: 5px">Send & Close</button>&nbsp;&nbsp;&nbsp;
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
                      action="{{ url('/admin/support/'.$ticket->id.'/message') }}">
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