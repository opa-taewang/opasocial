@if($refill->status == 'IN PROGRESS' || $refill->status == 'PENDING') 
 @if($refill->status == 'PENDING')
   <div class="btn-group">
      <a href="{{ url('/moderator/refill/'. $refill->rid . '/start') }}"
         class="btn btn-xs btn-primary" title="@lang('new.statustoinprogress')">
          <i class="fa fa-play"></i>
      </a>
    </div>  
  @endif
  <div class="btn-group">
    <a href="{{ url('/moderator/refill/'. $refill->rid . '/complete') }}"
       class="btn btn-xs btn-primary" title="@lang('general.completerefill')">
          <i class="fa fa-check"></i>
    </a>
  </div>
  <div class="btn-group">
    <a href="{{ url('/moderator/refill/'. $refill->rid . '/cancel') }}"
       class="btn btn-xs btn-primary" title="@lang('general.cancelrefill')">
          <i class="fa fa-ban"></i>
    </a>
  </div>
@endif
