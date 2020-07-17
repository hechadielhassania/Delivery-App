<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryRegions extends Model
{
    protected $fillable = [
    	'name',
    ];

    /**
     * Get the cities for the region.
     */
    public function cities()
    {
        return $this->hasMany('App\DeliveryRegionCities');
    }

    /**
     * The deliverers that belong to the region.
     */
    public function deliverer()
    {
        return $this->belongsToMany('App\User');
    }
}
