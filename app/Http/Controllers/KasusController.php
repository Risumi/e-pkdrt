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
use DB;

class KasusController extends Controller
{
    public function view() {   
        $kasus = M_kasus::all();
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
        if(Auth::user()->id){
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
                'deskripsi'        => $req->deskripsi
            ]);
            return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
        } else {
            $this->pelaporTambahKasus($req);
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
        ]);
        M_kasus::where('id_kasus', $req->id_kasus)->update([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => $req->hari,
            'kejadian'         => $req->kejadian,
            'kategori'         => $req->kategori,
            'alamat_tkp'       => $req->TKP,
            'fk_id_district'   => $req->kecamatan,
            'fk_id_villages'   => $req->kelurahan,
            'deskripsi'        => $req->deskripsi
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
            'trafficking'   => 'required'
        ]);
        $tindak_kekerasan = implode(",",  $req->tindak_kekerasan);
        $trafficking = implode(",",  $req->trafficking);
        M_korban::create([
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
        
        M_korban::where('id_korban', $idKorban)->where('fk_id_kasus', $idKasus)->update([
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
            'pelayanan'         => 'required',
            'detail_pelayanan'  => 'required',
            'deskripsi_pelayanan' => 'required'
        ]);
        M_pelayanan::create([
            'instansi'          => $req->instansi,
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
        // dd($req);
        
        $this->validate($req, [
            'no_registrasi'   => 'required',
            'hari'   => 'required',            
            'kejadian'   => 'required',
            'kategori'   => 'required',
            'TKP'        => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'deskripsi'   => 'required',

            'nama_pelapor'          => 'required',
            'jenis_kelamin_pelapor' => 'required',
            'ttl_pelapor'           => 'required',
            'usia_pelapor'          => 'required|numeric|min:0',
            'alamat_pelapor'        => 'required',
            'telepon_pelapor'       => 'required|numeric|digits_between:0,12',
            'pendidikan_pelapor'    => 'required',
            'agama_pelapor'         => 'required',
            'pekerjaan_pelapor'     => 'required',
            'status_pelapor'        => 'required',

            'nama_korban'          => 'required',
            'jenis_kelamin_korban' => 'required',
            'usia_korban'          => 'required',
            'ttl_korban'           => 'required',
            'alamat_korban'        => 'required',
            'telepon_korban'       => 'required|numeric|digits_between:0,12',
            'pendidikan_korban'    => 'required',
            'agama_korban'         => 'required',
            'pekerjaan_korban'     => 'required',
            'status_korban'        => 'required',
            'difabel_korban'       => 'required',
            'kdrt_korban'          => 'required',
            'tindak_kekerasan_korban' => 'required',
            'trafficking_korban'   => 'required',

            'nama_pelaku'          => 'required',
            'jenis_kelamin_pelaku' => 'required',
            'usia_pelaku'          => 'required',
            'ttl_pelaku'           => 'required',
            'alamat_pelaku'        => 'required',
            'telepon_pelaku'       => 'required|numeric|digits_between:0,12',
            'pendidikan_pelaku'    => 'required',
            'agama_pelaku'         => 'required',
            'pekerjaan_pelaku'     => 'required',
            'status_pelaku'        => 'required',
            'difabel_pelaku'       => 'required',
            'hubungan_dengan_korban' => 'required'
        ]);

        // INSERT KASUS
        $ks = M_kasus::create([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => $req->hari,            
            'kejadian'         => $req->kejadian,
            'kategori'         => $req->kategori,
            'alamat_tkp'       => $req->TKP,
            'fk_id_district'   => $req->kecamatan,
            'fk_id_villages'   => $req->kelurahan,
            'deskripsi'        => $req->deskripsi
        ]);
        $id_kasus = $ks->id_kasus;
        //END INSERT KASUS

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
        $tindak_kekerasan = implode(",",  $req->tindak_kekerasan_korban);
        $trafficking = implode(",",  $req->trafficking_korban);
        M_korban::create([
            'nama'          => $req->nama_korban,
            'jenis_kelamin' => $req->jenis_kelamin_korban,
            'usia'          => $req->usia_korban,
            'ttl'           => $req->ttl_korban,
            'alamat'        => $req->alamat_korban,
            'telepon'       => $req->telepon_korban,
            'pendidikan'    => $req->pendidikan_korban,
            'agama'         => $req->agama_korban,
            'pekerjaan'     => $req->pekerjaan_korban,
            'status'        => $req->status_korban,
            'difabel'       => $req->difabel_korban,
            'kdrt'          => $req->kdrt_korban,
            'tindak_kekerasan' => $tindak_kekerasan,
            'kategori_trafficking'   => $trafficking,
            'fk_id_kasus'   => $id_kasus
        ]);
        //END INSERT KORBAN

        //INSERT PELAKU
        M_pelaku::create([
            'nama'          => $req->nama_pelaku,
            'jenis_kelamin' => $req->jenis_kelamin_pelaku,
            'usia'          => $req->usia_pelaku,
            'ttl'           => $req->ttl_pelaku,
            'alamat'        => $req->alamat_pelaku,
            'telepon'       => $req->telepon_pelaku,
            'pendidikan'    => $req->pendidikan_pelaku,
            'agama'         => $req->agama_pelaku,
            'pekerjaan'     => $req->pekerjaan_pelaku,
            'status'        => $req->status_pelaku,
            'difabel'       => $req->difabel_pelaku,
            'hubungan_dengan_korban' => $req->hubungan_dengan_korban,
            'fk_id_kasus'   => $id_kasus
        ]);
        //END INSERT PELAKU

        DB::table('laporan_publik')->insert([
            'fk_id_kasus' => $id_kasus,
            'fk_id_pelapor' => $id_pelapor
        ]);
        return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
    }
    public function getKelurahan(Request $req)
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
}
