<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\M_kasus;
use App\Models\M_korban;
use App\Models\M_pelayanan;
use App\Models\M_rujukan;
use App\Models\M_pelapor;
use App\Models\M_pelaku;
use App\Models\M_penanganan;
use App\Models\M_village;
use App\Models\M_district;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class KasusController extends Controller
{
    public function view() {   
        if(empty(Auth::user()->fk_id_villages)){
            $kasus = M_kasus::all();
        }else{
            $kasus = M_kasus::where('fk_id_villages','=',Auth::user()->fk_id_villages)->get();
        }        
        return view('kasus', compact('kasus'));
    }
    public function viewtambah()
    {                                     
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get();        
        if(M_kasus::count()!=0){
            $noRegist =M_kasus::get()->last()->id_kasus+1;        
        }else{
            $noRegist =1;
        }
        
        if(Auth::guest()){
            return view('lapor.formlaporkasus',compact('kecamatan','noRegist'));
        } else {
            return view('formkasusnew',compact('kecamatan','noRegist'));
        }
    }
    public function tambahKasus(Request $req){
        if(!Auth::guest()){
            $this->validate($req, [
                'no_registrasi'   => 'required',
                'hari'   => 'required',
                'kejadian'   => 'required',
                'kategori'   => 'required',
                'TKP'        => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'deskripsi'   => 'required',
            ]);
            M_kasus::create([
                'nomor_registrasi' => $req->no_registrasi,
                'hari'             => $req->hari,
                'kejadian'         => $req->kejadian,
                'kategori'         => $req->kategori,
                'alamat_tkp'       => $req->TKP,
                'fk_id_district'   => $req->kecamatan,
                'fk_id_villages'   => $req->kelurahan,
                'deskripsi'        => $req->deskripsi,
                'status'           => "Belum Diproses"
            ]);
            return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
        } else {
            $this->pelaporTambahKasus($req);
            if(session('totKorban') == null)
                return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
            else
                return redirect()->back()->withInput();
        }
    }

    public function editKasus(Request $req){
        $this->validate($req, [
            'no_registrasi'   => 'required',
            'hari'      => 'required',
            'kejadian'  => 'required',
            'kategori'  => 'required',
            'TKP'       => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'deskripsi' => 'required',
            'status'    => 'required',
        ]);
        M_kasus::where('id_kasus', $req->id_kasus)->update([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => $req->hari,
            'kejadian'         => $req->kejadian,
            'kategori'         => $req->kategori,
            'alamat_tkp'       => $req->TKP,
            'fk_id_district'   => $req->kecamatan,
            'fk_id_villages'   => $req->kelurahan,
            'deskripsi'        => $req->deskripsi,
            'status'           => $req->status
        ]);
        return redirect()->back()->with('notification', 'Kasus berhasil diperbaruhi');
    }
    public function viewedit($idKasus) {   
        $kasus = M_kasus::where('id_kasus', $idKasus)->get();
        $korban = M_korban::where([
            'fk_id_kasus'   => $idKasus
        ])->get();
        $pelaku = M_pelaku::where([
            'fk_id_kasus'   => $idKasus
        ])->get();
        $pelayanan = M_pelayanan::where([
            'fk_id_kasus'   => $idKasus
        ])->get();
        $penanganan = M_penanganan::where([
            'fk_id_kasus'   => $idKasus
        ])->get();
        $rujukan = M_rujukan::where([
            'fk_id_kasus'   => $idKasus
        ])->get();
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get();   
        return view('formkasus', compact('kecamatan','idKasus', 'kasus', 'korban', 'pelaku','pelayanan','penanganan','rujukan'));
    }
    public function viewtambahkorban($idKasus) {
        return view('formkorban', compact('idKasus'));
    }
    public function tambahKorban($idKasus, Request $req){
        $this->validate($req, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'usia'          => 'required|numeric|min:0',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required|numeric|digits_between:0,12',
            'pendidikan'    => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'status'        => 'required',
            'difabel'       => 'required',
            'kdrt'          => 'required',
            'tindak_kekerasan' => 'required',        
        ]);
        $tindak_kekerasan = implode(",",  $req->tindak_kekerasan);
        if(isset($req->$req->trafficking)){
            $trafficking = implode(",",  $req->trafficking);
        }else{
            $trafficking = null;
        }

        
        $krbn = M_korban::create([
            'nama'          => $req->nama,
            'jenis_kelamin' => $req->jenis_kelamin,
            'usia'          => $req->usia,
            'ttl'           => $req->ttl,
            'alamat'        => $req->alamat,
            'telepon'       => $req->telepon,
            'pendidikan'    => $req->pendidikan,
            'agama'         => $req->agama,
            'pekerjaan'     => $req->pekerjaan,
            'status'        => $req->status,
            'difabel'       => $req->difabel,
            'kdrt'          => $req->kdrt,
            'tindak_kekerasan' => $tindak_kekerasan,
            'kategori_trafficking'   => $trafficking,
            'fk_id_kasus'   => $idKasus
        ]);
        for ($i = 0; $i < count($req->tindak_kekerasan); $i++) { 
            DB::table('kekerasan')->insert([
                'jenis_kekerasan' => $req->tindak_kekerasan[$i],
                'fk_id_korban' => $krbn->id_korban,
                'fk_id_kasus' => $idKasus
            ]);
        }
        return redirect()->back()->with('notification', 'Korban berhasil ditambahkan');
    }
    public function vieweditkorban($idKorban,$idKasus)
    {   
        $korban = M_korban::where('id_korban', $idKorban)->where('fk_id_kasus', $idKasus)->first();        
        // dd($korban);
        return view('formkorbanedit', ['idKasus' => $idKasus,'idKorban'=>$idKorban],compact('korban'));
    }
    public function editkorban($idKasus,$idKorban, Request $req) {   
        $this->validate($req, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'usia'          => 'required|numeric|min:0',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required|numeric|digits_between:0,12',
            'pendidikan'    => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'status'        => 'required',
            'difabel'       => 'required',
            'kdrt'          => 'required',
            'tindak_kekerasan' => 'required',
            'trafficking'   => 'required'
        ]);
        $tindak_kekerasan = implode(",",  $req->tindak_kekerasan);
        $trafficking = implode(",",  $req->trafficking);
        
        $krbn = M_korban::where('id_korban', $idKorban)->where('fk_id_kasus', $idKasus)->update([
            'nama'          => $req->nama,
            'jenis_kelamin' => $req->jenis_kelamin,
            'usia'          => $req->usia,
            'ttl'           => $req->ttl,
            'alamat'        => $req->alamat,
            'telepon'       => $req->telepon,
            'pendidikan'    => $req->pendidikan,
            'agama'         => $req->agama,
            'pekerjaan'     => $req->pekerjaan,
            'status'        => $req->status,
            'difabel'       => $req->difabel,
            'kdrt'          => $req->kdrt,
            'tindak_kekerasan' => $tindak_kekerasan,
            'kategori_trafficking'   => $trafficking
        ]);
        DB::table('kekerasan')->where('fk_id_korban', '=', $idKorban)->delete();
        for ($i = 0; $i < count($req->tindak_kekerasan); $i++) { 
            DB::table('kekerasan')->insert([
                'jenis_kekerasan' => $req->tindak_kekerasan[$i],
                'fk_id_korban' => $idKorban,
                'fk_id_kasus' => $idKasus
            ]);
        }
        return redirect()->back()->with('notification', 'Korban berhasil diperbaruhi');
    }
    public function viewtambahpelayanan($idKorban, $idKasus) {
        // $pelayanan = M_pelayanan::where([
        //     'fk_id_kasus' => $idKasus,
        //     'fk_id_korban' => $idKorban
        // ])->get();
        // if($pelayanan->count() > 0)
        //     $pelayanan = $pelayanan[0];
        // $total_pelayanan = $pelayanan->count();
        return view('formpelayanan', compact('idKorban', 'idKasus'));
    }
     public function tambahPelayanan($idKasus, $idKorban, Request $req) {
        $this->validate($req, [
            'instansi'          => 'required',
            'tglPelayanan'      => 'required',
            'pelayanan'         => 'required',
            'detail_pelayanan'  => 'required',
            'deskripsi_pelayanan' => 'required'
        ]);
        M_pelayanan::create([
            'instansi'          => $req->instansi,
            'tglPelayanan'      => $req->tglPelayanan,
            'pelayanan'         => $req->pelayanan,
            'detail_pelayanan'  => $req->detail_pelayanan,
            'deskripsi_pelayanan' => $req->deskripsi_pelayanan,
            'fk_id_kasus'       => $idKasus,
            'fk_id_korban'      => $idKorban
        ]);
        return redirect()->back()->with('notification', 'Pelayanan berhasil ditambahkan');
    }
    public function viewtambahrujukan($idKorban, $idKasus) {
        return view('formrujukan', compact('idKasus', 'idKorban'));
    }
    public function tambahRujukan( $idKasus,$idKorban, Request $req) {
        $this->validate($req, [
            'tanggal_rujukan'   => 'required',
            'kota'              => 'required',
            'instansi'          => 'required',
            'deskripsi_rujukan' => 'required'
        ]);
        M_rujukan::create([
            'tanggal_rujukan'   => $req->tanggal_rujukan,
            'kota'              => $req->kota,
            'instansi'          => $req->instansi,
            'deskripsi_rujukan' => $req->deskripsi_rujukan,
            'fk_id_kasus'       => $idKasus,
            'fk_id_korban'      => $idKorban
        ]);
        return redirect()->back()->with('notification', 'Rujukan berhasil ditambahkan');
    }
    public function viewtambahpelaku($idKasus) {   
        return view('formpelaku', compact('idKasus'));
    }
    public function tambahPelaku($idKasus, Request $req) {
        $this->validate($req, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'usia'          => 'required|numeric|min:0',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required|numeric|digits_between:0,12',
            'pendidikan'    => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'status'        => 'required',
            'difabel'       => 'required',
            'hubungan_dengan_korban' => 'required'
        ]);
        M_pelaku::create([
            'nama'          => $req->nama,
            'jenis_kelamin' => $req->jenis_kelamin,
            'usia'          => $req->usia,
            'ttl'           => $req->ttl,
            'alamat'        => $req->alamat,
            'telepon'       => $req->telepon,
            'pendidikan'    => $req->pendidikan,
            'agama'         => $req->agama,
            'pekerjaan'     => $req->pekerjaan,
            'status'        => $req->status,
            'difabel'       => $req->difabel,
            'hubungan_dengan_korban' => $req->hubungan_dengan_korban,
            'fk_id_kasus'   => $idKasus
        ]);
        return redirect()->back()->with('notification', 'Pelaku berhasil ditambahkan');
    }

    public function vieweditpelaku($idKasus,$idPelaku) {
        $pelaku = M_pelaku::where('id_pelaku', $idPelaku)->where('fk_id_kasus', $idKasus)->first();            
        return view('formpelakuedit',compact('idKasus', 'idPelaku'),compact('pelaku'));
    }

    public function editpelaku($idKasus,$idPelaku, Request $req) {
        $this->validate($req, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'usia'          => 'required|numeric|min:0',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required|numeric|digits_between:0,12',
            'pendidikan'    => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'status'        => 'required',
            'difabel'       => 'required',
            'hubungan_dengan_korban' => 'required'
        ], ['required' => 'Kolom :attribute harus berisi nilai']);
        M_pelaku::where('id_pelaku', $idPelaku)->where('fk_id_kasus', $idKasus)->update([
            'nama'          => $req->nama,
            'jenis_kelamin' => $req->jenis_kelamin,
            'usia'          => $req->usia,
            'ttl'           => $req->ttl,
            'alamat'        => $req->alamat,
            'telepon'       => $req->telepon,
            'pendidikan'    => $req->pendidikan,
            'agama'         => $req->agama,
            'pekerjaan'     => $req->pekerjaan,
            'status'        => $req->status,
            'difabel'       => $req->difabel,
            'hubungan_dengan_korban' => $req->hubungan_dengan_korban
        ]);        
        return redirect()->back()->with('notification', 'Pelaku berhasil diperbaruhi');
    }
    public function viewtambahpenanganan($idKasus, $idPelaku) {   
        return view('formpenanganan', compact('idKasus', 'idPelaku'));
    }
    public function tambahPenanganan($idKasus, $idPelaku, Request $req) {   
         $this->validate($req, [
            'instansi'      => 'required',
            'jenis_proses'  => 'required',
            'deskripsi_proses' => 'required'
        ]);
        M_penanganan::create([
            'instansi'      => $req->instansi,
            'jenis_proses'  => $req->jenis_proses,
            'deskripsi_proses' => $req->deskripsi_proses,
            'fk_id_kasus'   => $idKasus,
            'fk_id_pelaku'  => $idPelaku
        ]);
        return redirect()->back()->with('notification', 'Penanganan berhasil ditambahkan');
    }    

    public function printkasus($idKasus) {   
        return view('printkasus', compact('idKasus'));
    }

    public function pelaporTambahKasus(Request $req){
        $rules = [
            'no_registrasi' => 'required',
            'nik'           => 'required|numeric|digits:16',
            'kejadian'      => 'required|date',
            'kategori'      => 'required|between:0,50',
            'TKP'           => 'required',
            'kecamatan'     => 'required|between:0,50',
            'kelurahan'     => 'required|between:0,50',
            'deskripsi'     => 'required',

            'nama_pelapor'          => 'required|between:0,255',
            'jenis_kelamin_pelapor' => 'required|between:0,20',
            'ttl_pelapor'           => 'required|between:0,50',
            'usia_pelapor'          => 'required|numeric|min:0|digits_between:0,9',
            'alamat_pelapor'        => 'required|between:0,255',
            'telepon_pelapor'       => 'required|numeric|digits_between:0,12',
            'pendidikan_pelapor'    => 'required|between:0,20',
            'agama_pelapor'         => 'required|between:0,20',
            'pekerjaan_pelapor'     => 'required|between:0,50',
            'status_pelapor'        => 'required|between:0,25',

            "nama_korban.*"          => "required|between:0,255",
            "jenis_kelamin_korban" => "required|between:0,20",
            "usia_korban.*"          => "required|numeric|min:0|digits_between:0,9",
            "ttl_korban.*"           => "required|between:0,100",
            "alamat_korban.*"        => "required|between:0,255",
            "telepon_korban.*"       => "required|numeric|digits_between:0,12",
            "pendidikan_korban.*"    => "required|between:0,20",
            "agama_korban.*"         => "required|between:0,20",
            "pekerjaan_korban.*"     => "required|between:0,30",
            "status_korban.*"        => "required|between:0,30",
            "difabel_korban"       => "required|between:0,10",
            "kdrt_korban"          => "required|between:0,10",
            "tindak_kekerasan_korban.0.0" => "required|between:0,100",

            'nama_pelaku.*'          => 'required|between:0,255',
            'jenis_kelamin_pelaku' => 'required|between:0,20',
            'usia_pelaku.*'          => 'required|numeric|min:0|digits_between:0,9',
            'ttl_pelaku.*'           => 'required|between:0,100',
            'alamat_pelaku.*'        => 'required|between:0,255',
            'telepon_pelaku.*'       => 'required|numeric|digits_between:0,12',
            'pendidikan_pelaku.*'    => 'required|between:0,20',
            'agama_pelaku.*'         => 'required|between:0,20',
            'pekerjaan_pelaku.*'     => 'required|between:0,30',
            'status_pelaku.*'        => 'required|between:0,30',
            'difabel_pelaku'       => 'required|between:0,10',
            'hubungan_dengan_korban.*' => 'required|between:0,90'
        ];
        if(isset($req->tindak_kekerasan_korban[0]) && $req->tindak_kekerasan_korban[0] != null){
            $dataKekerasan = implode(",",  $req->tindak_kekerasan_korban[0]);
            if(strpos($dataKekerasan, 'Trafficking') !== false){
                $rules["trafficking_korban.0.0"] = 'required';
            }
        }

        for ($i = 1; $i < count($req->nama_korban); $i++) { 
            $rules["jenis_kelamin_korban$i"] = 'required';
            $rules["difabel_korban$i"] = 'required';
            $rules["kdrt_korban$i"] = 'required';
            $rules["tindak_kekerasan_korban.".$i.'.0'] = 'required';

            if(isset($req->tindak_kekerasan_korban[$i]) && $req->tindak_kekerasan_korban[$i] != null){
                $dataKekerasan = implode(",",  $req->tindak_kekerasan_korban[$i]);
                if(strpos($dataKekerasan, 'Trafficking') !== false){
                    $rules["trafficking_korban.".$i.".0"] = 'required';
                }
            }
        }
        for ($i = 1; $i < count($req->nama_pelaku); $i++) { 
            $rules["jenis_kelamin_pelaku$i"] = 'required';
            $rules["difabel_pelaku$i"] = 'required';
        }

        $validator = Validator::make($req->all(), $rules, [
            'required'       => 'Kolom :attribute harus berisi nilai',
            'numeric'        => 'Kolom :attribute harus berupa angka',
            'min'            => 'Kolom :attribute minimal :min',
            'digits_between' => 'Kolom :attribute maksimal :max digit',
            'digits'         => 'Pastikan NIK benar sesuai format',
            'between'        => 'Kolom :attribute maksimal :max karakter',
            'date'           => 'Pastikan format tanggal benar'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'totKorban' => count($req->nama_korban),
                'totPelaku' => count($req->nama_pelaku)
            ]);
        }

        // INSERT KASUS
        date_default_timezone_set('Asia/Jakarta');
        $ks = M_kasus::create([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => date('Y-m-d'),
            'kejadian'         => $req->kejadian,
            'kategori'         => $req->kategori,
            'alamat_tkp'       => $req->TKP,
            'fk_id_district'   => $req->kecamatan,
            'fk_id_villages'   => $req->kelurahan,
            'deskripsi'        => $req->deskripsi,
            'status'           => "Belum Diproses"
        ]);
        $id_kasus = $ks->id_kasus;
        //END INSERT KASUS
        // dd($req);
        // dd($rules);

        //INSERT PELAPOR
        $pelapor = M_pelapor::create([
            'nama'          => $req->nama_pelapor,
            'jenis_kelamin' => $req->jenis_kelamin_pelapor,
            'usia'          => $req->usia_pelapor,
            'ttl'           => $req->ttl_pelapor,
            'alamat'        => $req->alamat_pelapor,
            'telepon'       => $req->telepon_pelapor,
            'pendidikan'    => $req->pendidikan_pelapor,
            'agama'         => $req->agama_pelapor,
            'pekerjaan'     => $req->pekerjaan_pelapor,
            'status'        => $req->status_pelapor
        ]);
        $id_pelapor = $pelapor->id_pelapor;
        //END INSERT PELAPOR

        //INSERT KORBAN
        for ($i = 0; $i < count($req->nama_korban); $i++) { 
            $tindak_kekerasan = implode(",",  $req->tindak_kekerasan_korban[$i]);

            $dataKorban = [
                'nama'          => $req->nama_korban[$i],
                'usia'          => $req->usia_korban[$i],
                'ttl'           => $req->ttl_korban[$i],
                'alamat'        => $req->alamat_korban[$i],
                'telepon'       => $req->telepon_korban[$i],
                'pendidikan'    => $req->pendidikan_korban[$i],
                'agama'         => $req->agama_korban[$i],
                'pekerjaan'     => $req->pekerjaan_korban[$i],
                'status'        => $req->status_korban[$i],
                'tindak_kekerasan' => $tindak_kekerasan,
                // 'kategori_trafficking'   => $trafficking,
                'fk_id_kasus'   => $id_kasus
            ];
            $dataKekerasan = implode(",",  $req->tindak_kekerasan_korban[$i]);
            if(strpos($dataKekerasan, 'Trafficking') !== false){
                $dataKorban['kategori_trafficking'] = implode(",",  $req->trafficking_korban[$i]);
            }
            if($i == 0){
                $dataKorban['jenis_kelamin'] = $req->jenis_kelamin_korban;
                $dataKorban['difabel']       = $req->difabel_korban;
                $dataKorban['kdrt']          = $req->kdrt_korban;
            } else {
                $keyJK = "jenis_kelamin_korban" . $i;
                $keyDifabel = "difabel_korban" . $i;
                $keyKdrt = "kdrt_korban" . $i;

                $dataKorban['jenis_kelamin'] = $req->$keyJK;
                $dataKorban['difabel']  = $req->$keyDifabel;
                $dataKorban['kdrt']     = $req->$keyKdrt;
            }

            $krbn = M_korban::create($dataKorban);
            $id_korban = $krbn->id_korban;
            for ($j = 0; $j < count($req->tindak_kekerasan_korban[$i]); $j++) { 
                DB::table('kekerasan')->insert([
                    'jenis_kekerasan' => $req->tindak_kekerasan_korban[$i][$j],
                    'fk_id_korban' => $id_korban,
                    'fk_id_kasus' => $id_kasus
                ]);
            }
        }
        //END INSERT KORBAN

        //INSERT PELAKU
        for ($j = 0; $j < count($req->nama_pelaku); $j++) { 
            $dataPelaku = [
                'nama'          => $req->nama_pelaku[$j],
                'usia'          => $req->usia_pelaku[$j],
                'ttl'           => $req->ttl_pelaku[$j],
                'alamat'        => $req->alamat_pelaku[$j],
                'telepon'       => $req->telepon_pelaku[$j],
                'pendidikan'    => $req->pendidikan_pelaku[$j],
                'agama'         => $req->agama_pelaku[$j],
                'pekerjaan'     => $req->pekerjaan_pelaku[$j],
                'status'        => $req->status_pelaku[$j],
                'hubungan_dengan_korban' => $req->hubungan_dengan_korban[$j],
                'fk_id_kasus'   => $id_kasus
            ];
            if($j == 0){
                $dataPelaku['jenis_kelamin'] = $req->jenis_kelamin_pelaku;
                $dataPelaku['difabel']       = $req->difabel_pelaku;
            } else {
                $keyJK = "jenis_kelamin_pelaku" . $j;
                $keyDifabel = "difabel_pelaku" . $j;

                $dataPelaku['jenis_kelamin'] = $req->$keyJK;
                $dataPelaku['difabel']       = $req->$keyDifabel;
            }
            M_pelaku::create($dataPelaku);
        }
        //END INSERT PELAKU

        DB::table('laporan_publik')->insert([
            'fk_id_kasus' => $id_kasus,
            'fk_id_pelapor' => $id_pelapor
        ]);
    }

    public function getKelurahan(Request $req)
    {
        $kelurahan = M_village::select('villages.name')
        ->join('districts', 'districts.id',  '=',"villages.district_id")
        ->where('districts.name','=',$req->id_district)->
        get();
        $kelurahanData="";        
        $kasus = M_kasus::where("id_kasus","=",$req->id_kasus)->first();
        foreach ($kelurahan as $data ) {            
            if($kasus->fk_id_villages == $data->name){
                $kelurahanData .='<option selected value="'.$data->name.'">'.$data->name.'</option>';
            }else{
                $kelurahanData .='<option value="'.$data->name.'">'.$data->name.'</option>';
            }                
        }
        return response($kelurahanData) ;
    }

    public function getKelurahanData(Request $req)
    {
        $kelurahan = M_village::select('villages.name')
        ->join('districts', 'districts.id',  '=',"villages.district_id")
        ->where('districts.name','=',$req->id_district)->
        get();
        $kelurahanData="";             
        foreach ($kelurahan as $data ) {                        
            $kelurahanData .='<option value="'.$data->name.'">'.$data->name.'</option>';                        
        }
        return response($kelurahanData) ;
    }

    public function nyoba()
    {
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get();
        if(M_kasus::count()!=0){
            $noRegist =M_kasus::get()->last()->id_kasus+1;
        }else{
            $noRegist =1;
        }
        return view('nyoba',compact('kecamatan','noRegist'));
    }

    public function nyobaNew()
    {
        $kecamatan = M_district::where([
            'regency_id'   =>  3573
        ])->get();
        if(M_kasus::count()!=0){
            $noRegist =M_kasus::get()->last()->id_kasus+1;
        }else{
            $noRegist =1;
        }
        return view('nyoba',compact('kecamatan','noRegist'));
    }

    public function deleteKasus($idKasus)
    {
        DB::table('kasus')->where('id_kasus', '=', $idKasus)->delete();
        DB::table('korban')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('pelaku')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('pelapor')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('laporan_publik')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('kekerasan')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('pelayanan')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('penanganan')->where('fk_id_kasus', '=', $idKasus)->delete();
        DB::table('rujukan')->where('fk_id_kasus', '=', $idKasus)->delete();
        return redirect()->action('KasusController@view');
    }

    public function deleteKorban($idKasus,$idKorban)
    {
        DB::table('korban')->where('fk_id_kasus', '=', $idKasus)
            ->where('id_korban', '=', $idKorban)->delete();
        DB::table('kekerasan')->where('fk_id_kasus', '=', $idKasus)
            ->where('fk_id_korban', '=', $idKorban)->delete();
        DB::table('pelayanan')->where('fk_id_kasus', '=', $idKasus)
            ->where('fk_id_korban', '=', $idKorban)->delete();
        DB::table('rujukan')->where('fk_id_kasus', '=', $idKasus)
            ->where('fk_id_korban', '=', $idKorban)->delete();
        return redirect()->action('KasusController@editKasus',$idKasus);
    }

    public function deletePelaku($idKasus,$idPelaku)
    {
        DB::table('pelaku')->where('fk_id_kasus', '=', $idKasus)
            ->where('id_pelaku', '=', $idPelaku)->delete();
        DB::table('penanganan')->where('fk_id_kasus', '=', $idKasus)
            ->where('fk_id_pelaku', '=', $idPelaku)->delete();        
        return redirect()->action('KasusController@editKasus',$idKasus);
    }
}