<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class M_district extends Model
{
    protected $table = "districts";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "regency_id", 'name'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}
}
