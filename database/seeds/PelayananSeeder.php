<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\M_kasus;
use App\Models\M_korban;

class PelayananSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');                            
        $instansi =['BAPAS','Dinas Kesehatan','UPPA Polresta','RSUD','LPA','WCC Dian Mutiara','DSP3AP2KB','RSSA'];
        $pelayanan =['Bantuan hukum','Kesehatan','Pemulangan','Pendampingan tokoh agama','Penegakan hukum','Penganduan','Rehabiitasi sosial','Reintegrasi sosial'];
        $kesehatan =['Visum','Medis','Psikologis'];
        for ($i=0; $i < 300; $i++) {             
            $jnsPelayanan= $pelayanan[rand(0,7)];
            $dtlPelayanan= "";
            if ($jnsPelayanan==$pelayanan[1]) {
                $dtlPelayanan= $kesehatan[rand(0,2)];
            }
            $korban = M_korban::where('id_korban', rand(1,499))->first();
            DB::table('pelayanan')->insert([
                'id_pelayanan' => $i ,
                'instansi' => $instansi[rand(0,7)],
                'tglPelayanan' =>  $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta') , 
                'pelayanan' =>  $jnsPelayanan,
                'detail_pelayanan' =>  $dtlPelayanan,
                'deskripsi_pelayanan' =>   $faker->text,
                'fk_id_korban' => $korban->id_korban,
                'fk_id_kasus' =>$korban->fk_id_kasus                
            ]);
        }
    }
}