@extends('layouts.app')
@section('title', getOption('app_name') . ' - Perfectmoney')
@section('content')
<div class="inner-dashboard add-funds">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div class="wellHeader">
                    <h2>Perfect Money</h2>
                    <a class="payment-logo" href="https://perfectmoney.is/" rel="noopener noreferrer" target="_new"><img src="https://perfectmoney.is/img/logo3.png" alt="Perfectmoney" width="100" height= "26"></a>
                </div>
                <form action="{!!route('perfectmoneycartform')!!}" method="POST" >
                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount" class="control-label">Amount(USD)</label>
                        <input type="text" class="form-control" value="{{ old('amount') }}" id="amount" data-validation="number" data-validation-allowing="float" name="amount">
                        @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <button type="submit" class="btn btn-primary submit-btn"><span>Pay</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection