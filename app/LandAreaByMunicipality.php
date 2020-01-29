<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandAreaByMunicipality extends Model
{
    protected $fillable = ['municipality','land_area','year'];
}
