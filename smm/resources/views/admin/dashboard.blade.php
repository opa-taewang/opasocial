@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Dashboard')
@section('content')
    <link rel="stylesheet" href="/js/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style>
        .btn-default {
            color: #444;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #fff;
        }
    </style>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
      <div class="card-counter primary">
        <i class="fa fa-usd"></i>
        <span class="count-numbers">{{ getOption('currency_symbol') . number_format($totalSell,2, getOption('currency_separator'), '') }}</span>
        <span class="count-name">@lang('general.total_earning')</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-user-o"></i>
        <span class="count-numbers">{{ getOption('currency_symbol') . number_format($ttotalSell,2, getOption('currency_separator'), '') }}</span>
        <span class="count-name">Last 30 Days Earnings</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-user-o"></i>
        <span class="count-numbers">{{ getOption('currency_symbol') . number_format($totalprofit,2, getOption('currency_separator'), '')  }}</span>
        <span class="count-name">Total Profit</span>
      </div>
    </div>
        <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-user-o"></i>
        <span class="count-numbers">{{ getOption('currency_symbol') . number_format($ttotalprofit,2, getOption('currency_separator'), '')  }}</span>
        <span class="count-name">Last 30 days Profit</span>
      </div>
    </div>
              <div class="col-md-4">
      <div class="card-counter danger">
        <i class="fa fa-ticket"></i>
        <span class="count-numbers">{{ $totalrefillpending }}</span>
        
        <span class="count-name">Refill Pending</span>
        <a href="/admin/refills/list">Check Now</a>
      </div>
      
    </div>
                <div class="col-md-4">
      <div class="card-counter success">
        <i class="fa fa-envelope-o"></i>
        <span class="count-numbers">{{ $msgcnt }}</span>
        <span class="count-name">Support Pending</span>
        <a href="/admin/support/tickets">Check Now</a>
      </div>
    </div>
                <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-shopping-cart"></i>
        <span class="count-numbers">{{ $totalOrdersPending }}</span>
        <span class="count-name">@lang('general.pending_orders')</span>
        <a href="/admin/automate/send-orders">Check Now</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-tasks"></i>
        <span class="count-numbers">{{ $totalseopending }}</span>
        <span class="count-name">Pending SEO Orders</span>
        <a href="/admin/seo-orders">Check Now</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-check-circle"></i>
        <span class="count-numbers">{{ $totalOrdersCompleted }}</span>
        <span class="count-name">@lang('general.total_orders_completed')</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-ban"></i>
        <span class="count-numbers">{{ $totalOrdersCancelled }}</span>
        <span class="count-name">@lang('general.cancelled_orders')</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-archive"></i>
        <span class="count-numbers">{{ $totalOrders }}</span>
        <span class="count-name">@lang('general.total_orders')</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-counter info">
        <i class="fa fa-user-o"></i>
        <span class="count-numbers">{{ $totalUsers }}</span>
        <span class="count-name">@lang('general.total_users')</span>
      </div>
    </div>
    
    
            </div>
        </div>
        <div class="col-md-3">
            <div class="login-form">
                <div class="panel-bg">
                    @lang('general.note_to_users')
                </div>
               
                     <form method="post" action="{{ url('/admin/note') }}">
                        {{ csrf_field() }}
                        <div class=" form-group">
                            <textarea name="admin_note" class="form-control" rows="6" id="admin_note">{{ getOption('admin_note',true) }}</textarea>
                        </div>
                        <div class="form-group" style="margin-top: 30px;">
                            <button class="btn btn-primary btn-shadow">@lang('buttons.update')</button>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="/js/nicedit/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
     new nicEditor({
        fullPanel : true
        // buttonList : [
        // 'bold',
        // 'italic',
        // 'underline',
        // 'left',
        // 'center',
        // 'right',
        // 'justify',
        // 'ol',
        // 'ul',
        // 'fontSize',
        // 'fontFamily',
        // 'fontFormat',
        // 'indent',
        // 'outdent',
        // 'upload',
        // 'forecolor',
        // 'bgcolor',
        // 'link',
        // 'unlink',
        // 'removeformat',
        // 'html'
        // ]
        }).panelInstance('admin_note')
    });
</script>
@endpush