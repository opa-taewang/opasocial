<a href="{{ url('/admin/currency/edit/'.$id) }}"
   class="btn btn-xs btn-primary"
   title="Edit"><span class="fui-new"></span></a>
<form method="POST"
      action="{{url('/admin/currency/delete/'.$id)}}"
      accept-charset="UTF-8"
      class="form-inline"
      style="display: inline-block">
    <input name="_method" type="hidden" value="DELETE">
    {{csrf_field()}}
    <button class="btn btn-danger btn-xs btn-delete-record"
            type="button">
        <span class="fui-trash"></span>
    </button>
</form>