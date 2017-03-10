<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name');
            $table->string('mascot')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('region_baseball')->nullable();
            $table->string('district_baseball')->nullable();
            $table->string('region_basketball')->nullable();
            $table->string('district_basketball')->nullable();
            $table->string('region_football')->nullable();
            $table->string('district_football')->nullable();
            $table->string('region_soccer')->nullable();
            $table->string('district_soccer')->nullable();
            $table->string('region_volleyball')->nullable();
            $table->string('district_volleyball')->nullable();
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
        
        Schema::dropIfExists('teams');

    }
}
