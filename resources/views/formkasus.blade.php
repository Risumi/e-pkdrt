@include('header')
<script src="{{ asset('kecamatan.js') }}"></script>
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
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group row">
                        <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputRegistrasi" name="no_registrasi"
                                value="{{ $kasus->nomor_registrasi }}" readonly>
                            @if ($errors->has('no_registrasi'))
                            <span style="color: red">{{ $errors->first('no_registrasi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="inputTglRegist" name="hari"
                                value="{{ $kasus->hari }}">
                            @if ($errors->has('hari'))
                            <span style="color: red">{{ 'Kolom tanggal pelaporan harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglKejadian" class="col-sm-2 col-form-label">Tanggal Kejadian</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="inputTglKejadian" name="kejadian"
                                value="{{ $kasus->kejadian }}">
                            @if ($errors->has('kejadian'))
                            <span style="color: red">{{ 'Kolom tanggal kejadian harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5"
                                name="deskripsi">{{ $kasus->deskripsi }}</textarea>
                            @if ($errors->has('deskripsi'))
                            <span style="color: red">{{ 'Kolom deskripsi harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKategori" class="col-sm-2 col-form-label">Kategori Lokasi Kasus</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputKategori" name="kategori">
                                <option value="Rumah Tangga" {{("Rumah Tangga" == $kasus->kategori) ? 'selected' : '' }}>Rumah Tangga</option>
                                <option value="Tempat Kerja" {{("Tempat Kerja" == $kasus->kategori) ? 'selected' : '' }}>Tempat Kerja</option>
                                <option value="Sekolah" {{("Sekolah" == $kasus->kategori) ? 'selected' : '' }}>Sekolah</option>
                                <option value="Fasilitas Umum" {{("Fasilitas Umum" == $kasus->kategori) ? 'selected' : '' }}>Fasilitas Umum</option> 
                                <option value="Lainnya" {{("Lainnya" == $kasus->kategori) ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @if ($errors->has('kategori'))
                            <span style="color: red">{{ 'Kolom kategori lokasi harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTKP" class="col-sm-2 col-form-label">Alamat TKP</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputTKP" rows="5"
                                name="TKP">{{ $kasus->alamat_tkp }}</textarea>
                            @if ($errors->has('TKP'))
                            <span style="color: red" >{{ 'Kolom TKP harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputKecamatan" name="kecamatan">
                            @foreach($kecamatan as $data)
                                <option value="{{$data->name}}" {{($data->name == $kasus->fk_id_district) ? 'selected' : '' }}>{{$data->name}}</option>
                            @endforeach                                                                
                            </select>
                            @if ($errors->has('kecamatan'))
                            <span style="color: red">{{ 'Kolom kecamatan harus berisi nilai' }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputKelurahan" name="kelurahan">
                                <option value=></option>                                 
                            </select>
                            @if ($errors->has('kelurahan'))
                            <span style="color: red">{{ 'Kolom kelurahan harus berisi nilai' }}</span>
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
                        @foreach($korban as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href='' data-toggle="modal" data-target="#modalEditKorban{{$data->id_korban}}" 
                                        id="btnModalEditKorban{{$data->id_korban}}">{{ $data->nama }}</a>                                        
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->usia }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->tindak_kekerasan }}</td>
                                <td>
                                    <a href='' data-toggle="modal" data-target="#modalPelayanan{{$data->id_korban}}"
                                        class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    <a href='' data-toggle="modal" data-target="#modalRujukan{{$data->id_korban}}"
                                        class="btn btn-secondary btn-sm"><i class="fa fa-share-alt" aria-hidden="true"></i></i></a>
                                </td>
                            </tr>
                            @foreach($rujukan as $dataRujukan)
                                @if(count($rujukan)!=0 && $dataRujukan->fk_id_korban == $data->id_korban&&$loop->iteration==1)
                                <tr style="font-weight: bold">
                                    <td></td>
                                    <td>Tanggal Rujukan</td>
                                    <td>Kota</td>
                                    <td>Instansi</td>
                                    <td>Deskripsi Rujukan</td>                                
                                </tr>
                                @endif
                                @if($dataRujukan->fk_id_korban == $data->id_korban)
                                <tr>                            
                                    <td></td>
                                    <td>{{$dataRujukan->tanggal_rujukan}}</td>
                                    <td>{{$dataRujukan->kota}}</td>
                                    <td>{{$dataRujukan->instansi}}</td>
                                    <td>{{$dataRujukan->deskripsi_rujukan}}</td>                                    
                                </tr>
                                @endif
                            @endforeach                                                        
                            @foreach($pelayanan as $dataPelayanan)
                                @if(count($pelayanan)!=0 && $dataPelayanan->fk_id_korban == $data->id_korban)
                                    @if(count($pelayanan)!=0)
                                        <tr style="font-weight: bold">
                                            <td></td>
                                            <td>Instansi</td>
                                            <td>Pelayanan</td>
                                            <td>Detail Pelayanan</td>
                                            <td>Deskripsi Pelayanan</td>                                
                                        </tr>
                                    @endif
                                @endif
                                @if($dataPelayanan->fk_id_korban == $data->id_korban)
                                <tr>                            
                                    <td></td>
                                    <td>{{$dataPelayanan->instansi}}</td>
                                    <td>{{$dataPelayanan->pelayanan}}</td>
                                    <td>{{$dataPelayanan->detail_pelayanan}}</td>
                                    <td>{{$dataPelayanan->deskripsi_pelayanan}}</td>                                    
                                </tr>
                                @endif
                            @endforeach                   
                        @include('modal.modalEditKorban')
                        @include('modal.modalPelayanan')
                        @include('modal.modalRujukan')
                        @endforeach                                                                   
                        <?php
                            function cekComboBox($array, $value) {
                                for ($i = 0; $i < count($array); $i++) { 
                                    if($array[$i] == $value)
                                        return "checked";
                                }
                                return "";
                            }
                        ?>
                    </tbody>
                </table>                
                <br>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKorban" id="btnModalTambahKorban">
                      Tambah Data
                    </button>
                    <!-- <a href='{{ url("kasus/edit/$kasus->id_kasus/korban/new") }}' class="btn btn-primary">Tambah
                        Data</a> -->
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
                                    <a href="" data-toggle="modal" data-target="#modalEditPelaku{{$data->id_pelaku}}"
                                        id="btnModalEditPelaku{{$data->id_pelaku}}">{{ $data->nama }}</a>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->usia }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->hubungan_dengan_korban }}</td>
                                <td>
                                    <a href='' data-toggle="modal" data-target="#modalPenanganan{{$data->id_pelaku}}" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
</a>
                                </td>
                            </tr>                            
                            @foreach($penanganan as $dataPenanganan)
                                @if(count($penanganan)!=0 && $dataPenanganan->fk_id_pelaku == $data->id_pelaku&&$loop->iteration==1)
                                <tr style="font-weight: bold">
                                    <td></td>
                                    <td>Instansi</td>
                                    <td>Proses Penanganan</td>
                                    <td>Deskripsi Proses</td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                </tr>
                                @endif
                                @if($dataPenanganan->fk_id_pelaku == $data->id_pelaku)
                                <tr>                            
                                    <td></td>
                                    <td>{{$dataPenanganan->instansi}}</td>
                                    <td>{{$dataPenanganan->jenis_proses}}</td>
                                    <td>{{$dataPenanganan->deskripsi_proses}}</td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                </tr>
                                @endif
                            @endforeach
                            @include('modal.modalEditPelaku')
                            @include('modal.modalPenanganan')
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm">
                    <!-- <a href='{{ url("kasus/edit/$kasus->id_kasus/pelaku/new") }}' class="btn btn-secondary">Tambah
                        Data</a> -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalTambahPelaku" id="btnModalTambahPelaku">
                      Tambah Data
                    </button>    
                </div>
            </div>
        </div>
    </div>
@include('modal.modalTambahKorban')
@include('modal.modalTambahPelaku')
<script type="text/javascript">
    // if ({{ $errors->count() }} > 0){
    //     $('#btnModalTambahKorban').click();
    // }
    $("{{ old('modal') }}").click();
</script>
</body>
</html>