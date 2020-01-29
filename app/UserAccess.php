<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class UserAccess extends Model
{


	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
    protected $fillable = [
					    	'user_id',
					    	'access_id'
					    ];

	public function access()
	{
		return $this->hasOne('App\AccessList','id','access_id');
	}

}
