<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kasus;
use App\Models\M_korban;

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
        return view('formkasus', compact('kasus', 'korban'));
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
    public function editkorban($idKasus,$idKorban, Request $req)
    {   
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
    public function viewtambahpelaku()
    {   
        return view('formpelaku');
    }
    public function vieweditpelaku($idPelaku)
    {   
        return view('formpelaku');
    }
    public function viewtambahpelayanan($idKorban)
    {   
        return view('formpelayanan');
    }
    public function viewtambahrujukan($idKorban)
    {   
        return view('formrujukan');
    }
    public function viewtambahpenanganan($idPelaku)
    {   
        return view('formpenanganan');
    }
    
}
