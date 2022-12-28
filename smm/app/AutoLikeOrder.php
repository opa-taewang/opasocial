<?php


namespace App;

class AutoLikeOrder extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function master()
    {
        return $this->belongsTo("App\\AutoLike", "id", "master_id");
    }
    public function orderslaves()
    {
        return $this->belongsTo("App\\Order", "id", "slave_id");
    }
    public function dripfeedslaves()
    {
        return $this->belongsTo("App\\DripFeed", "id", "slave_id");
    }
}

?>