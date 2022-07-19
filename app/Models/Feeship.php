<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{ District, Province, Ward };

class Feeship extends Model
{
    protected $table = 'feeships';

    protected $fillable = [
    	'code_province', 'code_district','code_ward','code_feeship'
    ]; 	
 	
 	public function province(){
 		return $this->belongsTo(Province::class, 'code_province');
 	}

    public function district(){
 		return $this->belongsTo(District::class, 'code_district');
 	}

 	public function ward(){
 		return $this->belongsTo(Wards::class, 'code_ward');
 	}
}
