<?php

            // $this->validate($req, [
            //     "nama_korban.*"          => "required|between:0,255",
            //     "jenis_kelamin_korban.*" => "required|between:0,20",
            //     "usia_korban.*"          => "required|numeric|min:0|digits_between:0,9",
            //     "ttl_korban.*"           => "required|between:0,100",
            //     "alamat_korban.*"        => "required|between:0,255",
            //     "telepon_korban.*"       => "required|numeric|digits_between:0,12",
            //     "pendidikan_korban.*"    => "required|between:0,20",
            //     "agama_korban.*"         => "required|between:0,20",
            //     "pekerjaan_korban.*"     => "required|between:0,30",
            //     "status_korban.*"        => "required|between:0,30",
            //     "difabel_korban.*"       => "required|between:0,10",
            //     "kdrt_korban.*"          => "required|between:0,10",
                // "tindak_kekerasan_korban[$i]" => "required|between:0,100",
                // "trafficking_korban[$i]"   => "required|between:0,100"
            // ]);

 // $this->validate($req, [
        //     'no_registrasi'   => 'required',
        //     'nik'   => 'required|numeric|digits:16',         
        //     'kejadian'   => 'required|date',
        //     'kategori'   => 'required|between:0,50',
        //     'TKP'        => 'required',
        //     'kecamatan' => 'required|between:0,50',
        //     'kelurahan' => 'required|between:0,50',
        //     'deskripsi'   => 'required',

        //     'nama_pelapor'          => 'required|between:0,255',
        //     'jenis_kelamin_pelapor' => 'required|between:0,20',
        //     'ttl_pelapor'           => 'required|between:0,50',
        //     'usia_pelapor'          => 'required|numeric|min:0|digits_between:0,9',
        //     'alamat_pelapor'        => 'required|between:0,255',
        //     'telepon_pelapor'       => 'required|numeric|digits_between:0,12',
        //     'pendidikan_pelapor'    => 'required|between:0,20',
        //     'agama_pelapor'         => 'required|between:0,20',
        //     'pekerjaan_pelapor'     => 'required|between:0,50',
        //     'status_pelapor'        => 'required|between:0,25',

        //     'nama_korban'          => 'required|between:0,255',
        //     'jenis_kelamin_korban' => 'required|between:0,20',
        //     'usia_korban'          => 'required|numeric|min:0|digits_between:0,9',
        //     'ttl_korban'           => 'required|between:0,100',
        //     'alamat_korban'        => 'required|between:0,255',
        //     'telepon_korban'       => 'required|numeric|digits_between:0,12',
        //     'pendidikan_korban'    => 'required|between:0,20',
        //     'agama_korban'         => 'required|between:0,20',
        //     'pekerjaan_korban'     => 'required|between:0,30',
        //     'status_korban'        => 'required|between:0,30',
        //     'difabel_korban'       => 'required|between:0,10',
        //     'kdrt_korban'          => 'required|between:0,10',
        //     'tindak_kekerasan_korban' => 'required|between:0,100',
        //     'trafficking_korban'   => 'required|between:0,100',

        //     'nama_pelaku'          => 'required|between:0,255',
        //     'jenis_kelamin_pelaku' => 'required|between:0,20',
        //     'usia_pelaku'          => 'required|numeric|min:0|digits_between:0,9',
        //     'ttl_pelaku'           => 'required|between:0,100',
        //     'alamat_pelaku'        => 'required|between:0,255',
        //     'telepon_pelaku'       => 'required|numeric|digits_between:0,12',
        //     'pendidikan_pelaku'    => 'required|between:0,20',
        //     'agama_pelaku'         => 'required|between:0,20',
        //     'pekerjaan_pelaku'     => 'required|between:0,30',
        //     'status_pelaku'        => 'required|between:0,30',
        //     'difabel_pelaku'       => 'required|between:0,10',
        //     'hubungan_dengan_korban' => 'required|between:0,90'
        // ], [
        //     'required'       => 'Kolom :attribute harus berisi nilai',
        //     'numeric'        => 'Kolom :attribute harus berupa angka',
        //     'min'            => 'Kolom :attribute minimal :min',
        //     'digits_between' => 'Kolom :attribute maksimal :max digit',
        //     'digits'         => 'Pastikan NIK benar sesuai format',
        //     'between'        => 'Kolom :attribute maksimal :max karakter',
        //     'date'           => 'Pastikan format tanggal benar',
        //     // 'digits_between' => 'Pastikan NIK benar',
        // ]);

        // dd($req->nama_korban[0]);



    public function pelaporTambahKasus(Request $req){
        // dd($req);
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
        for ($i = 1; $i < count($req->nama_korban); $i++) { 
            $rules["jenis_kelamin_korban$i"] = 'required';
            $rules["difabel_korban$i"] = 'required';
            $rules["kdrt_korban$i"] = 'required';
            $rules["tindak_kekerasan_korban.".$i.'.0'] = 'required';
        }
        for ($i = 1; $i < count($req->nama_pelaku); $i++) { 
            $rules["jenis_kelamin_pelaku$i"] = 'required';
            $rules["difabel_pelaku$i"] = 'required';
        }

        // dd($rules);

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
        dd($req->tindak_kekerasan_korban);
       
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
            $trafficking = implode(",",  $req->trafficking_korban);

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
                'kategori_trafficking'   => $trafficking,
                'fk_id_kasus'   => $id_kasus
            ];
            if($i == 0){
                $dataKorban['jenis_kelamin'] = $req->jenis_kelamin_korban;
                $dataKorban['difabel']       = $req->difabel_korban;
                $dataKorban['kdrt']          = $req->kdrt_korban;
            } else {
                $keyJK = "jenis_kelamin_korban" . $i;
                $keyDifabel = "difabel_korban" . $i;
                $keyKdrt = "kdrt_korban" . $i;

                $dataKorban['kdrt']     = $req->$keyJK;
                $dataKorban['difabel']  = $req->$keyDifabel;
                $dataKorban['kdrt']     = $req->$keyKdrt;
            }

            $krbn = M_korban::create($dataKorban);
        }
        for ($i = 0; $i < count($req->tindak_kekerasan_korban); $i++) { 
            DB::table('kekerasan')->insert([
                'jenis_kekerasan' => $req->tindak_kekerasan_korban[$i],
                'fk_id_korban' => $krbn->id_korban,
                'fk_id_kasus' => $id_kasus
            ]);
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
                $keyJK = "jenis_kelamin" . $i;
                $keyDifabel = "difabel_pelaku" . $i;

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
        // return back()->with('notification', 'Kasus berhasil ditambahkan');
        // return redirect()->back()->with('notification', 'Kasus berhasil ditambahkan');
    }



    