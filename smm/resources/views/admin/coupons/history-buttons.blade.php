
<form method="POST"
      action="{{url('/admin/coupons/history'.$coupon->id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
    <input name="_method" type="hidden" value="DELETE">
    {{csrf_field()}}
    <button class="btn btn-danger btn-xs btn-delete-record"
            type="button" uname="{{$coupon->id}}" uid="{{$coupon->id}}">
        <span class="fa fa-trash">
    </button>
</form>