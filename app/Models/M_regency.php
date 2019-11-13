<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_regency extends Model
{
    protected $table = "regencies";
    protected $primaryKey = 'id';
    protected $fillable = ["id",'province_id', 'name'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}
}
