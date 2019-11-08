@include('header')

<body>
    <div class="container">
        <br>
            @if(session('notification'))
            <div class="alert alert-success alert-dismisable">
                <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                <strong>{{ session('notification') }}</strong>
            </div>            
            <br>            
            @endif
        <div class="card card-default">
            
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Data Kasus</div>
            </div>
            @php
                $kasus = $kasus[0];
            @endphp
            <div class="card-body">
                <form action='{{ url("/kasus/edit/$kasus->id_kasus") }}' method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputRegistrasi" name="no_registrasi"
                                value="{{ $kasus->nomor_registrasi }}">
                            @if ($errors->has('no_registrasi'))
                            <span style="color: red">{{ $errors->first('no_registrasi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRegist" name="hari"
                                value="{{ $kasus->hari }}">
                            @if ($errors->has('hari'))
                            <span style="color: red">{{ $errors->first('hari') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKonselor" class="col-sm-2 col-form-label">Konselor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKonselor" name="konselor"
                                value="{{ $kasus->konselor }}">
                            @if ($errors->has('konselor'))
                            <span style="color: red">{{ $errors->first('konselor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5"
                                name="deskripsi">{{ $kasus->deskripsi }}</textarea>
                            @if ($errors->has('deskripsi'))
                            <span style="color: red">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button class="btn btn-primary" type="submit">Update Data</button>
                            <input type="hidden" name="id_kasus" value="{{ $kasus->id_kasus }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="card card-default">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Data Korban</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Usia</th>
                            <th>Jenis kelamin</th>
                            <th>Tindak Kekerasan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $indexKorban = 1;
                        for ($i = 0; $i < count($korban); $i++) {
                            $id_kasus = $korban[$i]->id_kasus;
                            $id_korban = $korban[$i]->id_korban;
                        ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    <a href='{{ url("kasus/edit/$id_kasus/korban/$id_korban") }}'
                                        >{{ $korban[$i]->nama }}</a>
                                <td>{{ $korban[$i]->alamat }}</td>
                                <td>{{ $korban[$i]->usia }}</td>
                                <td>{{ $korban[$i]->jenis_kelamin }}</td>
                                <td>{{ $korban[$i]->hubungan_dengan_korban }}</td>
                                <td>
                                    <a href='{{ url("kasus/edit/$id_kasus/korban/$id_korban/pelayanan/new") }}'
                                        class="btn btn-info btn-sm">Layanan</a>
                                    <a href='{{ url("kasus/edit/$id_kasus/korban/$id_korban/rujukan/new") }}'
                                        class="btn btn-secondary btn-sm">Rujukan</a>
                                </td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td></td>
                                <td>Instansi</td>
                                <td>Pelayanan</td>
                                <td>Detail Pelayanan</td>
                                <td>Deskripsi Pelayanan</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php 
                              for ($j = $i; $j < count($korban); $j++) {  
                                if($korban[$i]->id_korban == $korban[$j]->id_korban){
                            ?>
                                <tr>
                                    <td></td>
                                    <td>{{ $korban[$j]->instansi }}</td>
                                    <td>{{ $korban[$j]->pelayanan }}</td>
                                    <td>{{ $korban[$j]->detail_pelayanan }}</td>
                                    <td>{{ $korban[$j]->deskripsi_pelayanan }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php }  else {
                                if($j - 1 < 0)
                                    $i = 0;
                                else
                                    $i = $j - 1;
                                break;
                            }
                                if($j == count($korban) - 1)
                                    $i = $j;
                               } 
                            ?>
                        <?php } ?>
                    </tbody>
                </table>                
                <br>
                <div class="col-sm">
                    <a href='{{ url("kasus/edit/$kasus->id_kasus/korban/new") }}' class="btn btn-primary">Tambah
                        Data</a>
                </div>
            </div>
        </div>
        <br>
        <div class="card card-default">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Data Pelaku</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Usia</th>
                            <th>Jenis kelamin</th>
                            <th>Hubungan Dengan Korban</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($pelaku as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href='{{ url("kasus/edit/$kasus->id_kasus/pelaku/$data->id_pelaku") }}'
                                        >{{ $data->nama }}</a>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->usia }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->hubungan_dengan_korban }}</td>
                                <td>
                                    <a href='{{ url("kasus/edit/$kasus->id_kasus/pelaku/$data->id_pelaku/penanganan/new") }}'
                                        class="btn btn-info btn-sm">Penanganan</a>
                                </td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td></td>
                                <td>Instansi</td>
                                <td>Pelayanan</td>
                                <td>Detail Pelayanan</td>
                                <td>Deskripsi Pelayanan</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Instansi</td>
                                <td>Pelayanan</td>
                                <td>Detail Pelayanan</td>
                                <td>Deskripsi Pelayanan</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm">
                    <a href='{{ url("kasus/edit/$kasus->id_kasus/pelaku/new") }}' class="btn btn-secondary">Tambah
                        Data</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
