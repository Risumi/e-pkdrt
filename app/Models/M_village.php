<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_village extends Model
{
    protected $table = "villages";
    protected $primaryKey = 'id';
    protected $fillable = ["id",'district_id', 'name'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}
}
