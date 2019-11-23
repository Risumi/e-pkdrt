<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_pelapor extends Model {
    protected $table = "pelapor";
    protected $primaryKey = 'id_pelapor';
    protected $fillable = ["nama", "jenis_kelamin", 'usia', 'ttl', 'alamat', 'telepon', 'agama', 'pendidikan', 'pekerjaan', 'status'];
    public $timestamps = false;

    public function setUpdatedAt($value){ 
    	
    }
    public function getUpdatedAtColumn(){
    	
	}

}
