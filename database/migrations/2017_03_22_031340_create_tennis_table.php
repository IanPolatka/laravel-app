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
            $table->integer('year_id');
            $table->date('date');
            $table->integer('scrimmage');
            $table->string('tournament_title')->nullable();
            $table->integer('away_team_id');
            $table->integer('home_team_id');
            $table->integer('time_id');
            $table->integer('boys_winner')->nullable();
            $table->string('boys_match_score')->nullable();
            $table->integer('girls_winner')->nullable();
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
