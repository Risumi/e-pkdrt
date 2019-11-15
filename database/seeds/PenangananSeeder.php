<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\M_pelaku;
use App\Models\M_korban;

class PenangananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');                            
        $instansi =['BAPAS','Dinas Kesehatan','UPPA Polresta','RSUD','LPA','WCC Dian Mutiara','DSP3AP2KB','RSSA'];
        $proses =['Pemeriksaan','Penyelidikan','Penyidikan','Penangkapan','Peninjauan Kembali','Penahanan','Pengeledahan','Penyitaan','Pra Penuntutan Kasasi','Diversi','Penuntutan','Pengadilan TK I','Pengadilan TK II','Kasasi'];
        for ($i=0; $i < 300; $i++) {                         
            $pelaku = M_pelaku::where('id_pelaku', rand(1,499))->first();
            DB::table('penanganan')->insert([
                'id_penanganan' => $i ,
                'instansi' => $instansi[rand(0,7)],
                'tglPenanganan' =>  $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
                'jenis_proses' =>  $proses[rand(0,13)],
                'deskripsi_proses' =>  $faker->text(),
                'fk_id_pelaku' => $pelaku->id_pelaku,
                'fk_id_kasus' =>$pelaku->fk_id_kasus                
            ]);
        }
    }
}
