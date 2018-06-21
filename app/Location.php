<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

	public function reportedCases() {
		return $this->hasMany('App\ReportedCase');
	}

	public function school() {
		return $this->belongsTo('App\School');
	}

}
