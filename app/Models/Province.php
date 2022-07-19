<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{ District, Order };

class Province extends Model
{
    protected $table 	= 'provinces';

    protected $fillable = [
        'name', 'gso_id'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
