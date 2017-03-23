<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTennisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tennis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_year_id');
            $table->integer('team_id');
            $table->date('date');
            $table->integer('scrimmage');
            $table->string('tournament_title')->nullable();
            $table->integer('is_away');
            $table->integer('opponent_id')->nullable();
            $table->integer('time_id');
            $table->string('boys_win_lose')->nullable();
            $table->string('boys_match_score')->nullable();
            $table->string('girls_win_lose')->nullable();
            $table->string('girls_match_score')->nullable();
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
        
        Schema::dropIfExists('tennis');

    }
}
