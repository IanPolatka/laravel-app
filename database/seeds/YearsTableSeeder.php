<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$year = new \App\Year([

    		'year'	=>	'1900-1901'

    	]);

    	$year->save();

    }
}
