<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelivererRegionsAndCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverer_regions_and_cities', function (Blueprint $table) {
            $table->id();
            $table->integer("deliverer_id");
            $table->integer('region_id');
            $table->integer('city_id')->nullable();
            $table->enum('dilever_to_all_region_city',['YES', 'NO'])->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliverer_regions_and_cities');
    }
}
