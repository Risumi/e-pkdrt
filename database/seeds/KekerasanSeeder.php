<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\M_district;

class KekerasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kekerasan = ['Fisik','Psikis','Seksual','Penelantaran','Trafficking','Eksploitasi','Lainnya'];
        for ($i=0; $i < 300; $i++) { 
            DB::table('kekerasan')->insert([
                'jenis_kekerasan' => $kekerasan[rand(0,6)],
                'fk_id_korban' => rand(1,299),
                'fk_id_kasus' => rand(1,499)
            ]);
        }
    }
}