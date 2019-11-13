<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_kasus extends Model {
    protected $table = "kasus";
    protected $primaryKey = 'id_kasus';
    protected $fillable = ["hari", "nomor_registrasi", "konselor", 'deskripsi','alamat_tkp','fk_id_district','fk_id_villages'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}