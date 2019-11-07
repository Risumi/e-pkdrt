<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kasus;

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
            'deskripsi'   => 'required',
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
        return view('formkasus', compact('kasus'));
        // return view('formkasus', ['idKasus' => $idKasus]);
    }
    public function viewtambahkorban()
    {   
        return view('formkorban');
    }
    public function vieweditkorban($idKorban)
    {   
        return view('formkorban');
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
