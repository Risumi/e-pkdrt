<?php

use Illuminate\Database\Seeder;
use App\Models\M_village;
use App\Models\M_district;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $district =  M_district::where([
            'regency_id'   =>  3573
        ])->get();       
        foreach ($district as $data) {
            $villages = M_village::where('district_id','=',$data->id)->get();
            foreach ($villages as $dataV) {
                DB::table('admin')->insert([
                    'name' => 'Admin '.ucfirst(strtolower($dataV->name)),
                    'email' => 'kelurahan_'.strtolower(str_replace(' ', '', $dataV->name)),
                    'password' =>  bcrypt(strtolower($dataV->name).'admin'),
                    'fk_id_district' => $data->name ,
                    'fk_id_villages' => $dataV->name
                ]);        
            }
        }        
    }
}