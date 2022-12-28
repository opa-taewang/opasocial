<style type="text/css">
.btn-delete-record{
    border-top-left-radius: 3px !important; 
    border-bottom-left-radius: 3px !important; 
}
element.style {
}
.btn-xs, .btn-group-xs > .btn {
    padding: 5px;
    font-size: 11px;
}
.btn {
    padding: 7px 12px;
}
.btn-group-xs>.btn, .btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
</style>
<a href="{{ url('/admin/service/package/'.$id.'/up') }}"
   class="btn btn-xs btn-success"
   title="Up"><span class="fas fa-caret-square-up"></span></a>
<a href="{{ url('/admin/service/package/'.$id.'/down') }}"
   class="btn btn-xs btn-success"
   title="Down"><span class="fas fa-caret-square-down"></span></a>
<a href="{{ url('/admin/packages/'.$id.'/edit') }}"
   class="btn btn-xs btn-primary"
   title="Edit"><span class="fa fa-edit"></span></a>&nbsp;
<form method="POST"
      action="{{url('/admin/packages/'.$id)}}"
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
