@if($user->role != 'ADMIN')
  <div class="btn-group">
      <a href="{{ url('/admin/users/'.$user->id.'/message') }}" class="btn btn-xs btn-success" title="Send Message">
        <i class="fa fa-comment">
        </i>
      </a>
  </div>
  <div class="btn-group">
      <a href="{{ url('/admin/users/'.$user->id.'/login') }}" class="btn btn-xs btn-primary" title="login">
        <i class="fa fa-user-secret">
        </i>
      </a> 
  </div>
  <div class="btn-group">
      <a href="{{ url('/admin/fund-records/'.$user->id) }}" class="btn btn-xs btn-info" title="Fund Records">
        <i class="fa fa-paypal">
        </i>
      </a>
  </div>
@endif
<div class="btn-group">
    <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-xs btn-warning" title="Edit">
      <span class="fa fa-edit">
      </span>
    </a>
</div>
