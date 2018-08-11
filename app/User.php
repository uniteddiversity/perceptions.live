<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'web', 'role_id', 'status_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is($roleName)
    {
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function content()
    {
        return $this->hasMany('App\Content')->where('contents.status', '<>', 1);
    }

    public function status()
    {
        return $this->belongsTo('App\UserStatus','status_id');
    }

    public function groups()
    {
        return $this->hasMany('App\UserGroup','user_id');
    }

    public function image()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','users')
            ->where('status','=','1')
            ->where('submission_type','=','avatar');
    }
}
