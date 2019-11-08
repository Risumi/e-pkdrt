<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_pelaku extends Model {
    protected $table = "pelaku";
    protected $primaryKey = 'id_pelaku';
    protected $fillable = ["nama", "jenis_kelamin", "usia", 'ttl', 'alamat', 'telepon', 'agama', 'pendidikan', 'pekerjaan', 'status', 'difabel', 'hubungan_dengan_korban', 'fk_id_kasus'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}