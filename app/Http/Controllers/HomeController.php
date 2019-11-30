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
        $Jnskekerasan = ['Fisik','Psikis','Seksual','Penelantaran','Trafficking','Eksploitasi','Lainnya'];
        $pelayanan =['Bantuan hukum','Kesehatan','Pemulangan','Pendampingan tokoh agama','Penegakan hukum','Pengaduan','Rehabilitasi sosial','Reintegrasi sosial'];
        $lokasi = ['Tempat Kerja','Rumah Tangga','Fasilitas Umum','Sekolah','Lainnya'];
        $usia = ['0 - 5','6 - 12','13 - 17','18 - 24','25 - 44','45 - 59','60+'];
        $education = ['TK','SD','SMP','SMA','S1/S2/S3'];       
        $gender=['Laki-laki','Perempuan'];
        $hubungan =['Orang tua','Keluarga/Saudara','Suami/Istri','Tetangga','Pacar/Teman','Guru','Majikan','Rekan Kerja','Lainnya'];
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get();        
        $kasusKecamatan= collect();
        foreach($kecamatan as $data){            
            $temp = M_kasus::select( DB::raw('count(fk_id_district) as total'))            
            ->where('fk_id_district','=',$data->name)
            ->get();                                  
            $temp[0]->fk_id_district = $data->name;
            $kasusKecamatan->add($temp[0]);
        }        
        $kasusKelurahan=array();            
        foreach ($kasusKecamatan as $data ) {
            $temp =array();            
            $kecamatan = M_district::
                where('name','=',$data->fk_id_district)            
                ->first();
            $kelurahan = DB::table('villages')->where('district_id','=',$kecamatan->id)->get();        
            $datas = array();
            foreach($kelurahan as $data2){            
                $temp2 = M_kasus::select( DB::raw('count(fk_id_villages) as total'))            
                ->where('fk_id_villages','=',$data2->name)
                ->get()->toArray();                              
                $temp2[0]['fk_id_villages'] = $data2->name;
                // dd($temp2);
                array_push($datas,$temp2[0]);
            }            
            $totKasusKec = M_kasus::where('fk_id_district','=',$data->fk_id_district)
                 ->count();
            $totJnsKelamin = M_korban::
                select('korban.jenis_kelamin',DB::raw('count(*) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')                                          
                ->where('kasus.fk_id_district','=',$data->fk_id_district)
                ->groupBy('korban.jenis_kelamin')                                
                ->get()->toArray(); 
            $kategoriLokKel = array();
            foreach($lokasi as $data2){            
                $temp2 = M_kasus::select( DB::raw('count(kategori) as total'))            
                ->where('kategori','=',$data2)
                ->where('fk_id_district','=',$data->fk_id_district)
                ->get()->toArray();
                $temp2[0]['kategori'] = $data2;
                array_push($kategoriLokKel,$temp2[0]);            
            }        
            $kategoriLokKrbnKel = collect();
            foreach($lokasi as $data2){            
                $temp2 = M_korban::select( DB::raw('count(kategori) as total'))            
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                    ->where('kategori','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->get();
                    $temp2[0]->kategori = $data2;
                    $kategoriLokKrbnKel->add($temp2[0]);            
            }                    
            $jenisLayananKel = array();
            foreach($pelayanan as $data2){            
                $temp2 = M_pelayanan::select( DB::raw('count(pelayanan) as total'))         
                ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')               
                ->where('pelayanan','=',$data2)
                ->where('fk_id_district','=',$data->fk_id_district)
                ->get()->toArray();
                $temp2[0]['pelayanan'] = $data2;
                array_push($jenisLayananKel,$temp2[0]);            
            }                 
            $rentangUsiaKel = collect();
            foreach($usia as $data2){
                $arr = explode(' ',$data2) ;
                if(count($arr)==3){
                    $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->whereBetween('usia',[$arr[0],$arr[2]])
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->get();                           
                    $temp2[0]->range_umur = $data2;
                    $rentangUsiaKel->add($temp2[0]);    
                }else {
                    $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->where('usia','>=',60)
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->get();                           
                    $temp2[0]->range_umur = $data2;
                    $rentangUsiaKel->add($temp2[0]);    
                }
            }    
            $pendidikanKel =array();
            foreach($education as $data2){            
                $temp2 = M_korban::select( DB::raw('count(pendidikan) as total'))         
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')               
                ->where('pendidikan','=',$data2)
                ->where('fk_id_district','=',$data->fk_id_district)
                ->get()->toArray();
                $temp2[0]['pendidikan'] = $data2;
                array_push($pendidikanKel,$temp2[0]);            
            }           
            $jnsKelaminKel =array();
            foreach($gender as $data2){            
                $temp2 = M_pelaku::select( DB::raw('count(jenis_kelamin) as total'))         
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                ->where('jenis_kelamin','=',$data2)
                ->where('fk_id_district','=',$data->fk_id_district)
                ->get()->toArray();
                $temp2[0]['jenis_kelamin'] = $data2;
                array_push($jnsKelaminKel,$temp2[0]);            
            }             
            $hubPelakuKel =array();
            foreach($hubungan as $data2){            
                $temp2 = M_pelaku::select( DB::raw('count(hubungan_dengan_korban) as total'))         
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                ->where('hubungan_dengan_korban','=',$data2)
                ->where('fk_id_district','=',$data->fk_id_district)
                ->get()->toArray();
                $temp2[0]['hubungan_dengan_korban'] = $data2;
                array_push($hubPelakuKel,$temp2[0]);            
            }                                                         
            $kekerasanKel = collect();
            foreach($Jnskekerasan  as $data2){            
                $temp2 = DB::table('kekerasan')
                    ->select( DB::raw('count(jenis_kekerasan) as total'))            
                    ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')            
                    ->where('jenis_kekerasan','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->get();
                    $temp2[0]->jenis_kekerasan = $data2;
                    $kekerasanKel->add($temp2[0]);            
            }                                
            array_push($temp,$data->fk_id_district);			
            array_push($temp,$datas);			            
            array_push($temp,$totJnsKelamin);	
            array_push($temp,$totKasusKec);
            array_push($temp,$kategoriLokKel);
            array_push($temp,$kategoriLokKrbnKel);
            array_push($temp,$jenisLayananKel);
            array_push($temp,$rentangUsiaKel);
            array_push($temp,$pendidikanKel);
            array_push($temp,$jnsKelaminKel);
            array_push($temp,$hubPelakuKel);
            array_push($temp,$kekerasanKel);
            array_push($kasusKelurahan,$temp);			            
        }
        // dd($kasusKelurahan);

        $totKasus =  M_kasus::count();    
        $totLaki =  M_korban::where('jenis_kelamin','=','Laki-laki')->count();    
        $totPerempuan =  M_korban::where('jenis_kelamin','=','Perempuan')->count();    
        $korbanJnsKelamin =  M_korban::select('jenis_kelamin', DB::raw('count(*) as total'))->groupBy('jenis_kelamin')->get();
        $pelakuJnsKelamin =  M_pelaku::select('jenis_kelamin', DB::raw('count(*) as total'))->groupBy('jenis_kelamin')->get();

        $dataWarna = array();
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get(); 
        foreach($kecamatan as $data){
            $dataWarna[$data->name]="#f8f9fa";
        }
        $totKasusKec = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->groupBy('fk_id_district')->get()->sortBy('total');
        $warna= array("#FFEF81","#FFDB6D","#FF9F31","#FF8331","#ff4e00");                
        $i = 0;
        $j = 0;
        foreach ($totKasusKec as $data) {
            if($i==0){
                $temp = $data;    
                $dataWarna[$data->fk_id_district] = $warna[$j];
            }else{
                if ($data->total == 0){
                    $dataWarna[$data->fk_id_district] = "";                
                }
                else if ($data->total > $temp->total){
                    $dataWarna[$data->fk_id_district] = $warna[++$j];                
                }else{
                    $dataWarna[$data->fk_id_district] = $warna[$j];
                }             
            }                      
            $temp = $data;
            $i++;                      
        }
        // dd($dataWarna);
        //1. rgb(255, 239, 129) #FFEF81
        //2. rgb(255, 219, 109) #FFDB6D
        //3. rgb(255, 159, 49) #FF9F31
        //4. rgb(255, 131, 21) #FF8331
        //5. rgb(210, 105, 12) #D29F31
        // dd($dataWarna);
        // dd($totKasusKec);
        
        $kategoriLok = collect();
        foreach($lokasi as $data){            
            $temp = M_kasus::select( DB::raw('count(kategori) as total'))            
            ->where('kategori','=',$data)
            ->get();                                  
            $temp[0]->kategori = $data;
            $kategoriLok->add($temp[0]);            
        }        
        $kategoriLokKrbn = collect();
        foreach($lokasi as $data){            
            $temp = M_korban::select( DB::raw('count(kategori) as total'))            
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
            ->where('kategori','=',$data)
            ->get();                                  
            $temp[0]->kategori = $data;
            $kategoriLokKrbn->add($temp[0]);            
        }
        
        $jenisLayanan = collect();
        foreach($pelayanan as $data){            
            $temp = M_pelayanan::select( DB::raw('count(pelayanan) as total'))            
            ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')            
            ->where('pelayanan','=',$data)
            ->get();                                  
            $temp[0]->pelayanan = $data;
            $jenisLayanan->add($temp[0]);            
        }
        // $jenisLayanan = M_pelayanan::
        // select('pelayanan', DB::raw('count(*) as total'))
        // ->groupBy('pelayanan')
        // ->get();
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
        $rentangUsia = collect();
        
        foreach($usia as $data){
            $arr = explode(' ',$data) ;
            if(count($arr)==3){
                $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                    ->whereBetween('usia',[$arr[0],$arr[2]])
                    ->get();                           
                $temp[0]->range_umur = $data;
                $rentangUsia->add($temp[0]);    
            }else {
                $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                    ->where('usia','>=',60)
                    ->get();                           
                $temp[0]->range_umur = $data;
                $rentangUsia->add($temp[0]);    
            }
        }

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
        
        $pendidikan = collect();
        foreach($education as $data){                                 
            $temp = DB::table('korban')->select(DB::raw('count(pendidikan) as total'))            
            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
            ->where('pendidikan','=',$data)
            ->get();                           
            $temp[0]->pendidikan = $data;
            $pendidikan->add($temp[0]);       
        }              
        
        $jnsKelamin = collect();
        foreach($gender as $data){                                 
            $temp = DB::table('pelaku')->select(DB::raw('count(jenis_kelamin) as total'))            
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
            ->where('jenis_kelamin','=',$data)
            ->get();                           
            $temp[0]->jenis_kelamin = $data;
            $jnsKelamin->add($temp[0]);       
        }          
        $hubPelaku = collect();
        foreach($hubungan as $data){                                 
            $temp = DB::table('pelaku')->select(DB::raw('count(hubungan_dengan_korban) as total'))            
            ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
            ->where('hubungan_dengan_korban','=',$data)
            ->get();                           
            $temp[0]->hubungan_dengan_korban = $data;
            $hubPelaku->add($temp[0]);       
        }          
        $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
            ->get();        
        $kekerasan = collect();
        foreach($Jnskekerasan as $data){                                 
            $temp = DB::table('kekerasan')->select(DB::raw('count(jenis_kekerasan) as total'))
            ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')
            ->where('jenis_kekerasan','=',$data)
            ->get();                           
            $temp[0]->jenis_kekerasan = $data;
            $kekerasan->add($temp[0]);            
        }        
        $filterJenis = "";
        $filterTahun = "";
        return view('home',compact('filterJenis','filterTahun','tempatLaki','tempatPerempuan','pendidikanLaki','pendidikanPerempuan','pekerjaanLaki','pekerjaanPerempuan'
        ,'kasusKecamatan','totKasus','totLaki','totPerempuan','kasusKelurahan','kategoriLok'
        ,'kategoriLokKrbn','jenisLayanan','rentangUsia','rentangUsiaPelaku','korbanJnsKelamin'
        ,'pelakuJnsKelamin','rentangUsiaAnak','rentangUsiaPerempuan','pendidikan','jnsKelamin','kekerasan'
        ,'hubPelaku','statusUsiaKorban','statusUsiaPelaku','rentangUsiaLaki','rentangUsiaPerem','dataWarna','kecamatan'));
    }

    public function viewFilter(Request $req)
    {   
        $Jnskekerasan = ['Fisik','Psikis','Seksual','Penelantaran','Trafficking','Eksploitasi','Lainnya'];
        $pelayanan =['Bantuan hukum','Kesehatan','Pemulangan','Pendampingan tokoh agama','Penegakan hukum','Pengaduan','Rehabiitasi sosial','Reintegrasi sosial'];
        $lokasi = ['Tempat Kerja','Rumah Tangga','Fasilitas Umum','Sekolah','Lainnya'];
        $usia = ['0 - 5','6 - 12','13 - 17','18 - 24','25 - 44','45 - 59','60+'];
        $education = ['TK','SD','SMP','SMA','S1/S2/S3'];       
        $gender=['Laki-laki','Perempuan'];
        $hubungan =['Orang tua','Keluarga/Saudara','Suami/Istri','Tetangga','Pacar/Teman','Guru','Majikan','Rekan Kerja','Lainnya'];
        
        $filterJenis = $req->FilterJenis;
        $filterTahun = $req->FilterTahun;
        if ($req->FilterJenis == "Tanggal Pelaporan") {
            $kecamatan = M_district::where([
                'regency_id'   =>  3573
            ])->get();        
            $kasusKecamatan= collect();
            foreach($kecamatan as $data){            
                $temp = M_kasus::select( DB::raw('count(fk_id_district) as total'))            
                ->where('fk_id_district','=',$data->name)
                ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                ->get();                      
                // $temp[0]->put('fk_id_district' , $data->name);
                $temp[0]->fk_id_district = $data->name;
                $kasusKecamatan->add($temp[0]);
            }

            // $kasusKecamatan = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->where(DB::raw('year(hari)'),'=',$req->FilterTahun)->groupBy('fk_id_district')
            //                 ->get();  
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
            $dataWarna= array();        
            $kecamatan = M_district::where([
                'regency_id'   =>  3573
            ])->get(); 
            foreach($kecamatan as $data){
                $dataWarna[$data->name]="#f8f9fa";
            }            
            foreach ($kasusKecamatan as $data ) {
                $temp =array();
                $kecamatan = M_district::
                    where('name','=',$data->fk_id_district)            
                    ->first();
                $kelurahan = DB::table('villages')->where('district_id','=',$kecamatan->id)->get();        
                $datas = array();
                foreach($kelurahan as $data2){            
                    $temp2 = M_kasus::select( DB::raw('count(fk_id_villages) as total'))            
                    ->where('fk_id_villages','=',$data2->name)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();                              
                    $temp2[0]['fk_id_villages'] = $data2->name;
                    // dd($temp2);
                    array_push($datas,$temp2[0]);
                }            
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
                $kategoriLokKel = array();
                foreach($lokasi as $data2){            
                    $temp2 = M_kasus::select( DB::raw('count(kategori) as total'))            
                    ->where('kategori','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['kategori'] = $data2;
                    array_push($kategoriLokKel,$temp2[0]);            
                }        
                $kategoriLokKrbnKel = collect();
                foreach($lokasi as $data2){            
                    $temp2 = M_korban::select( DB::raw('count(kategori) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                        ->where('kategori','=',$data2)
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                        ->get();
                        $temp2[0]->kategori = $data2;
                        $kategoriLokKrbnKel->add($temp2[0]);            
                }                    
                $jenisLayananKel = array();
                foreach($pelayanan as $data2){            
                    $temp2 = M_pelayanan::select( DB::raw('count(pelayanan) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')               
                    ->where('pelayanan','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['pelayanan'] = $data2;
                    array_push($jenisLayananKel,$temp2[0]);            
                }                 
                $rentangUsiaKel = collect();
                foreach($usia as $data2){
                    $arr = explode(' ',$data2) ;
                    if(count($arr)==3){
                        $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                            ->whereBetween('usia',[$arr[0],$arr[2]])
                            ->where('fk_id_district','=',$data->fk_id_district)
                            ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                            ->get();                           
                        $temp2[0]->range_umur = $data2;
                        $rentangUsiaKel->add($temp2[0]);    
                    }else {
                        $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                            ->where('usia','>=',60)
                            ->where('fk_id_district','=',$data->fk_id_district)
                            ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                            ->get();                           
                        $temp2[0]->range_umur = $data2;
                        $rentangUsiaKel->add($temp2[0]);    
                    }
                }    
                $pendidikanKel =array();
                foreach($education as $data2){            
                    $temp2 = M_korban::select( DB::raw('count(pendidikan) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')               
                    ->where('pendidikan','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['pendidikan'] = $data2;
                    array_push($pendidikanKel,$temp2[0]);            
                }           
                $jnsKelaminKel =array();
                foreach($gender as $data2){            
                    $temp2 = M_pelaku::select( DB::raw('count(jenis_kelamin) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                    ->where('jenis_kelamin','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['jenis_kelamin'] = $data2;
                    array_push($jnsKelaminKel,$temp2[0]);            
                }             
                $hubPelakuKel =array();
                foreach($hubungan as $data2){            
                    $temp2 = M_pelaku::select( DB::raw('count(hubungan_dengan_korban) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                    ->where('hubungan_dengan_korban','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['hubungan_dengan_korban'] = $data2;
                    array_push($hubPelakuKel,$temp2[0]);            
                }                                                         
                $kekerasanKel = collect();
                foreach($Jnskekerasan  as $data2){            
                    $temp2 = DB::table('kekerasan')
                        ->select( DB::raw('count(jenis_kekerasan) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')            
                        ->where('jenis_kekerasan','=',$data2)
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                        ->get();
                        $temp2[0]->jenis_kekerasan = $data2;
                        $kekerasanKel->add($temp2[0]);            
                }
                array_push($temp,$data->fk_id_district);			
                array_push($temp,$datas);			            
                array_push($temp,$totJnsKelamin);	
                array_push($temp,$totKasusKec);
                array_push($temp,$kategoriLokKel);
                array_push($temp,$kategoriLokKrbnKel);
                array_push($temp,$jenisLayananKel);
                array_push($temp,$rentangUsiaKel);
                array_push($temp,$pendidikanKel);
                array_push($temp,$jnsKelaminKel);
                array_push($temp,$hubPelakuKel);
                array_push($temp,$kekerasanKel);
                array_push($kasusKelurahan,$temp);    
            }  
            $totKasusKec = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->where(DB::raw('year(hari)'),'=',$req->FilterTahun)->groupBy('fk_id_district')->get()->sortBy('total');
            $warna= array("#FFEF81","#FFDB6D","#FF9F31","#FF8331","#ff4e00");
            
            $i = 0;
            $j = 0;
            foreach ($totKasusKec as $data) {
                if($i==0){
                    $temp = $data;    
                    $dataWarna[$data->fk_id_district] = $warna[$j];
                }else{
                    if ($data->total > $temp->total){
                        $dataWarna[$data->fk_id_district] = $warna[++$j];                
                    }else{
                        $dataWarna[$data->fk_id_district] = $warna[$j];
                    }             
                }                      
                $temp = $data;
                $i++;            
            }
            
            $kategoriLok = collect();
            foreach($lokasi as $data){            
                $temp = M_kasus::select( DB::raw('count(kategori) as total'))            
                ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                ->where('kategori','=',$data)
                ->get();                                  
                $temp[0]->kategori = $data;
                $kategoriLok->add($temp[0]);            
            }        
            $kategoriLokKrbn = collect();
            foreach($lokasi as $data){            
                $temp = M_korban::select( DB::raw('count(kategori) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                ->where(DB::raw('year(hari)'),'=',$req->FilterTahun)
                ->where('kategori','=',$data)
                ->get();                                  
                $temp[0]->kategori = $data;
                $kategoriLokKrbn->add($temp[0]);            
            }
                        
            $jenisLayanan = collect();
            foreach($pelayanan as $data){            
                $temp = M_pelayanan::select( DB::raw('count(pelayanan) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')            
                ->where('pelayanan','=',$data)
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();                                  
                $temp[0]->pelayanan = $data;
                $jenisLayanan->add($temp[0]);            
            }
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
            $rentangUsia = collect();
            foreach($usia as $data){
                $arr = explode(' ',$data) ;
                if(count($arr)==3){
                    $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->whereBetween('usia',[$arr[0],$arr[2]])
                        ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                        ->get();                           
                    $temp[0]->range_umur = $data;
                    $rentangUsia->add($temp[0]);    
                }else {
                    $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->where('usia','>=',60)
                        ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                        ->get();                           
                    $temp[0]->range_umur = $data;
                    $rentangUsia->add($temp[0]);    
                }
            }
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
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
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
            $pendidikan = collect();
            foreach($education as $data){                                 
                $temp = DB::table('korban')->select(DB::raw('count(pendidikan) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                ->where('pendidikan','=',$data)
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->pendidikan = $data;
                $pendidikan->add($temp[0]);       
            }              
            $jnsKelamin = collect();
            foreach($gender as $data){                                 
                $temp = DB::table('pelaku')->select(DB::raw('count(jenis_kelamin) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                ->where('jenis_kelamin','=',$data)
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->jenis_kelamin = $data;
                $jnsKelamin->add($temp[0]);       
            }  
            $hubPelaku = collect();
            foreach($hubungan as $data){                                 
                $temp = DB::table('pelaku')->select(DB::raw('count(hubungan_dengan_korban) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                ->where('hubungan_dengan_korban','=',$data)
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->hubungan_dengan_korban = $data;
                $hubPelaku->add($temp[0]);       
            }         
            $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
            ->get();            
            $kekerasan = collect();
            foreach($Jnskekerasan as $data){                                 
                $temp = DB::table('kekerasan')->select(DB::raw('count(jenis_kekerasan) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')
                ->where('jenis_kekerasan','=',$data)
                ->where(DB::raw('year(kasus.hari)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->jenis_kekerasan = $data;
                $kekerasan->add($temp[0]);            
            }               
            // dd($jmlPelayanan);            
        }else{
            $kecamatan = M_district::where([
                'regency_id'   =>  3573
            ])->get();        
            $kasusKecamatan= collect();
            foreach($kecamatan as $data){            
                $temp = M_kasus::select( DB::raw('count(fk_id_district) as total'))            
                ->where('fk_id_district','=',$data->name)
                ->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)
                ->get();                      
                // $temp[0]->put('fk_id_district' , $data->name);
                $temp[0]->fk_id_district = $data->name;
                $kasusKecamatan->add($temp[0]);
            }
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
                $kecamatan = M_district::
                where('name','=',$data->fk_id_district)            
                ->first();
                $kelurahan = DB::table('villages')->where('district_id','=',$kecamatan->id)->get();        
                $datas = array();
                foreach($kelurahan as $data2){            
                    $temp2 = M_kasus::select( DB::raw('count(fk_id_villages) as total'))            
                    ->where('fk_id_villages','=',$data2->name)
                    ->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();                              
                    $temp2[0]['fk_id_villages'] = $data2->name;
                    // dd($temp2);
                    array_push($datas,$temp2[0]);
                }
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
                $kategoriLokKel = array();
                foreach($lokasi as $data2){            
                    $temp2 = M_kasus::select( DB::raw('count(kategori) as total'))            
                    ->where('kategori','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['kategori'] = $data2;
                    array_push($kategoriLokKel,$temp2[0]);            
                }        
                $kategoriLokKrbnKel = collect();
                foreach($lokasi as $data2){            
                    $temp2 = M_korban::select( DB::raw('count(kategori) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                        ->where('kategori','=',$data2)
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                        ->get();
                        $temp2[0]->kategori = $data2;
                        $kategoriLokKrbnKel->add($temp2[0]);            
                }                    
                $jenisLayananKel = array();
                foreach($pelayanan as $data2){            
                    $temp2 = M_pelayanan::select( DB::raw('count(pelayanan) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')               
                    ->where('pelayanan','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['pelayanan'] = $data2;
                    array_push($jenisLayananKel,$temp2[0]);            
                }                 
                $rentangUsiaKel = collect();
                foreach($usia as $data2){
                    $arr = explode(' ',$data2) ;
                    if(count($arr)==3){
                        $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                            ->whereBetween('usia',[$arr[0],$arr[2]])
                            ->where('fk_id_district','=',$data->fk_id_district)
                            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                            ->get();                           
                        $temp2[0]->range_umur = $data2;
                        $rentangUsiaKel->add($temp2[0]);    
                    }else {
                        $temp2 = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                            ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                            ->where('usia','>=',60)
                            ->where('fk_id_district','=',$data->fk_id_district)
                            ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                            ->get();                           
                        $temp2[0]->range_umur = $data2;
                        $rentangUsiaKel->add($temp2[0]);    
                    }
                }    
                $pendidikanKel =array();
                foreach($education as $data2){            
                    $temp2 = M_korban::select( DB::raw('count(pendidikan) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')               
                    ->where('pendidikan','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['pendidikan'] = $data2;
                    array_push($pendidikanKel,$temp2[0]);            
                }           
                $jnsKelaminKel =array();
                foreach($gender as $data2){            
                    $temp2 = M_pelaku::select( DB::raw('count(jenis_kelamin) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                    ->where('jenis_kelamin','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['jenis_kelamin'] = $data2;
                    array_push($jnsKelaminKel,$temp2[0]);            
                }             
                $hubPelakuKel =array();
                foreach($hubungan as $data2){            
                    $temp2 = M_pelaku::select( DB::raw('count(hubungan_dengan_korban) as total'))         
                    ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')               
                    ->where('hubungan_dengan_korban','=',$data2)
                    ->where('fk_id_district','=',$data->fk_id_district)
                    ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                    ->get()->toArray();
                    $temp2[0]['hubungan_dengan_korban'] = $data2;
                    array_push($hubPelakuKel,$temp2[0]);            
                }                                                         
                $kekerasanKel = collect();
                foreach($Jnskekerasan  as $data2){            
                    $temp2 = DB::table('kekerasan')
                        ->select( DB::raw('count(jenis_kekerasan) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')            
                        ->where('jenis_kekerasan','=',$data2)
                        ->where('fk_id_district','=',$data->fk_id_district)
                        ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                        ->get();
                        $temp2[0]->jenis_kekerasan = $data2;
                        $kekerasanKel->add($temp2[0]);            
                }                                
                array_push($temp,$data->fk_id_district);			
                array_push($temp,$datas);			            
                array_push($temp,$totJnsKelamin);	
                array_push($temp,$totKasusKec);
                array_push($temp,$kategoriLokKel);
                array_push($temp,$kategoriLokKrbnKel);
                array_push($temp,$jenisLayananKel);
                array_push($temp,$rentangUsiaKel);
                array_push($temp,$pendidikanKel);
                array_push($temp,$jnsKelaminKel);
                array_push($temp,$hubPelakuKel);
                array_push($temp,$kekerasanKel);
                array_push($kasusKelurahan,$temp);
            }
            $totKasusKec = M_kasus::select('fk_id_district', DB::raw('count(*) as total'))->where(DB::raw('year(kejadian)'),'=',$req->FilterTahun)->groupBy('fk_id_district')->get()->sortBy('total');
            $warna= array("#FFEF81","#FFDB6D","#FF9F31","#FF8331","#ff4e00");
            $dataWarna= array();        
            $kecamatan = M_district::where([
                'regency_id'   =>  3573
            ])->get(); 
            foreach($kecamatan as $data){
                $dataWarna[$data->name]="#f8f9fa";
            }
            $i = 0;
            $j = 0;
            foreach ($totKasusKec as $data) {
                if($i==0){
                    $temp = $data;    
                    $dataWarna[$data->fk_id_district] = $warna[$j];
                }else{
                    if ($data->total > $temp->total){
                        $dataWarna[$data->fk_id_district] = $warna[++$j];                
                    }else{
                        $dataWarna[$data->fk_id_district] = $warna[$j];
                    }             
                }                      
                $temp = $data;
                $i++;            
            }              
            $kategoriLok = collect();
            foreach($lokasi as $data){            
                $temp = M_kasus::select( DB::raw('count(kategori) as total'))            
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->where('kategori','=',$data)
                ->get();                                  
                $temp[0]->kategori = $data;
                $kategoriLok->add($temp[0]);            
            }        
            $kategoriLokKrbn = collect();
            foreach($lokasi as $data){            
                $temp = M_korban::select( DB::raw('count(kategori) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')            
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->where('kategori','=',$data)
                ->get();                                  
                $temp[0]->kategori = $data;
                $kategoriLokKrbn->add($temp[0]);            
            }                                      
            $jenisLayanan = collect();
            foreach($pelayanan as $data){            
                $temp = M_pelayanan::select( DB::raw('count(pelayanan) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelayanan.fk_id_kasus')            
                ->where('pelayanan','=',$data)
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->get();                                  
                $temp[0]->pelayanan = $data;
                $jenisLayanan->add($temp[0]);            
            }
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

            $rentangUsia = collect();
            foreach($usia as $data){
                $arr = explode(' ',$data) ;
                if(count($arr)==3){
                    $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->whereBetween('usia',[$arr[0],$arr[2]])
                        ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                        ->get();                           
                    $temp[0]->range_umur = $data;
                    $rentangUsia->add($temp[0]);    
                }else {
                    $temp = DB::table('korban')->select(DB::raw('count(usia) as total'))            
                        ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                        ->where('usia','>=',60)
                        ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                        ->get();                           
                    $temp[0]->range_umur = $data;
                    $rentangUsia->add($temp[0]);    
                }
            }
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
            $pendidikan = collect();
            foreach($education as $data){                                 
                $temp = DB::table('korban')->select(DB::raw('count(pendidikan) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'korban.fk_id_kasus')
                ->where('pendidikan','=',$data)
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)          
                ->get();                           
                $temp[0]->pendidikan = $data;
                $pendidikan->add($temp[0]);       
            }  
            $jnsKelamin = collect();
            foreach($gender as $data){                                 
                $temp = DB::table('pelaku')->select(DB::raw('count(jenis_kelamin) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                ->where('jenis_kelamin','=',$data)
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->jenis_kelamin = $data;
                $jnsKelamin->add($temp[0]);       
            }  
            $hubPelaku = collect();
            foreach($hubungan as $data){                                 
                $temp = DB::table('pelaku')->select(DB::raw('count(hubungan_dengan_korban) as total'))            
                ->join('kasus', 'kasus.id_kasus', '=', 'pelaku.fk_id_kasus')
                ->where('hubungan_dengan_korban','=',$data)
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->hubungan_dengan_korban = $data;
                $hubPelaku->add($temp[0]);       
            }         
            $jmlPelayanan = M_pelayanan::select('fk_id_korban', DB::raw('count(*) as total'))->groupBy('fk_id_korban')
            ->get();
            $kekerasan = collect();
            foreach($Jnskekerasan as $data){                                 
                $temp = DB::table('kekerasan')->select(DB::raw('count(jenis_kekerasan) as total'))
                ->join('kasus', 'kasus.id_kasus', '=', 'kekerasan.fk_id_kasus')
                ->where('jenis_kekerasan','=',$data)
                ->where(DB::raw('year(kasus.kejadian)'),'=',$req->FilterTahun)
                ->get();                           
                $temp[0]->jenis_kekerasan = $data;
                $kekerasan->add($temp[0]);            
            }                 
        }        
        return view('home',compact('filterJenis','filterTahun','tempatLaki','tempatPerempuan','pendidikanLaki','pendidikanPerempuan','pekerjaanLaki','pekerjaanPerempuan'
        ,'kasusKecamatan','totKasus','totLaki','totPerempuan','kasusKelurahan','kategoriLok'
        ,'kategoriLokKrbn','jenisLayanan','rentangUsia','rentangUsiaPelaku','korbanJnsKelamin'
        ,'pelakuJnsKelamin','rentangUsiaAnak','rentangUsiaPerempuan','pendidikan','jnsKelamin','kekerasan'
        ,'hubPelaku','statusUsiaKorban','statusUsiaPelaku','rentangUsiaLaki','rentangUsiaPerem','dataWarna'));
    }
}
