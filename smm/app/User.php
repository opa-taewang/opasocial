<?php
/**
 * ympnl
 * Domain: 
 * CCWORLD
 *
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'funds',
        'role',
        'status',
        'skype_id',
        'enabled_payment_methods',
        'api_token',
        'last_login',
        'group_id',
        'ip',
        'points',
        'reffund',
        'treffund',
        'verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function getReferralAttribute(){
        $name=$this->name;
        $val=substr($name, 0, 3);
        $sname= $val[0].$val[1].$val[2];
        $id=$this->id;
        return env('APP_URL').'ref/'.$sname.'/'.$id;

    }

	public function orders()
	{
		return $this->hasMany('App\\Order');
	}

	public function adminmessages()
	{
		return $this->hasMany('App\\AdminMessage', 'user_id', 'id');
	}

	public function getStatusAttribute($status)
	{
		return title_case($status);
	}

	public function getlastLoginAttribute($date)
	{
		return is_null($date) ? '' : \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
	}

	public function getCreatedAtAttribute($date)
	{
		return is_null($date) ? '' : \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->timezone(config('app.timezone'))->toDateTimeString();
	}

	public function getUpdatedAtAttribute($date)
	{
		return is_null($date) ? '' : \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->timezone(config('app.timezone'))->toDateTimeString();
	}
    public function transactions()
    {
        return $this->hasMany('App\AffiliatTransaction');
    }
    public function group()
    {
        return $this->hasOne('App\Group', 'id', 'group_id');
    }
    public function verifyUser()
    {
      return $this->hasOne('App\VerifyUser');
    }
}

?>