<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\M_kasus;
use App\Models\M_korban;
use App\Models\M_pelayanan;
use App\Models\M_rujukan;
use App\Models\M_pelaku;
use App\Models\M_penanganan;
// use DB;

class ReportController extends Controller {
    public function report(Request $req) {
        $tgl_triwulan = [
            ['awal' => '-01-01', 'akhir' => '-01-31'],
            ['awal' => '-04-01', 'akhir' => '-06-30'],
            ['awal' => '-07-01', 'akhir' => '-09-30'],
            ['awal' => '-10-01', 'akhir' => '-12-31']
        ];
        $tgl_semester = [
            ['awal' => '-01-01', 'akhir' => '-06-30'],
            ['awal' => '-07-01', 'akhir' => '-12-31']
        ];
        
        $tgl_mulai = null;
        $tgl_selesai = null;

        if($req->periode_kasus == 'Tanggal Kasus'){
            $tgl_mulai = $req->tgl1;
            $tgl_selesai = $req->tgl2;
        } else if($req->periode_kasus == 'Triwulan'){
            $triwulan1 = (int)$req->triwulan1 - 1;
            $triwulan2 = (int)$req->triwulan2 - 1;
            $tgl_mulai = $req->triwulan_tahun.  $tgl_triwulan[$triwulan1]['awal'];
            $tgl_selesai = $req->triwulan_tahun.  $tgl_triwulan[$triwulan2]['akhir'];
        } else if($req->periode_kasus == 'Semester'){
            $semester1 = (int)$req->semester1 - 1;
            $semester2 = (int)$req->semester2 - 1;
            $tgl_mulai = $req->semester_tahun.  $tgl_semester[$semester1]['awal'];
            $tgl_selesai = $req->semester_tahun.  $tgl_semester[$semester2]['akhir'];
        }
$data=null;
$dataPelaku=null;
$dataKekerasan=null;
$dataTerlayani=null;
$dataJenis4=null;
$kecamatan = $req->kecamatan;

        if($req->jenis_report == 'Ciri Korban & Pelaku'){
            $dataKorban = $this->getCiriKorban($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia, $req->kecamatan);
            $dataPelaku = $this->getCiriPelaku($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia);

        } else if($req->jenis_report == 'Bentuk Kekerasan, Tempat Kejadian & Pelayanan'){
            $dataKekerasan = $this->getReportKekerasan($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia);

        } else if($req->jenis_report == 'Kasus & Korban Anak/Dewasa Terlayani'){
            $dataTerlayani = $this->getReportTerlayani($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia);

        } else if($req->jenis_report == 'Kasus & Korban Laki-Laki/Perempuan Terlayani'){
            $dataJenis4 = $this->getReportTerlayaniJenis4($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia);

        }


        $jenis_report = $req->jenis_report;
        return view('report.report', compact('dataKorban', 'kecamatan', 'dataPelaku', 'dataKekerasan', 'dataTerlayani', 'dataJenis4', 'jenis_report'));
    }

