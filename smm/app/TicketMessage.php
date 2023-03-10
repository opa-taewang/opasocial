<?php


namespace App;

class TicketMessage extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ["content", "user_id", "ticket_id", "is_read"];
    public function ticket()
    {
        return $this->belongsTo("App\\Ticket");
    }
    public function user()
    {
        return $this->belongsTo("App\\User");
    }
    public function getCreatedAtAttribute($date)
    {
        return is_null($date) ? "" : \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $date)->timezone(config("app.timezone"))->diffForHumans();
    }
    public function getUpdatedAtAttribute($date)
    {
        return is_null($date) ? "" : \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $date)->timezone(config("app.timezone"))->diffForHumans();
    }
}

?>