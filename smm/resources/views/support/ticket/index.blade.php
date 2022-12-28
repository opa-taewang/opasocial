@extends('layouts.app')
@section('title', getOption('app_name') . ' - Support Tickets')
@section('content')
<style>
    .dataTables_filter { display: none; }
</style>
    <div class="inner-dashboard ticketWa">
        <div class="row">
            <div class="col-sm-12">
<div class="tab-content" style="padding-top: 15px">
 <div id="featured" class="tab-pane fade in active" role="tabpanel">                
               <div class="well">
                    <div class="wellHeader">
                        <h2>General Info</h2>
                    </div>
<p><b><font color="#4510C2">
Support Hours: </font><br />Business Hours (Mon - Sat) 10:00 AM to 10:00 PM WAT( West African Time)</br/><font color="#4510C2">
Your order not started?</font><br /> First be sure you added it in right format!<br /><font color="#4510C2">
Reporting an order related problem ? </font><br />Be sure your order is at least 24 hours old as we check a order manually only if its 24 hours old even if the service is supposed to be instant!<br />
<font color="#4510C2">Your order is Partial?</font> <br />If status Partial it means system can't give more likes/followers/views to current page and money automatically refunded for remains likes/followers/views. It can happen due to server problem or if your total order is more then servers total capacity . Please order in different server in that case or you can try placing it again 12-24 hours later.</b></p>
                     <br><br>
                     <div class="wellHeader">
                        <h2>Create New Ticket</h2>
                    </div>
                    <br>
                    <form role="form" method="POST" action="{{ url('/support/ticket/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                            <label for="topic" class="control-label"><b>Subject</b></label>
                            <div class="row">
                                <div class="col">
                                    <span class="custom-control">
                                        <input type="radio" class="custom-control-input subject ticket-options" id="subjectOrder" name="topic" value="Order" checked="checked">
                                        <label class="custom-control-label ticket-options-label" for="subjectOrder">Order</label>
                                    </span>
                                </div>
                                <div class="col">
                                    <span class="custom-control">
                                        <input type="radio" class="custom-control-input subject ticket-options" id="subjectPayment" name="topic" value="Payment">
                                        <label class="custom-control-label ticket-options-label" for="subjectPayment">Payment</label>
                                    </span>
                                </div>
                                <div class="col">
                                    <span class="custom-control">
                                        <input type="radio" class="custom-control-input subject ticket-options" id="subjectReseller" name="topic" value="Reseller">
                                        <label class="custom-control-label ticket-options-label" for="subjectReseller">Reseller Support</label>
                                    </span>
                                </div>
                                <div class="col">
                                    <span class="custom-control">
                                        <input type="radio" class="custom-control-input subject ticket-options" id="subjectOthers" name="topic" value="Others">
                                        <label class="custom-control-label ticket-options-label" for="subjectOthers">Others</label>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group ordernumbers account">
                            <label for="orderids"><b>Order ID: </b></label>
                                <input id="orderids" type="text" class="form-control" name="orderids" value="{{ old('orderids') }}" placeholder="(For multiple orders,(eg: 12345,12345,12345))">
                         </div>
                                 <div class="form-group type therequest">
                                     <label for="type"><b>Request</b></label>
                                         <div class="row">
                                             <div class="col">
                                                 <span class="custom-control">
                                                      <input type="radio" class="custom-control-input ticket-options" id="requestRefill" name="request" value="Refill" checked="checked">
                                                      <label class="custom-control-label" for="requestRefill">Refill</label>
                                                  </span>
                                              </div>
                                              <div class="col">
                                                  <span class="custom-control">
                                                      <input type="radio" class="custom-control-input ticket-options" id="requestCancel" name="request" value="Cancel">
                                                      <label class="custom-control-label" for="requestCancel">Cancel</label>
                                                   </span>
                                               </div>
                                               <div class="col">
                                                <span class="custom-control">
                                                        <input type="radio" class="custom-control-input ticket-options" id="requestSpeed" name="request" value="Speed Up">
                                                        <label class="custom-control-label" for="requestSpeed">Speed Up</label>
                                                 </span>
                                                </div>
                                                <div class="col">
                                                    <span class="custom-control">
                                                          <input type="radio" class="custom-control-input ticket-options" id="requestRestart" name="request" value="Restart">
                                                          <label class="custom-control-label" for="requestRestart">Restart</label>
                                                    </span>
                                                </div>
                                           </div>
                                           <div class="row">
                                                 <div class="col">
                                                    <span class="custom-control">
                                                        <input type="radio" class="custom-control-input ticket-options" id="requestNotStarted" name="request" value="Not Started">
                                                        <label class="custom-control-label" for="requestNotStarted">Not Started</label>
                                                    </span>
                                                  </div>
                                                   <div class="col">
                                                      <span class="custom-control">
                                                          <input type="radio" class="custom-control-input ticket-options" id="requestRemoveAutoRefill" name="request" value="Remove Auto Refill">
                                                          <label class="custom-control-label" for="requestRemoveAutoRefill">Remove Auto Refill</label>
                                                       </span>
                                                    </div>
                                                    <div class="col">
                                                       <span class="custom-control">
                                                        <input type="radio" class="custom-control-input ticket-options" id="requestMarkCompleted" name="request" value="Marked as completed without done">
                                                        <label class="custom-control-label" for="requestMarkCompleted">Marked as completed without done</label>
                                                       </span>
                                                    </div>
                                                    <div class="col">
                                                        <span class="custom-control">
                                                        <input type="radio" class="custom-control-input ticket-options" id="requestOther" name="request" value="Other">
                                                        <label class="custom-control-label" for="requestOther">Other</label>
                                                        </span>
                                                    </div>
                                                </div>
                                           </div>
