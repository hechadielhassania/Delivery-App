<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryRegionCities extends Model
{
    protected $fillable = [
    	'region_id',
        'name', 
    ];

    /**
     * Get the region that owns the city.
     */
    function region(){
    	return $this->belongTo('App\DeliveryRegions');
    }

    /**
     * The deliverers that belong to the city.
     */
    public function deliverer()
    {
        return $this->belongsToMany('App\User');
    }
}
