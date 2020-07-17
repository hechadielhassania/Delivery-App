<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelivererRegionsCities extends Model
{
    protected $fillable = [
    	'deliverer_id',
    	'region_id',
    	'city_id',
    	'dilever_to_all_region_city',
        'name', 
    ];

    /**
     * Get the diliverer that owns the delivering city.
     */
    function deliverer(){
    	return $this->belongTo('App\User');
    }

    /**
     * The regions that belong to the deliverer.
     */
    public function regions()
    {
        return $this->belongsToMany('App\DeliveryRegions');
    }

    /**
     * The cities that belong to the deliverer.
     */
    public function cities()
    {
        return $this->belongsToMany('App\DeliveryRegionCities', 'city_id');
    }
}
