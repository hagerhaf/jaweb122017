<?php

namespace Hifone\Models;

use AltThree\Validator\ValidatingTrait;
use Cmgmyr\Messenger\Traits\Messagable;
use Hifone\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use Cmgmyr\Messenger\Models\Message as MessengerMessage;

class Message extends Model
{
	
	
	 protected $table = 'messages';
    
    public $timestamps = false;
	
	
    /* public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
	 */
	
	
	
	
	
	
}



?>