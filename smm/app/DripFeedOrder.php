<?php


namespace App;

class DripFeedOrder extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function master()
    {
        return $this->belongsTo("App\\DripFeed", "id", "master_id");
    }
    public function slaves()
    {
        return $this->belongsTo("App\\Order", "id", "slave_id");
    }
}

?>