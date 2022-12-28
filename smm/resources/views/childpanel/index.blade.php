@extends('layouts.app')
@section('title', getOption('app_name') . ' - My Panels')
@section('content')
    @php
        $status = $status ?? false;
        $dataURL = $status ? "/panels-filter-ajax/$status/data" : "/panelorders-index/data";
    @endphp
    <style>
        .dataTables_filter { display: none; }
    </style>
        <style>
.neworderPage .badge {
    position: relative;
    padding: 1.75rem 1.25rem !important;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem !important;
    display: grid;
    white-space: pre-line;
}
.neworderPage .badge-primary {
    color: #004085 !important;
    background-color: #cce5ff !important;
    border-color: #b8daff !important;
}
.neworderPage .badge-info {
    color: #0c5460 !important;
    background-color: #d1ecf1 !important;
    border-color: #bee5eb !important;
    display:block;
}
.neworderPage .badge-warning {
    color: #856404 !important;
    background-color: #fff3cd !important;
    border-color: #ffeeba !important;
}
.neworderPage .m10 {
    margin-top:10px;
}
.neworderPage .pl10 {
    padding-left:10px;
}
.neworderPage .tab-pane {
    overflow:hidden;
}
.inner-dashboard.neworderPage .tab-content {
    height: unset;
    min-height: unset;
    max-height: unset;
}
.inner-dashboard.servicePage.orderPage {
    margin-top: 0px;
    padding-top: 0px;
}
.toggle-button-cover
{
    display: table-cell;
    position: relative;
    width: 118px;
    box-sizing: border-box;
    left: 80px;
    top: -11px;
}

.button-cover
{
    background-color: #fff;
    box-shadow: 0 10px 20px -8px #c5d6d6;
    border-radius: 4px;
}

.button-cover:before
{
    position: absolute;
    right: 0;
    bottom: 0;
    color: #d7e3e3;
    font-size: 12px;
    line-height: 1;
    padding: 5px;
}