<div class="form-group payment" style="display: none;">
<label for="payment"><b>Payment</b></label>
<div class="row">
<div class="col">
<span class="custom-control">
<input type="radio" class="custom-control-input ticket-options" id="paymentPayTM" name="paymentmode" value="PayTM" checked="checked">
<label class="custom-control-label" for="paymentPayTM">FlutterWave</label>
</span>
</div>
<div class="col">
<span class="custom-control">
<input type="radio" class="custom-control-input ticket-options" id="paymentPhonePe" name="paymentmode" value="PhonePe">
<label class="custom-control-label" for="paymentPhonePe">Coinpayments</label>
</span>
</div>
<div class="col">
<span class="custom-control">
<input type="radio" class="custom-control-input ticket-options" id="paymentBank" name="paymentmode" value="Bank">
<label class="custom-control-label" for="paymentBank">Bank/Manual</label>
</span>
</div>

</div>
</div>
<div class="form-group payment">
<label for="transaction"><b>Transaction ID: </b></label>
<input id="transaction" type="text" class="form-control" name="transaction" value="">
</div>
<div class="form-group payment">
<label for="email"><b>Email/Phone: </b></label>
<input id="email" type="text" class="form-control" name="email" value="">
</div>
<div class="form-group payment">
<label for="amount"><b>Amount: </b></label>
<input id="amount" type="text" class="form-control" name="amount" value="">
</div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label"><b>@lang('forms.description')</b></label>
                            <textarea class="form-control" id="description" name="description" style="height: 150px;" rows="10" data-validation="required">{{ old('subject') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">@lang('buttons.create')</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4  col-md-offset-8 ">
                <div class="search-group">
                    <input id="dataSearchBox" type="text" name="search" class="form-control searchTerm" value="" placeholder="Search tickets">
                    <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mtn10">
                <div class="well">
                    <div class="table-responsive">
                        <table class="table table-sm mydatatable" style="width: 99.9%">
                            <thead class="thead-dark">
                            <tr>
                                <th>@lang('general.ticket_id')</th>
                                <th>@lang('general.subject')</th>
                                <th>@lang('general.status')</th>
                                <th>Last Updated</th>
                                <!--<th>@lang('general.description')</th>-->
                                <!--<th>@lang('general.new_messages')</th>-->
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
@push('scripts')
    <script>
        $(function () {
            var table = $('.mydatatable').DataTable({
               processing: true,
                serverSide: true,
                pageLength: 25,
                lengthChange: false,
                info: false,
                order: [ [3, 'desc'] ],
                ajax: '{!! url('/support-index/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'subject', name: 'subject', sortable:false},
                    {data: 'status', name: 'status'},
                    {data: 'updated_at', name: 'updated_at'}
                    //{data: 'description', name: 'description', sortable:false},
                    //{data: 'unread_message_count', name: 'unread_message_count', sortable:false, searchable:false},
                    
                ],
                
                aoColumnDefs: [ {
                     aTargets: [ 1 ],
                     mRender: function ( data, type, full ) {
                      return $("<div/>").html(data).text(); 
                      }
                } ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
               table.search( this.value ).draw();
            });
        })
        
    $('#sub').click(function () {
            $button = $(this);
            console.log($button);
            $button.prop("disabled", true);
            if($button[0].type == 'submit'){
                $button.parents('form').submit();
            }
            setTimeout(function(){$button.prop("disabled", false);},5000);
        }); 
        $(function(){
        $('.ordernumbers').show();
        $('.type').show();
        $('.payment').hide();
    });
    $("input:radio[name='topic']").change(function (){
        var topic = $("input:radio[name='topic']:checked").val();
        if (topic == 'Order') {
            $('.ordernumbers').show();
            $('.type').show();
            $('.payment').hide();
        }else if (topic == 'Payment') {
            $('.ordernumbers').hide();
            $('.type').hide();
            $('.payment').show();
        }else if (topic == 'Account') {
            $('.ordernumbers').hide();
            $('.account').show();
            $('.type').hide();
            $('.payment').hide();
        }else{
            $('.ordernumbers').hide();
            $('.type').hide();
            $('.payment').hide();
        }
    });

    </script>
@endpush