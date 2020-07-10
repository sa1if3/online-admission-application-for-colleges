<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
	protected $table = 'religion_record';

    protected $fillable = [
        'name'  
    ];
}
