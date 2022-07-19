<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;

class District extends Model
{
    protected $table 	= 'districts';

    protected $fillable = [
        'name', 'gso_id', 'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