.button-cover, .knobs, .layer
{
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.button
{
    position: relative;
    top: 50%;
    width: 74px;
    height: 36px;
    margin: -20px auto 0 auto;
    overflow: hidden;
}

.button.r, .button.r .layer
{
    border-radius: 100px;
}

.checkbox
{
    position: relative;
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    opacity: 0;
    cursor: pointer;
    z-index: 3;
}

.knobs
{
    z-index: 2;
}

.layer
{
    width: 100%;
    background-color: #fcebeb;
    transition: 0.3s ease all;
    z-index: 1;
}
.table .layer
{
    border: 0.3px solid #d43f3a;
}


/* Button 4 */
#button-4 .knobs:before, #button-4 .knobs:after
{
    position: absolute;
    top: 4px;
    left: 4px;
    width: 30px;
    height: 28px;
    color: #fff;
    font-size: 10px;
    font-weight: bold;
    text-align: center;
    line-height: 1;
    padding: 9px 4px;
    background-color: #F44336;
    border-radius: 50%;
    transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
}

#button-4 .knobs:before
{
    content: 'NO';
}

#button-4 .knobs:after
{
    content: 'Yes';
}

#button-4 .knobs:after
{
    top: -28px;
    right: 4px;
    left: auto;
    background-color: #FFD700;
}

#button-4 .checkbox:checked + .knobs:before
{
    top: -28px;
}

#button-4 .checkbox:checked + .knobs:after
{
    top: 4px;
}

#button-4 .checkbox:checked ~ .layer
{
    background-color: #ffd70029;
}
.table #button-4 .checkbox:checked ~ .layer
{
    border: 0.3px solid #FFD700;
}
.toggle-button-cover.table {top:0px;left:0px;}
</style>
<div class="inner-dashboard neworderPage">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success">
                <p>You can now buy a child panel for <strong>{{(isset($amount))?$amount:'null'}}</strong> per month! (deducted from your balance). A child panel is your own website to sell SMM Services. You will simply connect it to us and sell directly to your clients!</p>
            </div>
            <div class="well ">
                <div class="wellHeader">
                    <h2>Buy Your Own Panel </h2>

                     <!--   <div class="pull-right">
                            <a href="https://child.instaraja.com" target="_blank" class="btn btn-primary btn-sm"> Demo</a>
                        </div> -->
                </div>
               
                <form role="form" method="POST" action="{{ url('/child-panels') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                        <label for="domain" class="control-label">Domain</label>
                        <input name="domain" id="domain" value="{{ old('domain') }}" type="text" data-validation="required" class="form-control">
                        @if ($errors->has('domain'))
                            <span class="help-block">
                            <strong>{{ $errors->first('domain') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="alert alert-info">
                            Please visit your Domain registrar's dashboard to change nameservers to:<br>
                            <strong><div class="host-address">ns1.hostndots.com</div></strong>
                            <strong><div class="host-address">ns2.hostndots.com</div></strong>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('admin_user') ? ' has-error' : '' }}">
                        <label for="admin_user" class="control-label">Admin Email</label>
                        <input name="admin_user" id="admin_user" value="{{ old('admin_user') }}" type="email" data-validation="required" class="form-control">
                        @if ($errors->has('admin_user'))
                            <span class="help-block">
                            <strong>{{ $errors->first('admin_user') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Admin Password</label>
                        <input name="password" id="password"  type="password" data-validation="required" class="form-control">
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('$panel->status') ? ' has-error' : '' }}">
                        <label for="confirmed" class="control-label">Confirm Password</label>
                        <input name="confirmed" id="confirmed" type="password" data-validation="required" class="form-control">
                        @if ($errors->has('confirmed'))
                            <span class="help-block">
                            <strong>{{ $errors->first('confirmed') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="text" value="{{(isset($amount))?$amount:''}}" class="form-control" readonly disabled/>
                        </div>
                    <div class="form-group">
                                        <label for="renew" class="control-label">Auto Renew</label>
                                        <div class="toggle-button-cover">
                                          <div class="button-cover">
                                            <div class="button r" id="button-4">
                                              <input type="checkbox" class="checkbox" name="renew" id="renew">
                                              <div class="knobs"></div>
                                              <div class="layer"></div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                    <button type="submit" class="btn btn-primary">Submit Order</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
    <div class="inner-dashboard orderPage">
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="{{ $status == false ? 'active' : '' }}"><a href="{{ url('/child-panels/') }}">ALL</a></li>
                        <li class="{{ $status == 'inprogress' ? 'active' : '' }}"><a href="{{ url('/panels-filter/inprogress') }}">In Progress</a></li>
                        <li class="{{ $status == 'completed' ? 'active' : '' }}"><a href="{{ url('/panels-filter/completed') }}">Completed</a></li>
                        <li class="{{ $status == 'cancelled' ? 'active' : '' }}"><a href="{{ url('/panels-filter/submitted') }}">Submitted</a></li>
                        
                    </ul>
                    <div class="table-responsive">
                        
                        
                        <table class="orderTable table table-sm mydatatable" style="width:99.9%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ORD.ID</th>
                                    <th><i class="material-icons">insert_link</i> Domain</th>
                                    <th><i class="material-icons">person</i> Admin User</th>
                                    <th><i class="material-icons">security</i> Admin Password</th>
                                    <th><i class="material-icons">money</i> Amount</th>
                                    <th>Status</th>
                                    <th>Auto Renew</th>
                                    <th><i class="material-icons">update</i> Panel Start Date</th>
                                    <th><i class="material-icons">update</i> Panel Due Date</th>
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
    <script>
        $(function () {
            
            var daataTable = $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                ordering: false,
                info: false,
                pageLength: 25,
                order: [ [0, 'desc'] ],
                ajax: '{!! url($dataURL) !!}',
                columns: [
                    {
                        data: 'id', 
                        name: 'id',
                        sortable:true
                    },
                    {
                        data: 'domain', 
                        name: 'domain', 
                        sortable:false
                    },
                    {
                        data: 'admin_user', 
                        name: 'admin_user', 
                        sortable:false
                    },
                    {
                        data: 'admin_password', 
                        name: 'admin_password', 
                        sortable:false
                    },
                    {
                        data: 'amount', 
                        name: 'amount', 
                        sortable:false
                    },
                    {
                        data: 'status',
                        // render : function(data, type, row) {
                        //     return '<span class="mycus-class2">'+data+'</span>'
                        // },
                        name: 'status',
                        sortable:false
                    },{
                        data: 'renew',
                        render : function(data, type, row) {
                            if(parseInt(data)==1) {
                                return '<div class="toggle-button-cover table"><div class="button-cover"><div class="button r" id="button-4"><input data-renewid="'+row['id']+'" type="checkbox" class="checkbox" checked onclick="autorenew(this)"><div class="knobs"></div><div class="layer"></div></div></div></div>';
                            } else {
                                return '<div class="toggle-button-cover table"><div class="button-cover"><div class="button r" id="button-4"><input data-renewid="'+row['id']+'" type="checkbox" class="checkbox"  onclick="autorenew(this)"><div class="knobs"></div><div class="layer"></div></div></div></div>';
                            }
                        },
                        name: 'renew',
                        sortable:false
                    },
                    {
                        data: 'start_at',
                        name: 'start_at',
                        sortable:true
                    },{
                        data: 'expiry_at',
                        name: 'expiry_at',
                        sortable:true
                    }
                ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
               daataTable.search( this.value ).draw();
            });
        })
        function autorenew(el) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var renew=el.checked?1:0;
            $.ajax({
                url: document.location.origin+'/childpanel/'+$(el).attr('data-renewid')+'/renew',
                type: 'POST',
                data: {_token: CSRF_TOKEN, renew:renew},
                dataType: 'JSON',
                success: function (data) { 
                    swal("Success!", "Status Updated!", "success");
                },error:function(err){
                    swal("Failed!", "Status not updated!", "error");
                }
            });
        }
    </script>
@endpush