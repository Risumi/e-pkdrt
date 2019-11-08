<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_rujukan extends Model {
    protected $table = "rujukan";
    protected $primaryKey = 'id_rujukan';
    protected $fillable = ["tanggal_rujukan", "kota", "instansi", 'deskripsi_rujukan', 'fk_id_korban', 'fk_id_kasus'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}