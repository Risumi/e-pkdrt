<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasusController extends Controller
{
    public function view()
    {   
        return view('kasus');
    }
    public function viewtambah()
    {   
        return view('formkasusnew');
    }
    public function viewedit($idKasus)
    {   
        return view('formkasus', ['idKasus' => $idKasus]);
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
