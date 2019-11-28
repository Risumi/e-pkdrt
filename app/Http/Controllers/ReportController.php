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
            $dataPelaku = $this->getCiriPelaku($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia, $req->kecamatan);

        } else if($req->jenis_report == 'Bentuk Kekerasan, Tempat Kejadian & Pelayanan'){
            $dataKekerasan = $this->getReportKekerasan($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia, $req->kecamatan);

        } else if($req->jenis_report == 'Kasus & Korban Anak/Dewasa Terlayani'){
            $dataTerlayani = $this->getReportTerlayani($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia, $req->kecamatan);

        } else if($req->jenis_report == 'Kasus & Korban Laki-Laki/Perempuan Terlayani'){
            $dataJenisKelamin = $this->getReportTerlayaniJenisKelamin($tgl_mulai, $tgl_selesai, $req->jenis_kelamin, $req->status_usia, $req->kecamatan);

        }


        $jenis_report = $req->jenis_report;
        return view('report.report', compact('dataKorban', 'kecamatan', 'dataPelaku', 'dataKekerasan', 'dataTerlayani', 'dataJenisKelamin', 'jenis_report'));
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


                $sql = "SELECT ($sqlWhere AND (korban.usia BETWEEN 0 and 5)) as usia0_5, ($sqlWhere AND (korban.usia BETWEEN 6 and 12)) as usia6_12, ($sqlWhere AND (korban.usia BETWEEN 13 and 17)) as usia13_17, ($sqlWhere AND (korban.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (korban.usia BETWEEN 25 and 44)) as usia25_44, ($sqlWhere AND (korban.usia BETWEEN 45 and 59)) as usia45_59, ($sqlWhere AND (korban.usia >= 60)) as usia60, ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWhere AND korban.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND korban.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND korban.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND korban.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND korban.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND korban.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND korban.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND korban.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND korban.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND korban.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND korban.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND korban.status = 'Menikah') as status_menikah, ($sqlWhere AND korban.status = 'Duda/Janda') as status_dj, ($sqlWhere AND korban.status = 'Belum menikah') as status_belum, ($sqlWhere AND korban.status = 'Sirri') as status_sirri, ($sqlWhere AND korban.difabel = 'Ya') as difabel, ($sqlWhere AND korban.kdrt = 'Ya') as kdrt, ($sqlWhere AND korban.difabel = 'Ya') as difabel, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";

                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');

                $sql = "SELECT ($sqlWhere AND (korban.usia BETWEEN 0 and 5)) as usia0_5, ($sqlWhere AND (korban.usia BETWEEN 6 and 12)) as usia6_12, ($sqlWhere AND (korban.usia BETWEEN 13 and 17)) as usia13_17, ($sqlWhere AND (korban.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (korban.usia BETWEEN 25 and 44)) as usia25_44, ($sqlWhere AND (korban.usia BETWEEN 45 and 59)) as usia45_59, ($sqlWhere AND (korban.usia >= 60)) as usia60, ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWhere AND korban.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND korban.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND korban.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND korban.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND korban.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND korban.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND korban.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND korban.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND korban.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND korban.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND korban.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND korban.status = 'Menikah') as status_menikah, ($sqlWhere AND korban.status = 'Duda/Janda') as status_dj, ($sqlWhere AND korban.status = 'Belum menikah') as status_belum, ($sqlWhere AND korban.status = 'Sirri') as status_sirri, ($sqlWhere AND korban.difabel = 'Ya') as difabel, ($sqlWhere AND korban.kdrt = 'Ya') as kdrt, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        return $hasil;
    }

    public function getCiriPelaku($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia, $kecamatan) {
        $where = array();
        if($tgl_mulai != null && $tgl_selesai != null){
            $where[] = "kasus.hari >= '$tgl_mulai'";
            $where[] = "kasus.hari <= '$tgl_selesai'";
        }
        if($jenis_kelamin != null) {
            $where[] = "pelaku.jenis_kelamin = '$jenis_kelamin'";
        }
        if($status_usia != null) {  
            if($status_usia == 'Anak') {
                $where[] = "pelaku.usia <= 18";
            } else
                $where[] = "pelaku.usia > 18";
        }
        $arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];

        if($kecamatan == null){
            for ($i = 0; $i < count($arrKecamatan); $i++) {
                $kecamatan = $arrKecamatan[$i];

                $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN pelaku on kasus.id_kasus = pelaku.fk_id_kasus ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' and ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');


                $sql = "SELECT ($sqlWhere AND (pelaku.usia BETWEEN 0 and 17)) as usia0_17, ($sqlWhere AND (pelaku.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (pelaku.usia BETWEEN 25 and 59)) as usia25_59, ($sqlWhere AND (pelaku.usia >= 60)) as usia60, ($sqlWhere AND pelaku.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND pelaku.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND pelaku.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND pelaku.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND pelaku.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND pelaku.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND pelaku.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND pelaku.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND pelaku.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND pelaku.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND pelaku.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND pelaku.status = 'Menikah') as status_menikah, ($sqlWhere AND pelaku.status = 'Duda/Janda') as status_dj, ($sqlWhere AND pelaku.status = 'Belum menikah') as status_belum, ($sqlWhere AND pelaku.status = 'Sirri') as status_sirri, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Orang Tua') as hubungan_ortu, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Keluarga/Saudara') as hubungan_keluarga, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Suami/Istri') as hubungan_sutri, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Lainnya') as hubungan_lainnya, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Tetangga') as hubungan_tetangga, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Pacar/Teman') as hubungan_pacarteman, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Guru') as hubungan_guru, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Majikan') as hubungan_majikan, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Rekan Kerja') as hubungan_rekankerja, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";

                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN pelaku on kasus.id_kasus = pelaku.fk_id_kasus ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');

            $sql = "SELECT ($sqlWhere AND (pelaku.usia BETWEEN 0 and 17)) as usia0_17, ($sqlWhere AND (pelaku.usia BETWEEN 18 and 24)) as usia18_24, ($sqlWhere AND (pelaku.usia BETWEEN 25 and 59)) as usia25_59, ($sqlWhere AND (pelaku.usia >= 60)) as usia60, ($sqlWhere AND pelaku.pendidikan = 'TK') as pendidikan_tk, ($sqlWhere AND pelaku.pendidikan = 'SD') as pendidikan_sd, ($sqlWhere AND pelaku.pendidikan = 'SMP') as pendidikan_smp, ($sqlWhere AND pelaku.pendidikan = 'SMA') as pendidikan_sma, ($sqlWhere AND pelaku.pendidikan = 'S1/S2/S3') as pendidikan_sarjana, ($sqlWhere AND pelaku.pekerjaan = 'Pedagang/Tani/Nelayan') as pekerjaan_ptn, ($sqlWhere AND pelaku.pekerjaan = 'Pelajar') as pekerjaan_pelajar, ($sqlWhere AND pelaku.pekerjaan = 'Swasta/Buruh') as pekerjaan_swasta, ($sqlWhere AND pelaku.pekerjaan = 'Ibu Rumah Tangga') as pekerjaan_irt, ($sqlWhere AND pelaku.pekerjaan = 'Tidak bekerja') as pekerjaan_tidak, ($sqlWhere AND pelaku.pekerjaan = 'PNS/TNI/Polri') as pekerjaan_pns, ($sqlWhere AND pelaku.status = 'Menikah') as status_menikah, ($sqlWhere AND pelaku.status = 'Duda/Janda') as status_dj, ($sqlWhere AND pelaku.status = 'Belum menikah') as status_belum, ($sqlWhere AND pelaku.status = 'Sirri') as status_sirri, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Orang Tua') as hubungan_ortu, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Keluarga/Saudara') as hubungan_keluarga, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Suami/Istri') as hubungan_sutri, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Lainnya') as hubungan_lainnya, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Tetangga') as hubungan_tetangga, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Pacar/Teman') as hubungan_pacarteman, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Guru') as hubungan_guru, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Majikan') as hubungan_majikan, ($sqlWhere AND pelaku.hubungan_dengan_korban = 'Rekan Kerja') as hubungan_rekankerja, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        return $hasil;
    }

    public function getReportKekerasan($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia, $kecamatan) {
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

                $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus right JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');
                // $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN pelayanan on kasus.id_kasus = pelayanan.fk_id_kasus ". 
                $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus right JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');


                $sql = "SELECT ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Fisik%')) as kekerasan_fisik, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Psikis%')) as kekerasan_psikis, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Seksual%')) as kekerasan_seksual, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Eksploitasi%')) as kekerasan_eksploitasi, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Trafficking%')) as kekerasan_trafficking, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Penelantaran%')) as kekerasan_penelantaran, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Lainnya%')) as kekerasan_lainnya, ($sqlWhere AND (kasus.kategori = 'Tempat Kerja')) as tempat_kerja, ($sqlWhere AND (kasus.kategori = 'Fasilitas Umum')) as tempat_fasilitasumum, ($sqlWhere AND (kasus.kategori = 'Lainnya')) as tempat_lainnya, ($sqlWhere AND (kasus.kategori = 'Sekolah')) as tempat_sekolah, ($sqlWhere AND (kasus.kategori = 'Rumah Tangga')) as tempat_rumah, ($sqlWherePel AND (pelayanan.pelayanan = 'Reintegrasi sosial')) as pelayanan_reintegrasisosial, ($sqlWherePel AND (pelayanan.pelayanan = 'Bantuan hukum')) as pelayanan_bantuanhukum, ($sqlWherePel AND (pelayanan.pelayanan = 'Pemulangan')) as pelayanan_pemulangan, ($sqlWherePel AND (pelayanan.pelayanan = 'Kesehatan')) as pelayanan_kesehatan, ($sqlWherePel AND (pelayanan.pelayanan = 'Pendampingan tokoh agama')) as pelayanan_pendampingantokohagama, ($sqlWherePel AND (pelayanan.pelayanan = 'Pengaduan')) as pelayanan_pengaduan, ($sqlWherePel AND (pelayanan.pelayanan = 'Penegakan hukum')) as pelayanan_penegakanhukum, ($sqlWherePel AND (pelayanan.pelayanan = 'Rehabiitasi sosial')) as pelayanan_rehabilitasisosial, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";

                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus right JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');
                $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus right JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');

                $sql = "SELECT ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Fisik%')) as kekerasan_fisik, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Psikis%')) as kekerasan_psikis, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Seksual%')) as kekerasan_seksual, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Eksploitasi%')) as kekerasan_eksploitasi, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Trafficking%')) as kekerasan_trafficking, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Penelantaran%')) as kekerasan_penelantaran, ($sqlWhere AND (korban.tindak_kekerasan LIKE '%Lainnya%')) as kekerasan_lainnya, ($sqlWhere AND (kasus.kategori = 'Tempat Kerja')) as tempat_kerja, ($sqlWhere AND (kasus.kategori = 'Fasilitas Umum')) as tempat_fasilitasumum, ($sqlWhere AND (kasus.kategori = 'Lainnya')) as tempat_lainnya, ($sqlWhere AND (kasus.kategori = 'Sekolah')) as tempat_sekolah, ($sqlWhere AND (kasus.kategori = 'Rumah Tangga')) as tempat_rumah, ($sqlWherePel AND (pelayanan.pelayanan = 'Reintegrasi sosial')) as pelayanan_reintegrasisosial, ($sqlWherePel AND (pelayanan.pelayanan = 'Bantuan hukum')) as pelayanan_bantuanhukum, ($sqlWherePel AND (pelayanan.pelayanan = 'Pemulangan')) as pelayanan_pemulangan, ($sqlWherePel AND (pelayanan.pelayanan = 'Kesehatan')) as pelayanan_kesehatan, ($sqlWherePel AND (pelayanan.pelayanan = 'Pendampingan tokoh agama')) as pelayanan_pendampingantokohagama, ($sqlWherePel AND (pelayanan.pelayanan = 'Pengaduan')) as pelayanan_pengaduan, ($sqlWherePel AND (pelayanan.pelayanan = 'Penegakan hukum')) as pelayanan_penegakanhukum, ($sqlWherePel AND (pelayanan.pelayanan = 'Rehabiitasi sosial')) as pelayanan_rehabilitasisosial, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        return $hasil;
    }

    public function getReportTerlayani($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia, $kecamatan) {
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
                $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus left JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');

                $sql = "SELECT ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWherePel AND (korban.usia <= 18) AND (pelayanan.id_pelayanan is not null)) as terlayani_anak, ($sqlWherePel AND (korban.usia > 18) AND (pelayanan.id_pelayanan is not null)) as terlayani_dewasa, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";

                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');
            $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus left JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');

                $sql = "SELECT ($sqlWhere AND (korban.usia <= 18)) as usiaanak, ($sqlWhere AND (korban.usia > 18)) as usiadewasa, ($sqlWherePel AND (korban.usia <= 18) AND (pelayanan.id_pelayanan is not null)) as terlayani_anak, ($sqlWherePel AND (korban.usia > 18) AND (pelayanan.id_pelayanan is not null)) as terlayani_dewasa, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        return $hasil;
    }

    public function getReportTerlayaniJenisKelamin($tgl_mulai, $tgl_selesai, $jenis_kelamin, $status_usia, $kecamatan) {
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
                $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus left JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');

                $sql = "SELECT ($sqlWhere AND (korban.jenis_kelamin = 'Laki-laki')) as jenis_laki, ($sqlWhere AND (korban.jenis_kelamin = 'Perempuan')) as jenis_perempuan, ($sqlWherePel AND (korban.jenis_kelamin = 'Laki-laki') AND (pelayanan.id_pelayanan is not null)) as terlayani_laki, ($sqlWherePel AND (korban.jenis_kelamin = 'Perempuan') AND (pelayanan.id_pelayanan is not null)) as terlayani_perempuan, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";

                $hasil[$kecamatan] = DB::select($sql);
            }
        } else {
            $sqlWhere = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus ". 
                        (count($where) > 0 ? ' where ' : '').
                        implode(' and ', $where).
                        (count($where) > 0 ? ' and ' : '').
                        ( (count($where) == 0 && $kecamatan != null) ? ' where ' : '').
                        ($kecamatan != null ? " kasus.fk_id_district = '$kecamatan' " : '');
            $sqlWherePel = "SELECT COUNT(*) FROM kasus right JOIN korban on kasus.id_kasus = korban.fk_id_kasus left JOIN pelayanan on korban.id_korban = pelayanan.fk_id_korban ". 
                    (count($where) > 0 ? ' where ' : '').
                    implode(' and ', $where).
                    (count($where) > 0 ? ' AND ' : '').
                    ( (count($where) == 0 && $kecamatan != '') ? ' where ' : '').
                    ($kecamatan != '' ? " kasus.fk_id_district = '$kecamatan' " : '');

                 $sql = "SELECT ($sqlWhere AND (korban.jenis_kelamin = 'Laki-laki')) as jenis_laki, ($sqlWhere AND (korban.jenis_kelamin = 'Perempuan')) as jenis_perempuan, ($sqlWherePel AND (korban.jenis_kelamin = 'Laki-laki') AND (pelayanan.id_pelayanan is not null)) as terlayani_laki, ($sqlWherePel AND (korban.jenis_kelamin = 'Perempuan') AND (pelayanan.id_pelayanan is not null)) as terlayani_perempuan, ($sqlWhere AND kasus.fk_id_district = '$kecamatan') as totalKasus ";
            
            $hasil[$kecamatan] = DB::select($sql);
        }
        return $hasil;




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