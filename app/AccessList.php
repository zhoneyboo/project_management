<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;

class AccessList extends Model
{
	protected $dates = ['deleted_at'];
	use SoftDeletes;

	
    protected $fillable = [
    	'access_key',
    	'access_name',
		'description',
    ];

    
}
