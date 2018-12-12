<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolSignup extends Model
{
    protected $fillable = [
        'email',
        'contact_person',
        'school'
    ];
}
