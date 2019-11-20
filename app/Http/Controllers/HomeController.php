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
        $totKasus =  M_kasus::count();    
        $totLaki =  M_korban::where('jenis_kelamin','=','Laki-laki')->count();    
        $totPerempuan =  M_korban::where('jenis_kelamin','=','Perempuan')->count();    
        $korbanJnsKelamin =  M_korban::select('jenis_kelamin', DB::raw('count(*) as total'))->groupBy('jenis_kelamin')->get();
        $pelakuJnsKelamin =  M_pelaku::select('jenis_kelamin', DB::raw('count(*) as total'))->groupBy('jenis_kelamin')->get();
        $kasusKelurahan=array();
        foreach ($kasusKecamatan as $data ) {
            $temp =array();            
            $datas = M_kasus::select('fk_id_villages', DB::raw('count(*) as total'))->where('fk_id_district','=',$data->fk_id_district)->groupBy('fk_id_villages')
            ->get()->toArray();
            $totKasusKec = M_kasus::where('fk_id_district','=',$data->fk_id_district)
                 ->count();
            $totJnsKelamin = M_korban::
                select('korban.jenis_kelamin',DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                                          
                ->where('kasus.fk_id_district','=',$data->fk_id_district)
                ->groupBy('korban.jenis_kelamin')                                
                ->get()->toArray(); ;
            array_push($temp,$data->fk_id_district);			
            array_push($temp,$datas);			            
            array_push($temp,$totJnsKelamin);	
            array_push($temp,$totKasusKec);
            array_push($kasusKelurahan,$temp);			
        }
        // dd($kasusKelurahan);
        $kategoriLok = M_kasus::select('kategori', DB::raw('count(*) as total'))->groupBy('kategori')
        ->get();
        $kategoriLokKrbn = DB::table('korban')
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
            ->select( DB::raw('count(*) as total'),'kasus.kategori'  )
            ->groupBy('kasus.kategori')
            ->get();              
        $jenisLayanan = M_pelayanan::select('pelayanan', DB::raw('count(*) as total'))->groupBy('pelayanan')
        ->get();
        $statusUsiaKorban = M_korban::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                WHEN usia >= 18 THEN "Dewasa"                    
                END as status_umur'),DB::raw('count(*) as total'))                
            ->groupBy('status_umur')
            ->orderBy('status_umur')
            ->get();    
        $statusUsiaPelaku = M_pelaku::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                WHEN usia >= 18 THEN "Dewasa"                    
                END as status_umur'),DB::raw('count(*) as total'))                
            ->groupBy('status_umur')
            ->orderBy('status_umur')
            ->get();          
        $rentangUsiaPerem = M_korban::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                WHEN usia >= 60 THEN "60+"                    
                END as range_umur'),DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')          
            ->where('korban.jenis_kelamin','=','Perempuan')
            ->groupBy('range_umur')
            ->orderBy('range_umur')
            ->get();
        $rentangUsiaLaki = M_korban::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                WHEN usia >= 60 THEN "60+"                    
                END as range_umur'),DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                    
            ->where('korban.jenis_kelamin','=','Laki-laki')
            ->groupBy('range_umur')
            ->orderBy('range_umur')
            ->get();
        $rentangUsia = M_korban::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                WHEN usia >= 60 THEN "60+"                    
                END as range_umur'),DB::raw('count(*) as total'))                
            ->groupBy('range_umur')
            ->orderBy('range_umur')
            ->get();               
        $rentangUsiaPelaku = M_pelaku::
            select( DB::raw('CASE
                WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                WHEN usia >= 60 THEN "60+"                    
                END as range_umur'),DB::raw('count(*) as total'))                
            ->groupBy('range_umur')
            ->orderBy('range_umur')
            ->get();       
        $rentangUsiaAnak = M_korban::
            select( DB::raw('CASE
                WHEN usia <=1 THEN "< 1"
                WHEN usia BETWEEN 2 and 5 THEN "2 - 5"
                WHEN usia BETWEEN 6 and 10 THEN "6 - 10"
                WHEN usia BETWEEN 11 and 14 THEN "11 - 14"
                WHEN usia BETWEEN 15 and 18 THEN "15 - 18"                                       
                END as range_umur',"*"),DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                  
            ->where('korban.usia','<=',18)                
            ->groupBy('range_umur')                    
            ->orderBy('range_umur')
            ->get();                
        $rentangUsiaPerempuan = M_korban::
            select( DB::raw('CASE
                WHEN usia BETWEEN 19 and 23 THEN "19 - 23"
                WHEN usia BETWEEN 24 and 28 THEN "24 - 28"
                WHEN usia BETWEEN 29 and 33 THEN "29 - 33"
                WHEN usia BETWEEN 34 and 38 THEN "34 - 38"
                WHEN usia BETWEEN 39 and 43 THEN "39 - 43"
                WHEN usia BETWEEN 44 and 48 THEN "44 - 48"
                WHEN usia BETWEEN 49 and 53 THEN "53 - 49"
                WHEN usia BETWEEN 54 and 59 THEN "54 - 59"
                WHEN usia >= 60 THEN "60+"                    
                END as range_umur',"*"),DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                  
            ->where('korban.usia','>=',19)      
            ->where('korban.jenis_kelamin','=','Perempuan')
            ->groupBy('range_umur')                    
            ->orderBy('range_umur')
            ->get();   
        $tempatLaki = M_korban::
            select('kasus.kategori',DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
            ->where('korban.jenis_kelamin','=','Laki-laki')
            ->groupBy('kasus.kategori')                                
            ->get();          
        $tempatPerempuan = M_korban::
            select('kasus.kategori',DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
            ->where('korban.jenis_kelamin','=','Perempuan')
            ->groupBy('kasus.kategori')                                
            ->get();          
        $pekerjaanLaki = M_korban::
            select( 'pekerjaan',DB::raw('count(*) as total'))        
            ->where('jenis_kelamin','=','Laki-laki')
            ->groupBy('pekerjaan')                                
            ->get(); 
        $pekerjaanPerempuan = M_korban::
            select( 'pekerjaan',DB::raw('count(*) as total'))        
            ->where('jenis_kelamin','=','Perempuan')
            ->groupBy('pekerjaan')                                
            ->get();                       
        $pendidikanLaki = M_korban::select('pendidikan', DB::raw('count(*) as total'))
            ->where('jenis_kelamin','=','Laki-laki')
            ->groupBy('pendidikan')
            ->get();
        $pendidikanPerempuan = M_korban::select('pendidikan', DB::raw('count(*) as total'))
            ->where('jenis_kelamin','=','Perempuan')
            ->groupBy('pendidikan')
            ->get();
        $pendidikan = M_korban::select('pendidikan', DB::raw('count(*) as total'))->groupBy('pendidikan')
        ->get();
        $jnsKelamin = M_pelaku::select('jenis_kelamin', DB::raw('count(*) as total'))->groupBy('jenis_kelamin')
        ->get();
        $hubPelaku = M_pelaku::select('hubungan_dengan_korban', DB::raw('count(*) as total'))->groupBy('hubungan_dengan_korban')
        ->get();
        $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
        ->get();
        $filterJenis = "";
        $filterTahun = "";
        return view('home',compact('filterJenis','filterTahun','tempatLaki','tempatPerempuan','pendidikanLaki','pendidikanPerempuan','pekerjaanLaki','pekerjaanPerempuan'
        ,'kasusKecamatan','totKasus','totLaki','totPerempuan','kasusKelurahan','kategoriLok'
        ,'kategoriLokKrbn','jenisLayanan','rentangUsia','rentangUsiaPelaku','korbanJnsKelamin'
        ,'pelakuJnsKelamin','rentangUsiaAnak','rentangUsiaPerempuan','pendidikan','jnsKelamin'
        ,'hubPelaku','statusUsiaKorban','statusUsiaPelaku','rentangUsiaLaki','rentangUsiaPerem'));
    }

    public function viewFilter(Request $req)
    {   
        $filterJenis = $req->FilterJenis;
        $filterTahun = $req->FilterTahun;
        if ($req->FilterJenis == "Tanggal Pelaporan") {
            $kasusKecamatan = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->where(DB::raw('year(hari)'),'=',$req->FilterTahun)->groupBy('fk_id_district')
                            ->get();  
            $totKasus =  M_kasus::where(DB::raw('year(hari)'),'=',$req->FilterTahun)->count();  
            $totLaki =  DB::table('korban')
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')->                                    
                        where('korban.jenis_kelamin','=','Laki-laki')->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)->count();
            $totPerempuan = DB::table('korban')
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')->                                    
                            where('korban.jenis_kelamin','=','Perempuan')->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)->count();
            $korbanJnsKelamin = DB::table('korban')->select('korban.jenis_kelamin', DB::raw('count(*) as total'))
                                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)->groupBy('korban.jenis_kelamin')->get();
            $pelakuJnsKelamin =  DB::table('pelaku')->select('pelaku.jenis_kelamin', DB::raw('count(*) as total'))
                                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)->groupBy('pelaku.jenis_kelamin')->get();
            $kasusKelurahan=array();
            foreach ($kasusKecamatan as $data ) {
                $temp =array();
                $datas = M_kasus::select('fk_id_villages', DB::raw('count(*) as total'))->where(DB::raw('year(hari)'),'=',$req->FilterTahun)->where('fk_id_district','=',$data->fk_id_district)->groupBy('fk_id_villages')
                ->get()->toArray();    
                $totKasusKec = M_kasus::where('fk_id_district','=',$data->fk_id_district)
                     ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                     ->count();
                $totJnsKelamin = M_korban::
                    select('korban.jenis_kelamin',DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                                          
                    ->where('kasus.fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->groupBy('korban.jenis_kelamin')                                
                    ->get()->toArray(); 
                array_push($temp,$data->fk_id_district);			
                array_push($temp,$datas);			
                array_push($temp,$totJnsKelamin);			
                array_push($temp,$totKasusKec);			                

                array_push($kasusKelurahan,$temp);			
            }  
            $kategoriLok = M_kasus::select('kategori', DB::raw('count(*) as total'))
            ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
            ->groupBy('kategori')
            ->get();
            $kategoriLokKrbn = DB::table('korban')
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                ->select( DB::raw('count(*) as total'),'kasus.kategori'  )
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->groupBy('kasus.kategori')
                ->get();              
            $jenisLayanan = M_pelayanan::
                select('pelayanan.pelayanan', DB::raw('count(*) as total'))->groupBy('pelayanan')
                ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')            
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();
            $statusUsiaKorban = M_korban::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                    WHEN usia >= 18 THEN "Dewasa"                    
                    END as status_umur'),DB::raw('count(*) as total'))                
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->groupBy('status_umur')
                ->orderBy('status_umur')
                ->get();    
            $statusUsiaPelaku = M_pelaku::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                    WHEN usia >= 18 THEN "Dewasa"                    
                    END as status_umur'),DB::raw('count(*) as total'))                
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->groupBy('status_umur')
                ->orderBy('status_umur')
                ->get();           
            $rentangUsiaPelaku = M_pelaku::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur',"*"),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                    ->groupBy('range_umur')                    
                    ->orderBy('range_umur')
                    ->get();            
            $rentangUsiaPerem = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur'),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)          
                    ->where('korban.jenis_kelamin','=','Perempuan')
                    ->groupBy('range_umur')
                    ->orderBy('range_umur')
                    ->get();
            $rentangUsiaLaki = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur'),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)          
                    ->where('korban.jenis_kelamin','=','Laki-laki')
                    ->groupBy('range_umur')
                    ->orderBy('range_umur')
                    ->get();
            $rentangUsia = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur',"*"),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                    ->groupBy('range_umur')                    
                    ->orderBy('range_umur')
                    ->get();
            $rentangUsiaAnak = M_korban::
                select( DB::raw('CASE
                    WHEN usia <=1 THEN "< 1"
                    WHEN usia BETWEEN 2 and 5 THEN "2 - 5"
                    WHEN usia BETWEEN 6 and 10 THEN "6 - 10"
                    WHEN usia BETWEEN 11 and 14 THEN "11 - 14"
                    WHEN usia BETWEEN 15 and 18 THEN "15 - 18"                                       
                    END as range_umur',"*"),DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('korban.usia','<=',18)                
                ->groupBy('range_umur')                    
                ->orderBy('range_umur')
                ->get();                
            $rentangUsiaPerempuan = M_korban::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 19 and 23 THEN "19 - 23"
                    WHEN usia BETWEEN 24 and 28 THEN "24 - 28"
                    WHEN usia BETWEEN 29 and 33 THEN "29 - 33"
                    WHEN usia BETWEEN 34 and 38 THEN "34 - 38"
                    WHEN usia BETWEEN 39 and 43 THEN "39 - 43"
                    WHEN usia BETWEEN 44 and 48 THEN "44 - 48"
                    WHEN usia BETWEEN 49 and 53 THEN "53 - 49"
                    WHEN usia BETWEEN 54 and 59 THEN "54 - 59"
                    WHEN usia >= 60 THEN "60+"                    
                    END as range_umur',"*"),DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('korban.usia','>=',19)      
                ->where('korban.jenis_kelamin','=','Perempuan')
                ->groupBy('range_umur')                    
                ->orderBy('range_umur')
                ->get();   
            $tempatLaki = M_korban::
                select('kasus.kategori',DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('korban.jenis_kelamin','=','Laki-laki')
                ->groupBy('kasus.kategori')                                
                ->get();          
            $tempatPerempuan = M_korban::
                select('kasus.kategori',DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)                              
                ->where('korban.jenis_kelamin','=','Perempuan')
                ->groupBy('kasus.kategori')                                
                ->get();          
            $pekerjaanLaki = M_korban::
                select( 'pekerjaan',DB::raw('count(*) as total'))        
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->where('jenis_kelamin','=','Laki-laki')
                ->groupBy('pekerjaan')                                
                ->get(); 
            $pekerjaanPerempuan = M_korban::
                select( 'pekerjaan',DB::raw('count(*) as total'))        
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('jenis_kelamin','=','Perempuan')
                ->groupBy('pekerjaan')                                
                ->get();                       
            $pendidikanLaki = M_korban::
                select('pendidikan', DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('jenis_kelamin','=','Laki-laki')
                ->groupBy('pendidikan')
                ->get();
            $pendidikanPerempuan = M_korban::
                select('pendidikan', DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->where('jenis_kelamin','=','Perempuan')
                ->groupBy('pendidikan')
                ->get();
            $pendidikan = M_korban::
                select('pendidikan', DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->groupBy('pendidikan')
                ->get();
            $jnsKelamin = M_pelaku::
            select('jenis_kelamin', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
            ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
            ->groupBy('jenis_kelamin')
            ->get();
            $hubPelaku = M_pelaku::
            select('hubungan_dengan_korban', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
            ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
            ->groupBy('hubungan_dengan_korban')
            ->get();
            $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
            ->get();
            // dd($jmlPelayanan);            
        }else{
            $kasusKecamatan = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)->groupBy('fk_id_district')
            ->get();   
            $totKasus =  M_kasus::where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)->count();  
            $totLaki =  DB::table('korban')
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')->                                    
                        where('korban.jenis_kelamin','=','Laki-laki')->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)->count();
            $totPerempuan = DB::table('korban')
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')->                                    
                            where('korban.jenis_kelamin','=','Perempuan')->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)->count();
            $korbanJnsKelamin = DB::table('korban')->select('korban.jenis_kelamin', DB::raw('count(*) as total'))
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)->groupBy('korban.jenis_kelamin')->get();
            $pelakuJnsKelamin =  DB::table('pelaku')->select('pelaku.jenis_kelamin', DB::raw('count(*) as total'))
                            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)->groupBy('pelaku.jenis_kelamin')->get();
            $kasusKelurahan=array();
            foreach ($kasusKecamatan as $data ) {
                $temp =array();
                $datas = M_kasus::select('fk_id_villages', DB::raw('count(*) as total'))->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)->where('fk_id_district','=',$data->fk_id_district)->groupBy('fk_id_villages')
                ->get()->toArray();             
                $totKasusKec = M_kasus::where('fk_id_district','=',$data->fk_id_district)                    
                     ->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)
                     ->count();
                $totJnsKelamin = M_korban::
                    select('korban.jenis_kelamin',DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                                          
                    ->where('kasus.fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->groupBy('korban.jenis_kelamin')                                
                    ->get()->toArray();    
                array_push($temp,$data->fk_id_district);			
                array_push($temp,$datas);			
                array_push($temp,$totJnsKelamin);			
                array_push($temp,$totKasusKec);			
                array_push($kasusKelurahan,$temp);			
            }               
            $kategoriLok = M_kasus::
            select('kategori', DB::raw('count(*) as total'))
            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
            ->groupBy('kategori')
            ->get();
            $kategoriLokKrbn = DB::table('korban')
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                ->select( DB::raw('count(*) as total'),'kasus.kategori'  )
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->groupBy('kasus.kategori')
                ->get();              
            $jenisLayanan = M_pelayanan::
            select('pelayanan.pelayanan', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')            
            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
            ->groupBy('pelayanan.pelayanan')
            ->get();
            $statusUsiaKorban = M_korban::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                    WHEN usia >= 18 THEN "Dewasa"                    
                    END as status_umur'),DB::raw('count(*) as total'))                
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->groupBy('status_umur')
                ->orderBy('status_umur')
                ->get();    
            $statusUsiaPelaku = M_pelaku::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 0 and 17 THEN "Anak"                
                    WHEN usia >= 18 THEN "Dewasa"                    
                    END as status_umur'),DB::raw('count(*) as total'))                
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->groupBy('status_umur')
                ->orderBy('status_umur')
                ->get();       
            $rentangUsiaPelaku = M_pelaku::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur',"*"),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->groupBy('range_umur')                    
                    ->orderBy('range_umur')
                    ->get();
            
            $rentangUsiaPerem = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur'),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)          
                    ->where('korban.jenis_kelamin','=','Perempuan')
                    ->groupBy('range_umur')
                    ->orderBy('range_umur')
                    ->get();
            $rentangUsiaLaki = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur'),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)          
                    ->where('korban.jenis_kelamin','=','Laki-laki')
                    ->groupBy('range_umur')
                    ->orderBy('range_umur')
                    ->get();

            $rentangUsia = M_korban::
                    select( DB::raw('CASE
                        WHEN usia BETWEEN 0 and 5 THEN "0 - 5"
                        WHEN usia BETWEEN 6 and 12 THEN "06 - 12"
                        WHEN usia BETWEEN 13 and 17 THEN "13 - 17"
                        WHEN usia BETWEEN 18 and 24 THEN "18 - 24"
                        WHEN usia BETWEEN 25 and 44 THEN "25 - 44"
                        WHEN usia BETWEEN 45 and 59 THEN "45 - 59"
                        WHEN usia >= 60 THEN "60+"                    
                        END as range_umur'),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)          
                    ->groupBy('range_umur')
                    ->orderBy('range_umur')
                    ->get();
            $rentangUsiaAnak = M_korban::
                    select( DB::raw('CASE
                        WHEN usia <=1 THEN "< 1"
                        WHEN usia BETWEEN 2 and 5 THEN "2 - 5"
                        WHEN usia BETWEEN 6 and 10 THEN "6 - 10"
                        WHEN usia BETWEEN 11 and 14 THEN "11 - 14"
                        WHEN usia BETWEEN 15 and 18 THEN "15 - 18"                                       
                        END as range_umur',"*"),DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('korban.usia','<=',18)                
                    ->groupBy('range_umur')                    
                    ->orderBy('range_umur')
                    ->get();                
            $rentangUsiaPerempuan = M_korban::
                select( DB::raw('CASE
                    WHEN usia BETWEEN 19 and 23 THEN "19 - 23"
                    WHEN usia BETWEEN 24 and 28 THEN "24 - 28"
                    WHEN usia BETWEEN 29 and 33 THEN "29 - 33"
                    WHEN usia BETWEEN 34 and 38 THEN "34 - 38"
                    WHEN usia BETWEEN 39 and 43 THEN "39 - 43"
                    WHEN usia BETWEEN 44 and 48 THEN "44 - 48"
                    WHEN usia BETWEEN 49 and 53 THEN "53 - 49"
                    WHEN usia BETWEEN 54 and 59 THEN "54 - 59"
                    WHEN usia >= 60 THEN "60+"                    
                    END as range_umur',"*"),DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->where('korban.usia','>=',19)      
                ->where('korban.jenis_kelamin','=','Perempuan')
                ->groupBy('range_umur')                    
                ->orderBy('range_umur')
                ->get();   
            $tempatLaki = M_korban::
                    select('kasus.kategori',DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('korban.jenis_kelamin','=','Laki-laki')
                    ->groupBy('kasus.kategori')                                
                    ->get();          
            $tempatPerempuan = M_korban::
                    select('kasus.kategori',DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('korban.jenis_kelamin','=','Perempuan')
                    ->groupBy('kasus.kategori')                                
                    ->get();          
            $pekerjaanLaki = M_korban::
                    select( 'pekerjaan',DB::raw('count(*) as total'))        
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('jenis_kelamin','=','Laki-laki')
                    ->groupBy('pekerjaan')                                
                    ->get(); 
            $pekerjaanPerempuan = M_korban::
                    select( 'pekerjaan',DB::raw('count(*) as total'))        
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('jenis_kelamin','=','Perempuan')
                    ->groupBy('pekerjaan')                                
                    ->get();                       
            $pendidikanLaki = M_korban::
                    select('pendidikan', DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('jenis_kelamin','=','Laki-laki')
                    ->groupBy('pendidikan')
                    ->get();
            $pendidikanPerempuan = M_korban::
                    select('pendidikan', DB::raw('count(*) as total'))
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                              
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->where('jenis_kelamin','=','Perempuan')
                    ->groupBy('pendidikan')
                    ->get();
            $pendidikan = M_korban::
            select('pendidikan', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')  
            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)          
            ->groupBy('pendidikan')
            ->get();
            $jnsKelamin = M_pelaku::
            select('pelaku.jenis_kelamin', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
            ->groupBy('pelaku.jenis_kelamin')
            ->get();
            $hubPelaku = M_pelaku::
            select('pelaku.hubungan_dengan_korban', DB::raw('count(*) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')  
            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
            ->groupBy('pelaku.hubungan_dengan_korban')
            ->get();
            $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
            ->get();
            // dd($jmlPelayanan);            
        }        
        return view('home',compact('filterJenis','filterTahun','tempatLaki','tempatPerempuan','pendidikanLaki','pendidikanPerempuan','pekerjaanLaki','pekerjaanPerempuan'
        ,'kasusKecamatan','totKasus','totLaki','totPerempuan','kasusKelurahan','kategoriLok'
        ,'kategoriLokKrbn','jenisLayanan','rentangUsia','rentangUsiaPelaku','korbanJnsKelamin'
        ,'pelakuJnsKelamin','rentangUsiaAnak','rentangUsiaPerempuan','pendidikan','jnsKelamin'
        ,'hubPelaku','statusUsiaKorban','statusUsiaPelaku','rentangUsiaLaki','rentangUsiaPerem'));
    }
}
