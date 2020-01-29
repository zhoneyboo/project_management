<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationFacilities extends Model
{
    protected $fillable = [
    	"facilities",
		"province",
		"calapan",
		"year",
    ];
}
