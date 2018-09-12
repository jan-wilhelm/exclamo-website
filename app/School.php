<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    
	public function users() {
		return $this->hasMany('App\User');
	}

	public function students() {		
		return $this->hasMany('App\User')->student();
	}

	public function teachers() {		
		return $this->hasMany('App\User')->teacher();
	}

	public function studentsOrTeachers() {		
		return $this->hasMany('App\User')->studentOrTeacher();
	}

	public function admins() {		
		return $this->hasMany('App\User')->principle();
	}

	public function mentors() {
		return $this->hasMany('App\User')->mentor();
	}

	public function locations() {
		return $this->hasMany('App\Location');
	}
}
