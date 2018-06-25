<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'school_id', 'language'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function school() {
        return $this->belongsTo('App\School');
    }

    public function reportedCases() {
        return $this->hasMany('App\ReportedCase', 'student_id');
    }

    public function messages() {
        return $this->hasManyThrough('App\Message', 'App\ReportedCase', 'student_id');
    }

    public function scopeStaff($query) {
        return $query->whereHas('roles', function($q){
            $q->where('name', "!=", 'schueler');
        });
    }

    public function scopeStudent($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '1');
        });
    }

    public function scopeTeacher($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '2');
        });
    }

    public function scopePrinciple($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '3');
        });
    }

}
