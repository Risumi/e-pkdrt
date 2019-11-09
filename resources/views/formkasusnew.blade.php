@include('header')    
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
                    <div class="form-group row">
                        <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputRegistrasi" name="no_registrasi" value="{{ old('no_registrasi') }}">
                            @if ($errors->has('no_registrasi'))
                                <span style="color: red">{{ $errors->first('no_registrasi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRegist" name="hari" value="{{ old('hari') }}">
                            @if ($errors->has('hari'))
                                <span style="color: red">{{ $errors->first('hari') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKonselor" class="col-sm-2 col-form-label">Konselor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKonselor" name="konselor" value="{{ old('konselor') }}">
                            @if ($errors->has('konselor'))
                                <span style="color: red">{{ $errors->first('konselor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            @if ($errors->has('deskripsi'))
                                <span style="color: red">{{ $errors->first('deskripsi') }}</span>
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
