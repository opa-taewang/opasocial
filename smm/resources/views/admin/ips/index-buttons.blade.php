<div class="btn-group">
    <a href="{{ url('/admin/ips/'.$ip->id.'/edit') }}" class="btn btn-xs btn-warning" title="Edit">
      <span class="fa fa-edit">
      </span>
    </a>
</div>
<form method="POST"
      action="{{url('/admin/ips/'.$ip->id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
    <input name="_method" type="hidden" value="DELETE">
    {{csrf_field()}}
    <button class="btn btn-danger btn-xs btn-delete-record"
            type="button" uname="{{$ip->address}}" uid="{{$ip->id}}">
        <span class="fa fa-trash">
    </button>
</form>