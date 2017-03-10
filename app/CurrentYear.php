<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Year;

class CurrentYear extends Model
{
    
	protected $table = 'years';

	 public function year()
    {
        return $this->belongsTo('year');
    }

}
