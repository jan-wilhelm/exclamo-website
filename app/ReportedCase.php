<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedCase extends Model
{

    protected $fillable = [
        "title",
        "category",
        "anonymous",
        "solved"
    ];
    
    public function victim() {
        return $this->belongsTo('App\User', 'student_id');
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

    public function displayTitle() {
        return $this->title ?: $this->id;
    }

}
