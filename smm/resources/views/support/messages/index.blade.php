@extends('layouts.app')
@section('title', getOption('app_name') . ' - Ticket')
@section('content')
<div class="inner-dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <div class="wellHeader">
                    <h2>Subject: {{ $ticket->subject }}</h2></br>
                    

                    <span class="ticket-staus">@lang('general.status'): <span class="status-{{ ($ticket->status === title_case('OPEN') ) ? 'completed' : 'cancelled'  }}">{{ $ticket->status }}</span></span>
                </div>
                @if($ticket->subject == "Order")
                    <h6>Order IDs: {{ $ticket->orderids }}</h6></br>
                    <h6>Request: {{ $ticket->request }}</h6></br>
                    @elseif($ticket->subject == "Payment")
                    <h6>Payment Mode: {{ $ticket->paymentmode }}</h6></br>
                    <h6>Transaction ID: {{ $ticket->transaction }}</h6></br>
                    <h6>Email/Phone: {{ $ticket->email }}</h6></br>
                    <h6>Amount Sent: {{ $ticket->amount }}</h6>
                    @endif
                <div class="row ticket-message-block ticket-message-right">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <div class="msg-wrapper sent-msg">
                            <div class="ticket-message text-right">
                                <div class="message">
                                    <small class="text-muted"><i class="material-icons">access_time</i> {{ $ticket->created_at }}</small>
                                    <pre>{!! $ticket->description !!}</pre>
                                </div>
                            </div>
                        <div class="info text-right">
                            <span class="userprofpic">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <strong>{{ $ticket->user->name }}</strong>
                        </div>
                      </div>
                    </div> 
                </div>
                 @if( ! $ticketMessages->isEmpty() )
                    @foreach($ticketMessages as $ticketMessage)
                        @if($ticketMessage->user->name == "Support Team")
                        <div class="row ticket-message-block ticket-message-left">
                            <div class="col-sm-7">
                                <div class="msg-wrapper recv-msg">
                                    <div class="info text-left">
                                        <span class="userprofpic">
                                            <i class="material-icons">headset_mic</i>
                                        </span>
                                        <strong>{{ $ticketMessage->user->name }}</strong>
                                    </div>
                                    <div class="ticket-message text-left">
                                        <div class="message">
                                            <small class="text-muted"><i class="material-icons">access_time</i> {{ $ticketMessage->created_at }}</small>
                                            <pre>{!! nl2br(e($ticketMessage->content)) !!}</pre>
                                        </div>
                                    </div>
                              </div>
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        @elseif($ticketMessage->user->name == "Support Team-jon")
                        <div class="row ticket-message-block ticket-message-left">
                            <div class="col-sm-7">
                                <div class="msg-wrapper recv-msg">
                                    <div class="info text-left">
                                        <span class="userprofpic">
                                            <i class="material-icons">headset_mic</i>
                                        </span>
                                        <strong>{{ $ticketMessage->user->name }}</strong>
                                    </div>
                                    <div class="ticket-message text-left">
                                        <div class="message">
                                            <small class="text-muted"><i class="material-icons">access_time</i> {{ $ticketMessage->created_at }}</small>
                                            <pre>{!! $ticketMessage->content !!}</pre>
                                        </div>
                                    </div>
                              </div>
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        @elseif($ticketMessage->user->name == "Admin")
                        <div class="row ticket-message-block ticket-message-left">
                            <div class="col-sm-7">
                                <div class="msg-wrapper recv-msg">
                                    <div class="info text-left">
                                        <span class="userprofpic">
                                            <i class="material-icons">person_add</i>
                                        </span>
                                        <strong>{{ $ticketMessage->user->name }}</strong>
                                    </div>
                                    <div class="ticket-message text-left">
                                        <div class="message">
                                            <small class="text-muted"><i class="material-icons">access_time</i> {{ $ticketMessage->created_at }}</small>
                                            <pre>{!! $ticketMessage->content !!}</pre>
                                        </div>
                                    </div>
                              </div>
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        @elseif($ticketMessage->user->name != "Support Team")
                        <div class="row ticket-message-block ticket-message-right">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-7">
                                <div class="msg-wrapper sent-msg">
                                    <div class="ticket-message text-right">
                                        <div class="message">
                                            <small class="text-muted"><i class="material-icons">access_time</i> {{ $ticketMessage->created_at }}</small>
                                            <pre>{!! ($ticketMessage->content) !!}</pre>
                                        </div>
                                    </div>
                                <div class="info text-right">
                                    <span class="userprofpic">
                                        <i class="material-icons">account_circle</i>
                                    </span>
                                    <strong>{{ $ticketMessage->user->name }}</strong>
                                </div>
                              </div>
                            </div> 
                        </div>
                        @endif
                        
                    @endforeach
                    @else
                        <p>
                            @lang('general.no_messages')
                        </p>
                    @endif
                
                @if($ticket->status !== 'Closed')
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ url('/support/'.$ticket->id.'/message') }}">
                                {{ csrf_field() }}
                                <div class="form-group panel-border-top {{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="message" class="control-label">@lang('general.new_message')</label>
                                    <textarea class="form-control" id="content" name="content" rows="4" data-validation="required"></textarea>
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button class="btn btn-primary" type="submit">@lang('buttons.send')</button>
                            </form>
                        </div>
                    </div>
                @else
                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('/support/'.$ticket->id.'/message') }}">
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
    </div>
</div>
@endsection
@push('scripts')

@endpush