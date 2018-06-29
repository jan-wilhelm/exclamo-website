<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

	protected $fillable = [
		"body",
		"user_id",
		"reported_case_id"
	];

	protected $touches = [
		"reportedCase"
	];
    
	public function reportedCase() {
		return $this->belongsTo('App\ReportedCase');
	}

	public function sender() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
