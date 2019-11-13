<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\M_village;
use App\Models\M_district;

class KasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $district = M_district::where([
            'regency_id'   =>  3573
        ])->get();            
        for ($i=301; $i < 503; $i++) { 
            $random =rand(0,4);
            $village = M_village::where([
                'district_id'   =>  $district[$random]->id
            ])->get();
            $random2 = rand (0, (M_village::where([
                'district_id'   =>  $district[$random]->id])->count()-1));
            
            DB::table('kasus')->insert([
                'id_kasus' => $i ,
                'hari' =>   $faker->date($format = 'd-M-Y', $max = 'now') ,
                'nomor_registrasi' => $faker->randomNumber($nbDigits = 9, $strict = true).('/MALANG/').$faker->month().('/').$faker->year($max = 'now'),
                'konselor' =>  $faker->name,
                'deskripsi' => $faker->text,
                'alamat_tkp' =>$faker->address,
                'fk_id_district' =>$district[$random]->name,
                'fk_id_villages' =>$village[$random2]->name
            ]);
        }       
    }
}
