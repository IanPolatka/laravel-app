<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
	protected $fillable = [

		'school_name',
		'mascot',
		'state',
		'city',
		'region_baseball',
		'district_baseball',
		'region_basketball',
		'district_basketball',
		'region_football',
		'district_football',
		'region_soccer',
		'district_soccer',
		'region_volleyball',
		'district_volleyball'

	];

}
