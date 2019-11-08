<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_penanganan extends Model {
    protected $table = "penanganan";
    protected $primaryKey = 'id_penanganan';
    protected $fillable = ["instansi", "jenis_proses", 'deskripsi_proses', 'fk_id_pelaku', 'fk_id_kasus'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}