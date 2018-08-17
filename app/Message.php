<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AustinHeap\Database\Encryption\Traits\HasEncryptedAttributes;

class Message extends Model
{

    use HasEncryptedAttributes;

	protected $fillable = [
		"body",
		"user_id",
		"reported_case_id"
	];

	protected $touches = [
		"reportedCase"
	];

	protected $encrypted = [
		"body"
	];
    
	public function reportedCase() {
		return $this->belongsTo('App\ReportedCase');
	}

	public function sender() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
