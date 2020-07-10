<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees_Body extends Model
{
	protected $table = 'fee_body_record';

    protected $fillable = [
        'name',
        'fee',
        'checkPWD',
        'checkBPL',
        'category_record_id',
        'course_record_id',
        'gender_record_id',
        'active'

    ];
}
