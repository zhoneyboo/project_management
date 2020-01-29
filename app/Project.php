<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'title',
		'control_number',
		'mode_of_implementation',
        'loc_barangay',
        'loc_municipality',
		'implementing_agency',
		'other_implementing_agency',
		'municipality',
		'fund_source',
        'fund_source_year',
		'sector',
		'project_cost',
		'status',
		'monitored_by',
		'monitoring_status',
		'date_monitored',
		'link',
        'contractor'
    ];

    public function rel_implementing_agency()
    {
    	return $this->hasOne('App\ImplementorAgencyList','id', 'implementing_agency');
    }

    public function location_barangay()
    {
        return $this->hasOne('App\Barangay', 'id', 'loc_barangay');
    }
    public function location_municipality()
    {
        return $this->hasOne('App\Municipality', 'id', 'loc_municipality');
    }
    public function rel_municipality()
    {
    	return $this->hasOne('App\Municipality', 'id','municipality');
    }

    public function rel_monitor_by()
    {
    	return $this->hasOne('App\MonitoredByList', 'id', 'monitored_by');
    }

    public function getProjectCostAttribute($value)
    {
    	return number_format($value, 2);
    }


    public function getDateMonitoredAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }
        return date('F d, o', strtotime($value));
    }
}

