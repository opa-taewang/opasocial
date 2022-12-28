@extends('layouts.app')
@section('title', getOption('app_name') . ' - Services')
@section('content')
<script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@4"></script>
<script src="/js/vendor/clipboard/clipboard.min.js?v={{ config('constants.VERSION')}} "></script>
<script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.validate({
                modules: 'date',
                validateOnBlur: false,
                lang: '{{ getOption('language') }}'
            });

            $(document).on('click','.dropdown-lang a',function (e) {
                e.preventDefault();
                var locale = $(this).data('locale');
                $('#locale').val(locale);
                document.getElementById('lang-form').submit();
            });
            $(document).on('click','.dropdown-currency a',function (e) {
                e.preventDefault();
                var locale = $(this).data('locale');
                $('#locale').val(locale);
                document.getElementById('currency-form').submit();
            });
    var clipboard = new ClipboardJS('.btn');
clipboard.on('success', function(e) {
  alert("Copied");
    
});

clipboard.on('error', function(e) {
   alert("Failed to Copy");
});
  });
</script>
<div class="inner-dashboard servicePage">
    <div class="row">
        <div class="col-lg-12">
            <div class="well table-well">
                <div class="table-responsive">
                    <table class="serviceTable table table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Referral Link</th>
                                <th class="text-center">Commission Rate</th>
                                <th class="text-center">Minimum Payout</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$link}}</td>
                                <td class="text-center"><span style="color:#4510c2;">{{$commission[0]->commission_val}}%</span></td>
                                @php
$data=convertCurrency($commission[0]->min_payout);
@endphp
                                <td class="text-center"><span style="color:#2096f3;">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="well table-well">
                <div class="table-responsive">
                    <table class="serviceTable table table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Total Registrations</th>
                                <th class="text-center">Unpaid referrals</th>
                                <th class="text-center">Paid referrals</th>
                                <th class="text-center">Total earnings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><span style="color:#96119e">{{$visits}}</span></td>
                                @php
                                $unpaid = (Auth::user()->treffund) - ( Auth::user()->reffund);
$data=convertCurrency($unpaid);
@endphp
                                <td class="text-center"><span style="color:#2096f3;">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span></td>
                                @php
$data=convertCurrency(Auth::user()->reffund);
@endphp
                                <td class="text-center"><span style="color:#4510c2;">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span></td>
         @php
$data=convertCurrency(Auth::user()->treffund);
@endphp                       
                                <td class="text-center"><span style="color:#1ec80f">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
