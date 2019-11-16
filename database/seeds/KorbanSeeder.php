<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KorbanSeeder extends Seeder
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
        $kekerasan = ['Fisik','Psikis','Seksual','Penelantaran','Trafficking','Eksploitasi','Lainnya'];
        for ($i=0; $i < 500; $i++) {                                     
            $tindak="";
            for ($y=0; $y < rand(1,2); $y++) { 
                $tindak.=$kekerasan[rand(0,6)]." ";
            }
            $trafficking = ['Eksploitasi seksual','Perbudakan','Perdagangan organ tubuh','Perdagangan narkoba'];
            $kattraf="";
            for ($y=0; $y < rand(0,1); $y++) { 
                $kattraf.=$trafficking[rand(0,3)]." ";
            }
            DB::table('korban')->insert([
                'id_korban' => $i ,
                'nama' => $faker->name,
                'jenis_kelamin' =>  $gender[rand(0,1)], 
                'usia' =>  rand(0,80),
                'ttl' =>  $faker->city.", ".$faker->dateTimeThisCentury->format('Y-m-d'),
                'alamat' =>   $faker->address ,
                'telepon' => $faker->phoneNumber,
                'agama' =>$religion[rand(0,5)],
                'pendidikan' =>$education[rand(0,4)],
                'pekerjaan' =>$job[rand(0,5)],
                'status' =>$status[rand(0,3)],
                'difabel' =>$yn[rand(0,1)],
                'kdrt' =>$yn[rand(0,1)],
                'tindak_kekerasan' =>$tindak,
                'kategori_trafficking' =>$kattraf,
                'fk_id_kasus' =>rand(0,500),
            ]);
        }
    }
}