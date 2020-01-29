<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoconutProduction extends Model
{
    protected $fillable = [
    	'municipality',
		'no_of_coconut_farmers',
		'coconut_area',
		'no_of_coco_trees',
		'non_bearing',
		'bearing',
		'nut_tree_year',
		'wholenuts',
		'copra_equivalent',
		'year',
    ];
}
