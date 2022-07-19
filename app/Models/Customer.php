<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Database\Factories\CustomerFactory;

class Customer extends Authenticatable
{
	use  SoftDeletes, Notifiable; 
    
 	protected $table = 'customers';
    protected $dates = ['deleted_at'];

    protected $guarded = 'customer';

    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
}
