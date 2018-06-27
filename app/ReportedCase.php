<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedCase extends Model
{
    
    public function victim() {
        return $this->hasOne('App\User', 'student_id');
    }

    public function mentors() {
        return $this->belongsToMany('App\User', 'case_mentor', 'case_id', 'user_id');
    }

    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function scopeResolved($query) {
        return $query->where('solved', true);
    }

    public function scopeOpen($query) {
        return $query->where('solved', false);
    }

}