    public function getCiriKorban($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia, $kecamatan) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = "kasus.hari >= '$tgl_mulai'";
            $where[] = "kasus.hari <= '$tgl_selesai'";
        }
        if($jenis_kelamin != null) {
            $where[] = "korban.jenis_kelamin = '$jenis_kelamin'";
        }
        if($status_usia != null) {  
            if($status_usia == 'Anak') {
                $where[] = "korban.usia <= 18";
            } else
                $where[] = "korban.usia > 18";
        }
        $arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];

        if($kecamatan == null){
            for ($i = 0; $i < count($arrKecamatan); $i++) {
                $kecamatan = $arrKecamatan[$i];

                $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' and ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');


                $sql = "SELECT ($sqlWhere AND (korban.usia BETWEEN 0 and 5)) as usia0_5, ($sqlWhere AND (korban.usia BETWEEN 6 and 12)) as usia6_12, ($sqlWhere AND (korban.usia BETWEEN 13 and 17)) as usia13_17, ($sqlWhere AND (korban.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (korban.usia BETWEEN 25 and 44)) as usia25_44, ($sqlWhere AND (korban.usia BETWEEN 45 and 59)) as usia45_59, ($sqlWhere AND (korban.usia >= 60)) as usia60, ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWhere AND korban.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND korban.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND korban.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND korban.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND korban.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND korban.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND korban.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND korban.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND korban.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND korban.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND korban.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND korban.status = 'Menikah') as status_menikah, ($sqlWhere AND korban.status = 'Duda/Janda') as status_dj, ($sqlWhere AND korban.status = 'Belum menikah') as status_belum, ($sqlWhere AND korban.status = 'Sirri') as status_sirri, ($sqlWhere AND korban.difabel = 'Ya') as difabel, ($sqlWhere AND korban.kdrt = 'Ya') as kdrt, (SELECT COUNT(*) FROM kasus where kasus.fk_id_district = '$kecamatan') as totalKasus ";
                // dd($sql);
                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');

            $sql = "SELECT ($sqlWhere AND (korban.usia BETWEEN 0 and 5)) as usia0_5, ($sqlWhere AND (korban.usia BETWEEN 6 and 12)) as usia6_12, ($sqlWhere AND (korban.usia BETWEEN 13 and 17)) as usia13_17, ($sqlWhere AND (korban.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (korban.usia BETWEEN 25 and 44)) as usia25_44, ($sqlWhere AND (korban.usia BETWEEN 45 and 59)) as usia45_59, ($sqlWhere AND (korban.usia >= 60)) as usia60, ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWhere AND korban.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND korban.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND korban.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND korban.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND korban.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND korban.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND korban.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND korban.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND korban.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND korban.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND korban.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND korban.status = 'Menikah') as status_menikah, ($sqlWhere AND korban.status = 'Duda/Janda') as status_dj, ($sqlWhere AND korban.status = 'Belum menikah') as status_belum, ($sqlWhere AND korban.status = 'Sirri') as status_sirri, ($sqlWhere AND korban.difabel = 'Ya') as difabel, ($sqlWhere AND korban.kdrt = 'Ya') as kdrt, (SELECT COUNT(*) FROM kasus where kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        // dd($hasil);
        return $hasil;
    }

    public function getCiriPelaku($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = ['kasus.hari', '>=', $tgl_mulai];
            $where[] = ['kasus.hari', '<=', $tgl_selesai];
        }
        if($jenis_kelamin != null) {
            $where[] = ['pelaku.jenis_kelamin', '=', $jenis_kelamin];
        }

        if($status_usia != null) {
            if($status_usia == 'Anak') {
                $where[] = ['pelaku.usia', '<=', 20];
            } else
                $where[] = ['pelaku.usia', '>', 20];
        }

        $result = M_kasus::where($where)
        ->join('pelaku', 'pelaku.fk_id_kasus', '=', 'kasus.id_kasus')
        ->get()
        ;

        $data = [];
        $data['usia_0-17'] = 0;
        $data['usia_18-24'] = 0;
        $data['usia_25-59'] = 0;
        $data['usia_60'] = 0;

        $keyPendidikan = ['pendidikan_tk', 'pendidikan_sd', 'pendidikan_smp', 'pendidikan_sma', 'pendidikan_sarjana'];
        $valuePendidikan = ['TK', 'SD', 'SMP', 'SMA', 'S1/S2/S3'];
        for ($i = 0; $i < count($keyPendidikan); $i++) { 
            $data[$keyPendidikan[$i]] = 0;
        }

        $keyPekerjaan = ['pekerjaan_ptn', 'pekerjaan_swasta', 'pekerjaan_pns', 'pekerjaan_pelajar', 'pekerjaan_irt', 'pekerjaan_tidakbekerja'];
        $valuePekerjaan = ['Pedagang/Tani/Nelayan', 'Swasta/Buruh', 'PNS/TNI/Polri', 'Pelajar', 'Ibu Rumah Tangga', 'Tidak Bekerja'];
        for ($i = 0; $i < count($keyPekerjaan); $i++) { 
            $data[$keyPekerjaan[$i]] = 0;
        }

        $keyPernikahan = ['pernikahan_belum', 'pernikahan_menikah', 'pernikahan_dudajanda', 'pernikahan_sirri'];
        $valuePernikahan = ['Belum Menikah', 'Menikah', 'Duda/Janda', 'Sirri'];
        for ($i = 0; $i < count($keyPernikahan); $i++) { 
            $data[$keyPernikahan[$i]] = 0;
        }

        $keyHubungan = ['hubungan_ortu', 'hubungan_keluarga', 'hubungan_sutri', 'hubungan_lainnya', 'hubungan_tetangga', 'hubungan_pacarteman', 'hubungan_guru', 'hubungan_majikan', 'hubungan_rekankerja'];
        $valueHubungan = ['Orang Tua', 'Keluarga/Saudara', 'Suami/Istri', 'Lainnya', 'Tetangga', 'Pacar/Teman', 'Guru', 'Majikan', 'Rekan Kerja'];
        for ($i = 0; $i < count($keyHubungan); $i++) { 
            $data[$keyHubungan[$i]] = 0;
        }

        foreach ($result as $dt) {
            if ($dt->usia <= 17) {
                $data['usia_0-17']++;
            } else if ($dt->usia >= 18 && $dt->usia <= 24) {
                $data['usia_18-24']++;
            } else if ($dt->usia >= 25 && $dt->usia <= 59) {
                $data['usia_25-59']++;
            } else if ($dt->usia >= 60) {
                $data['usia_60']++;
            }

            for ($i = 0; $i < count($keyPendidikan); $i++) { 
                if($dt->pendidikan == $valuePendidikan[$i]){
                    $data[$keyPendidikan[$i]]++;
                }
            }
            for ($i = 0; $i < count($keyPekerjaan); $i++) { 
                if($dt->pekerjaan == $valuePekerjaan[$i]){
                    $data[$keyPekerjaan[$i]]++;
                }
            }
            for ($i = 0; $i < count($keyPernikahan); $i++) { 
                if($dt->pekerjaan == $valuePernikahan[$i]){
                    $data[$keyPernikahan[$i]]++;
                }
            }
            for ($i = 0; $i < count($keyHubungan); $i++) { 
                if($dt->hubungan_dengan_korban == $valueHubungan[$i]){
                    $data[$keyHubungan[$i]]++;
                }
            }
        }
        return $data;
    }

    public function getReportKekerasan($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = ['kasus.hari', '>=', $tgl_mulai];
            $where[] = ['kasus.hari', '<=', $tgl_selesai];
        }
        if($jenis_kelamin != null) {
            $where[] = ['korban.jenis_kelamin', '=', $jenis_kelamin];
        }

        if($status_usia != null) {
            if($status_usia == 'Anak') {
                $where[] = ['korban.usia', '<=', 20];
            } else
                $where[] = ['korban.usia', '>', 20];
        }
        $result = M_kasus::where($where)
            ->leftJoin('korban', 'korban.fk_id_kasus', '=', 'kasus.id_kasus')
        // ->leftJoin('pelayanan', 'pelayanan.fk_id_korban', '=', 'korban.id_korban')
            ->get()
        ;

        $resultPelayanan = M_korban::where($where)
            ->join('pelayanan', 'pelayanan.fk_id_korban', '=', 'korban.id_korban')
            ->get()
        ;

        $data = [];

        $keyKekerasan = ['kekerasan_fisik', 'kekerasan_psikis', 'kekerasan_seksual', 'kekerasan_eksploitasi', 'kekerasan_trafficking', 'kekerasan_penelantaran', 'kekerasan_lainnya'];
        $valueKekerasan = ['Fisik', 'Psikis', 'Seksual', 'Eksploitasi', 'Trafficking', 'Penelantaran', 'Lainnya'];
        for ($i = 0; $i < count($keyKekerasan); $i++) { 
            $data[$keyKekerasan[$i]] = 0;
        }

        $keyTempat = ['tempat_rumah', 'tempat_kerja', 'tempat_lainnya', 'tempat_sekolah', 'tempat_fasilitasumum', 'tempat_lembagapendidikan'];
        $valueTempat = ['Rumah Tangga', 'Tempat Kerja', 'Lainnya', 'Sekolah', 'Fasilitas Umum', 'Lembaga Pendidikan Kilat'];
        for ($i = 0; $i < count($keyTempat); $i++) { 
            $data[$keyTempat[$i]] = 0;
        }

        $keyPelayanan = ['pelayanan_pengaduan', 'pelayanan_kesehatan', 'pelayanan_bantuanhukum', 'pelayanan_penegakanhukum', 'pelayanan_rehabilitasisosial', 'pelayanan_reintegrasisosial', 'pelayanan_pemulangan', 'pelayanan_pendampingantokohagama'];
        $valuePelayanan = ['Pengaduan', 'Kesehatan', 'Bantuan Hukum', 'Penegakan Hukum', 'Rehabilitasi Sosial', 'Reintegrasi Sosial', 'Pemulangan', 'Pendampingan Tokoh Agama'];
        for ($i = 0; $i < count($keyPelayanan); $i++) { 
            $data[$keyPelayanan[$i]] = 0;
        }

        foreach ($result as $dt) {
            $kekerasan = explode(",", $dt->tindak_kekerasan);
            for ($i = 0; $i < count($kekerasan); $i++) {
                for ($j = 0; $j < count($keyKekerasan); $j++) {
                    if($kekerasan[$i] == $valueKekerasan[$j]){
                        $data[$keyKekerasan[$j]]++;
                    }
                }
            }

            // for ($i = 0; $i < count($keyTempat); $i++) { 
            //     if($dt->pekerjaan == $valueTempat[$i]){
            //         $data[$keyPekerjaan[$i]]++;
            //     }
            // }
            // for ($i = 0; $i < count($keyPernikahan); $i++) { 
            //     if($dt->pekerjaan == $valuePernikahan[$i]){
            //         $data[$keyPernikahan[$i]]++;
            //     }
            // }
        }

        foreach ($resultPelayanan as $dt) {
            for ($i = 0; $i < count($keyPelayanan); $i++) { 
                if($dt->pelayanan == $valuePelayanan[$i]){
                    $data[$keyPelayanan[$i]]++;
                }
            }
        }
        return $data;
    }

    public function getReportTerlayani($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = ['kasus.hari', '>=', $tgl_mulai];
            $where[] = ['kasus.hari', '<=', $tgl_selesai];
        }
        if($jenis_kelamin != null) {
            $where[] = ['korban.jenis_kelamin', '=', $jenis_kelamin];
        }

        if($status_usia != null) {
            if($status_usia == 'Anak') {
                $where[] = ['korban.usia', '<=', 20];
            } else
                $where[] = ['korban.usia', '>', 20];
        }

        $result = M_kasus::where($where)->leftJoin('korban', 'korban.fk_id_kasus', '=', 'kasus.id_kasus')
        // ->leftJoin('pelayanan', 'pelayanan.fk_id_korban', '=', 'korban.id_korban')
        ->get()
        ;

        $data = [];

        $keyKorban = ['korban_n', 'korban_anak', 'korban_dewasa'];
        $valueKorban = ['Fisik', 'Psikis', 'Seksual', 'Eksploitasi', 'Trafficking', 'Penelantaran', 'Lainnya'];
        for ($i = 0; $i < count($keyKorban); $i++) { 
            $data[$keyKorban[$i]] = 0;
        }

        $keyTerlayani = ['terlayani_n', 'terlayani_anak', 'terlayani_dewasa'];
        $valueTerlayani = ['Rumah Tangga', 'Tempat Kerja', 'Lainnya', 'Sekolah', 'Fasilitas Umum', 'Lembaga Pendidikan Kilat'];
        for ($i = 0; $i < count($keyTerlayani); $i++) { 
            $data[$keyTerlayani[$i]] = 0;
        }

        foreach ($result as $dt) {
            if($dt->usia <= 20){
                $data['korban_anak']++;
            } else {
                $data['korban_dewasa']++;
            }
            // $kekerasan = explode(",", $dt->tindak_kekerasan);
            // for ($i = 0; $i < count($kekerasan); $i++) {
            //     for ($j = 0; $j < count($keyKekerasan); $j++) {
            //         if($kekerasan[$i] == $valueKekerasan[$j]){
            //             $data[$keyKekerasan[$j]]++;
            //         }
            //     }
            // }

            // for ($i = 0; $i < count($keyTempat); $i++) { 
            //     if($dt->pekerjaan == $valueTempat[$i]){
            //         $data[$keyPekerjaan[$i]]++;
            //     }
            // }
            // for ($i = 0; $i < count($keyPernikahan); $i++) { 
            //     if($dt->pekerjaan == $valuePernikahan[$i]){
            //         $data[$keyPernikahan[$i]]++;
            //     }
            // }
        }

        return $data;
    }

    public function getReportTerlayaniJenis4($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = ['kasus.hari', '>=', $tgl_mulai];
            $where[] = ['kasus.hari', '<=', $tgl_selesai];
        }
        if($jenis_kelamin != null) {
            $where[] = ['korban.jenis_kelamin', '=', $jenis_kelamin];
        }

        if($status_usia != null) {
            if($status_usia == 'Anak') {
                $where[] = ['korban.usia', '<=', 20];
            } else
                $where[] = ['korban.usia', '>', 20];
        }

        $result = M_kasus::where($where)->leftJoin('korban', 'korban.fk_id_kasus', '=', 'kasus.id_kasus')
        // ->leftJoin('pelayanan', 'pelayanan.fk_id_korban', '=', 'korban.id_korban')
        ->get()
        ;

        $data = [];

        $keyKorban = ['korban_lakilaki', 'korban_perempuan'];
        $valueKorban = ['Fisik', 'Psikis', 'Seksual', 'Eksploitasi', 'Trafficking', 'Penelantaran', 'Lainnya'];
        for ($i = 0; $i < count($keyKorban); $i++) { 
            $data[$keyKorban[$i]] = 0;
        }

        $keyTerlayani = ['terlayani_lakilaki', 'terlayani_perempuan', 'terlayani_persenlakilaki', 'terlayani_persenperempuan', 'terlayani_persentotal'];
        $valueTerlayani = ['Rumah Tangga', 'Tempat Kerja', 'Lainnya', 'Sekolah', 'Fasilitas Umum', 'Lembaga Pendidikan Kilat'];
        for ($i = 0; $i < count($keyTerlayani); $i++) { 
            $data[$keyTerlayani[$i]] = 0;
        }

        foreach ($result as $dt) {
            if($dt->jenis_kelamin == "Laki-laki"){
                $data['korban_lakilaki']++;
            } else {
                $data['korban_perempuan']++;
            }
            // $kekerasan = explode(",", $dt->tindak_kekerasan);
            // for ($i = 0; $i < count($kekerasan); $i++) {
            //     for ($j = 0; $j < count($keyKekerasan); $j++) {
            //         if($kekerasan[$i] == $valueKekerasan[$j]){
            //             $data[$keyKekerasan[$j]]++;
            //         }
            //     }
            // }

            // for ($i = 0; $i < count($keyTempat); $i++) { 
            //     if($dt->pekerjaan == $valueTempat[$i]){
            //         $data[$keyPekerjaan[$i]]++;
            //     }
            // }
            // for ($i = 0; $i < count($keyPernikahan); $i++) { 
            //     if($dt->pekerjaan == $valuePernikahan[$i]){
            //         $data[$keyPernikahan[$i]]++;
            //     }
            // }
        }

        return $data;
    }
}