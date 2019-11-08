<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kasus;
use App\Models\M_korban;
use App\Models\M_pelayanan;
use App\Models\M_rujukan;
use App\Models\M_pelaku;
use App\Models\M_penanganan;

class KasusController extends Controller
{
    public function view() {   
        $kasus = M_kasus::all();
        return view('kasus', compact('kasus'));
    }
    public function viewtambah()
    {   
        return view('formkasusnew');
    }

    public function tambahKasus(Request $req){
        $this->validate($req, [
            'no_registrasi'   => 'required',
            'hari'   => 'required',
            'konselor'   => 'required',
            'deskripsi'   => 'required',
        ]);

        M_kasus::create([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => $req->hari,
            'konselor'         => $req->konselor,
            'deskripsi'        => $req->deskripsi
        ]);
        return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
    }

    public function editKasus(Request $req){
        $this->validate($req, [
            'no_registrasi'   => 'required',
            'hari'   => 'required',
            'konselor'   => 'required',
            'deskripsi'   => 'required'
        ]);

        M_kasus::where('id_kasus', $req->id_kasus)->update([
            'nomor_registrasi' => $req->no_registrasi,
            'hari'             => $req->hari,
            'konselor'         => $req->konselor,
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

        return view('formkasus', compact('kasus', 'korban', 'pelaku'));
    }

    public function viewtambahkorban($idKasus) {
        return view('formkorban', compact('idKasus'));
    }

    public function tambahKorban($idKasus, Request $req){
        $this->validate($req, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'usia'          => 'required',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
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
            'usia'          => 'required',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
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

     public function tambahPelayanan($idKorban, $idKasus, Request $req) {
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

    public function tambahRujukan($idKorban, $idKasus, Request $req) {
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
            'usia'          => 'required',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
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

    public function vieweditpelaku($idPelaku) {   
        return view('formpelaku');
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
            'deskripsi_proses' => $req->instansi,
            'fk_id_kasus'   => $idKasus,
            'fk_id_pelaku'  => $idPelaku
        ]);
        return redirect()->back()->with('notification', 'Penanganan berhasil ditambahkan');
    }    
}
