<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    protected $table = 'login_activities';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
