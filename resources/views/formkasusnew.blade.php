@include('header')
<script src="{{ asset('kecamatan.js') }}"></script>
<body>

    <div class="container">
        <br>
        <div class="card card-default">
            @if(session('notification'))
            <div class="alert alert-success alert-dismisable">
                <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                <strong>{{ session('notification') }}</strong>
            </div>
            @endif
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Data Kasus</div>
            </div>
            <div class="card-body">
                <form action="{{ url('/kasus/new') }}" method="post">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group row">
                        <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputRegistrasi" name="no_registrasi"
                            value="{{ $noRegist }}" readonly>
                            @if ($errors->has('no_registrasi'))
                            <span style="color: red">{{ $errors->first('no_registrasi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Tanggal Pelaporan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRegist" name="hari"
                                value="{{ old('hari') }}">
                            @if ($errors->has('hari'))
                            <span style="color: red">{{ $errors->first('hari') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKonselor" class="col-sm-2 col-form-label">Konselor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKonselor" name="konselor"
                                value="{{ old('konselor') }}">
                            @if ($errors->has('konselor'))
                            <span style="color: red">{{ $errors->first('konselor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglKejadian" class="col-sm-2 col-form-label">Tanggal Kejadian</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglKejadian" name="kejadian"
                                value="{{ old('kejadian') }}">
                            @if ($errors->has('kejadian'))
                            <span style="color: red">{{ $errors->first('kejadian') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5"
                                name="deskripsi">{{ old('deskripsi') }}</textarea>
                            @if ($errors->has('deskripsi'))
                            <span style="color: red">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKategori" class="col-sm-2 col-form-label">Kategori Lokasi Kasus</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputKategori" name="kategori">
                                <option value="Rumah Tangga">Rumah Tangga</option>
                                <option value="Tempat Kerja">Tempat Kerja</option>
                                <option value="Sekolah">Sekolah</option>
                                <option value="Fasilitas Umum">Fasilitas Umum</option>                                
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @if ($errors->has('kategori'))
                            <span style="color: red">{{ $errors->first('kategori') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTKP" class="col-sm-2 col-form-label">Alamat TKP</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputTKP" rows="5"
                                name="TKP">{{ old('TKP') }}</textarea>
                            @if ($errors->has('TKP'))
                            <span style="color: red">{{ $errors->first('TKP') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputKecamatan" name="kecamatan">
                                @foreach($kecamatan as $data)
                                <option value="{{$data->name}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kecamatan'))
                            <span style="color: red">{{ $errors->first('kecamatan') }}</span>
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
                            <span style="color: red">{{ $errors->first('kelurahan') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</body>


</html>
