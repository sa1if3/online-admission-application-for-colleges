<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $table = 'feedback_record';

    protected $fillable = [
			'name',
			'email',
			'course_record_id',
			'department',
			'feedback_message'
    ];
}
