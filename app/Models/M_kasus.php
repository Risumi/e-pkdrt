<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_kasus extends Model {
    protected $table = "kasus";
    protected $primaryKey = 'id_kasus';
    protected $fillable = ["hari", "nomor_registrasi", "kejadian",'kategori','deskripsi','alamat_tkp','status','fk_id_district','fk_id_villages'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}