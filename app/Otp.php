<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
	protected $table = 'otp';

    protected $fillable = [
        'otp',
		'student_id'  
    ];
}
