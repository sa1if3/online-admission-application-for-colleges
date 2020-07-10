<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewFee extends Model
{

	protected $table = 'new_fee_record';

    protected $fillable = [
				'fee_name',
				'fee_year',
				'gen',
				'sc',
				'st',
				'obc',
				'pwd',
				'bpl',
				'active',
				'course_record_id'
    ];

}
