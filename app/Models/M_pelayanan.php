<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_pelayanan extends Model {
    protected $table = "pelayanan";
    protected $primaryKey = 'id_pelayanan';
    protected $fillable = ["instansi", "pelayanan", "detail_pelayanan", 'deskripsi_pelayanan', 'fk_id_korban', 'fk_id_kasus'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}