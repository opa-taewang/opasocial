@if ($point->status == 'Pending')
<form method="POST"
      action="{{url('/admin/users/point-funds/'.$point->id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
   <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <button class="btn btn-xs btn-success"
            type="submit">
        <span class="fa fa-check">
    </button>
</form>
<form method="POST"
      action="{{url('/admin/users/point-fundsreject/'.$point->id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
   <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <button class="btn btn-xs btn-danger"
            type="submit">
        <span class="fa fa-window-close">
    </button>
</form>
@endif