<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
	use  SoftDeletes, Notifiable; 
    
    protected $table = 'clients';
    protected $dates = ['deleted_at'];

    // protected $guarded = 'client';

    protected $fillable = [
        'name', 'email', 'password', 'status', 'email_verified_at', 'confirmed'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
   
}
