<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use AustinHeap\Database\Encryption\Traits\HasEncryptedAttributes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use HasEncryptedAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'school_id',
        'language',
        'mentoring',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $encrypted = [
        "notes"
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * //////////////////////////////////////////////////
     * /////////////////    METHODS    //////////////////
     * //////////////////////////////////////////////////
     */
    
    public function caseNotifications($caseId)
    {
        $unreadNotifications = $this->unreadNotifications;
        $unreadNotifications = $unreadNotifications->filter(function($notification) use ($caseId) {
            return $notification->data['case_id'] == $caseId;
        });

        return $unreadNotifications;
    }
    
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    /**
     * Get the full name of the user connected with a space
     * @return String The full name of the user
     */
    public function getFullNameAttribute() {
        return $this->first_name . " " . $this->last_name;
    }

    public function getCombinedCasesAttribute() {
        return $this->reportedCases()->get()->concat($this->mentorCases()->get());
    }

    /**
     * Check if the user is a mentor (i.e. either a principle or teacher)
     */
    public function isMentor() {
        return $this->hasRole("lehrer") || $this->hasRole("schulleiter");
    }


    /**
     * //////////////////////////////////////////////////
     * //////////////    RELATIONSHIPS    ///////////////
     * //////////////////////////////////////////////////
     */

    /**
     * One-To-Many relationship to all the cases where the user
     * is the victim.
     *
     * NOTE: This function does explicitly NOT return cases where
     * the user is one of the mentors!
     * @return Collection A collection containing all the ReportedCases
     */
    public function reportedCases() {
        return $this->hasMany('App\ReportedCase', 'student_id');
    }

    /**
     * Get all the cases in which the user is one of the assigned mentors
     * @return Collection A collection containing all the ReportedCases
     */
    public function mentorCases() {
        return $this->belongsToMany('App\ReportedCase', 'case_mentor', 'user_id', 'case_id');
    }

    /**
     * Get all the messages the user has ever sent
     * @return Collection A collection containing all the Messages
     */
    public function messages() {
        return $this->hasMany('App\Message');
    }

    /**
     * Get the school of the user
     * @return School The school of the user
     */
    public function school() {
        return $this->belongsTo('App\School');
    }

    /**
     * Get all the LoginActivities of the user
     * @return Collection A collection containing all the logins
     */
    public function logins() {
        return $this->hasMany('App\LoginActivity');
    }

    /**
     * //////////////////////////////////////////////////
     * /////////////////    SCOPES    ///////////////////
     * //////////////////////////////////////////////////
     */

    /**
     * Check if the user offers mentoring
     */
    public function scopeMentoring($query) {
        return $query->where('mentoring', 1);
    }

    /**
     * Check if the user is part of the school staff (i.e. not a student)
     */
    public function scopeStaff($query) {
        return $query->whereDoesntHave('roles', function($q){
            $q->where('name', 'schueler');
        });
    }

    /**
     * Check if the user is a student
     */
    public function scopeStudent($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '1');
        });
    }

    /**
     * Check if the user is either a student or a teacher
     */
    public function scopeStudentOrTeacher($query) {
        return $query->whereHas('roles', function($q){
            $q->whereIn('roles.id', [1,2]);
        });
    }

    /**
     * Check if the user is a teacher
     */
    public function scopeTeacher($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '2');
        });
    }

    /**
     * Check if the user is a principle
     */
    public function scopePrinciple($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '3');
        });
    }

    /**
     * Check if the user is either a principle or a teacher
     */
    public function scopeMentor($query) {
        return $query->whereHas('roles', function($q){
            $q->where('roles.id', '=', '2')->orWhere('roles.id', '=', '3');
        });
    }

}
