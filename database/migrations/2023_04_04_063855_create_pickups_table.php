<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->string('phone');
            $table->string('country');
            $table->string('address1');
            $table->string('address2');
            $table->string('postcode');
            $table->string('city');
            $table->string('province');
            $table->string('tocountry');
            $table->string('toprovince');
            $table->string('toname');
            $table->string('tophone');
            $table->string('toaddress1');
            $table->string('toaddress2');
            $table->string('topostcode');
            $table->string('tocity');
            $table->string('driverId')->nullable();
            $table->string('vehicleId')->nullable();
            $table->string('status')->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('pickups');
    }
}
