<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
	protected $table = 'board_record';

    protected $fillable = [
        'name'  
    ];
}
