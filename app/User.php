<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'implementor', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function access()
    {
        return $this->hasMany('App\UserAccess', 'user_id','id');
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y h:i:s a', strtotime($value));
    }


     public function getUpdatedAtAttribute($value){
        return date('F j, Y h:i:s a', strtotime($value));
    }



    
}
