<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_provincy extends Model
{
    protected $table = "provinces";
    protected $primaryKey = 'id';
    protected $fillable = ["id", 'name'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}
}
