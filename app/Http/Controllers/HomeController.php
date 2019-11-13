<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kasus;
use App\Models\M_korban;
use App\Models\M_pelayanan;
use App\Models\M_rujukan;
use App\Models\M_pelaku;
use App\Models\M_penanganan;
use App\Models\M_village;
use App\Models\M_district;
use DB;


class HomeController extends Controller
{
    public function view()
    {   
        $kasusKecamatan = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->groupBy('fk_id_district')
        ->get();
        
        // dd($kasusKecamatan);        
        return view('home',compact('kasusKecamatan'));
    }
}
