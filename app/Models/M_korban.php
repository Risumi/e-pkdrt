<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_korban extends Model {
    protected $table = "korban";
    protected $primaryKey = 'id_korban';
    protected $fillable = ["nama", "jenis_kelamin", "usia", 'ttl', 'alamat', 'telepon', 'agama', 'pendidikan', 'pekerjaan', 'status', 'difabel', 'kdrt', 'tindak_kekerasan', 'kategori_trafficking', 'fk_id_kasus'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}