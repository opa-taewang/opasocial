@extends('layouts.app')
@section('title', getOption('app_name') . ' - Coupon')
@section('content')
<style>
.faqPage .panel-default .panel-heading .panel-title a::before {
    content: '$';
    font-size: 38px;
    color: #96119e33;
    position: absolute;
    top: 6px;
    left: 12px;
    font-weight: 700;
}
</style>
<div class="inner-dashboard faqPage">
  <div class="row">
    <div class="col-md-12">
      <div class="well">
        <div class="wellHeader">
            <h2>Coupon Codes <small>(Free Gifts)</small></h2>
        </div>
        
          <div class="panel panel-default" id="accordion">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse2">Coupon For 50$ Deposit And More.</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse2" style="height: 0px;">
              <div class="panel-body">
                USE Code <b>instaraja_1000J29</b><br>
                1 Coupon Per User.<br>
                Must Use the Coupon within 12 hrs after deposit. Else Coupon Expires.<br>
                Total No of Coupons - UNLIMITED.<br>
                Coupon Code Value - 2$.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse3">Coupon For 100$ Deposit And More.</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
              <div class="panel-body">
                 USE Code <b>instaraja_3500J29</b><br>
                 1 Coupon Per User.<br>
                Must Use the Coupon within 12 hrs after deposit. Else Coupon Expires.<br>
                Total No of Coupons - UNLIMITED.<br>
                Coupon Code Value - 5$.
              </div>
            </div>
          </div>
          
        <div style="text-align: center;">
          <span>For Bulk Purchase of Coupons for your followers or Subscribers or for Gifting Someone: <a
              href="http://opasocial.com/support">Contact us</a></span>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="row">
 <div class="col-sm-12">
            <div class="well">
                <div class="panel panel-default">
                    <div style="text-align: center;">
                        <span class="col-sm-6 col-sm-offset-3">
                            <img src="{{ url('images/coupon.png') }}" alt="Coupon" width="100" height= "100">
                        </span>
                </div>
    
                    <div class="panel-body text-center">
                        <form action="{!!route('couponcartform')!!}" class="col-sm-6 col-sm-offset-3" method="POST" >
                        <div style="margin-top: 40px;" class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <label for="coupon" class="control-label">Coupon Code</label>
                            <input type="text" class="form-control" value="{{ old('coupon') }}" id="coupon" name="coupon" required>
                            @if ($errors->has('coupon'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top:15px;">
                            <button type="submit" class="btn btn-primary btn-block submit-btn"><span>Submit</span></button>
                        </div>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection