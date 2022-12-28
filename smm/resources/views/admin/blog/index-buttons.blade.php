<div class="btn-group">
    <a href="{{ url('/admin/blog/'.$post->id.'/show') }}" class="btn btn-xs btn-warning" title="Veiw">
      <span class="fa fa-eye">
      </span>
    </a>
</div>
<div class="btn-group">
    <a href="{{ url('/admin/blog/'.$post->id.'/edit') }}" class="btn btn-xs btn-warning" title="Edit">
      <span class="fa fa-edit">
      </span>
    </a>
</div>
<form method="POST"
      action="{{url('/admin/blog/'.$post->id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
    <input name="_method" type="hidden" value="DELETE">
    {{csrf_field()}}
    <button class="btn btn-danger btn-xs btn-delete-record"
            type="button" uname="{{$post->title}}" uid="{{$post->id}}">
        <span class="fa fa-trash">
    </button>
</form>