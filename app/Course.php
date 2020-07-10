<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $table = 'course_record';

    protected $fillable = [
        'name',
        'description',
        'active',
        'compulsory',
        'major',
        'elective',
        'course_prefix',
        'course_counter',
        'course_semester'

    ];
}
