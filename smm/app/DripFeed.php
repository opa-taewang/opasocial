<?php


namespace App;

class DripFeed extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo("App\\User");
    }
    public function orders()
    {
        return $this->hasManyThrough("App\\Order", "App\\DripFeedOrder", "master_id", "id", "id", "slave_id");
    }
    public function activerun()
    {
        return $this->hasOne("App\\Order", "id", "active_run_id");
    }
    public function package()
    {
        return $this->belongsTo("App\\Package");
    }
    public function getStatusAttribute($status)
    {
        return title_case($status);
    }
    public function getCreatedAtAttribute($date)
    {
        return is_null($date) ? "" : \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $date)->timezone(config("app.timezone"))->toDateTimeString();
    }
    public function getUpdatedAtAttribute($date)
    {
        return is_null($date) ? "" : \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $date)->timezone(config("app.timezone"))->toDateTimeString();
    }
}

?>