<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PelakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');                    
        $religion = ['Islam','Kristen','Katolik','Budha','Hindu','Konghucu'];
        $education = ['TK','SD','SMP','SMA','S1/S2/S3'];
        $gender = ['Laki-laki','Perempuan'];
        $job = ['Pedagang/Tani/Nelayan','Swasta/Buruh','PNS/TNI/Polri','Pelajar','Ibu Rumah Tangga','Tidak bekerja'];
        $status = ['Menikah','Belum menikah','Duda/Janda','Sirri'];
        $yn = ['Ya','Tidak'];
        $hubungan =['Orang tua','Keluarga/Saudara','Suami/Istri','Tetangga','Pacar/Teman','Guru','Majikan','Rekan Kerja','Lainnya'];
        for ($i=0; $i < 500; $i++) {                                     
            DB::table('pelaku')->insert([
                'id_pelaku' => $i ,
                'nama' => $faker->name,
                'jenis_kelamin' =>  $gender[rand(0,1)], 
                'usia' =>  rand(8,80),
                'ttl' =>  $faker->city.", ".$faker->dateTimeThisCentury->format('Y-m-d'),
                'alamat' =>   $faker->address ,
                'telepon' => $faker->phoneNumber,
                'agama' =>$religion[rand(0,5)],
                'pendidikan' =>$education[rand(0,4)],
                'pekerjaan' =>$job[rand(0,5)],
                'status' =>$status[rand(0,3)],
                'difabel' =>$yn[rand(0,1)],
                'hubungan_dengan_korban' =>$hubungan[rand(0,8)],                
                'fk_id_kasus' =>rand(0,500),
            ]);
        }
    }
}
