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
        return view('formkasus');
    }
    public function viewtambahkorban()
    {   
        return view('formkorban');
    }
    public function viewtambahpelaku()
    {   
        return view('formpelaku');
    }
}
