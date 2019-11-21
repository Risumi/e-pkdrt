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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {
    public function viewLogin() {
        return view('login');
    }

    public function login(Request $req) {
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return Redirect::to('/');
        } else {
            return back()->with('notification', 'Email atau password anda salah');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
}