<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table 	= 'wards';

    protected $fillable = [
        'name', 'gso_id', 'district_id',
    ];
}
