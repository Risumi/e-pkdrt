@include('header')
<script type="text/javascript">
    // $(document).ready(function () {
    //     //untuk memanggil plugin select2        
    //     $('#inputKecamatan').select2({
    //         placeholder: 'Pilih Kecamatan',
    //         language: "id"
    //     });
    //     $('#inputKelurahan').select2({
    //         placeholder: 'Pilih Kelurahan',
    //         language: "id"
    //     });    
    // });
    $("#inputKecamatan").change(getAjaxKecamatan);
    function getAjaxKecamatan() 
    {        
        var id_district = $("#inputKecamatan").val();
        console.log(id_district);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "data-wilayah.php?jenis=kelurahan",
            data: "id_district=" + id_district,
            success: function (msg) {
                $("select#kelurahan").html(msg);
                $("img#load3").hide();
            }
        });
    }

</script>

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
                            <input type="text" class="form-control" id="inputRegistrasi" name="no_registrasi"
                                value="{{ old('no_registrasi') }}">
                            @if ($errors->has('no_registrasi'))
                            <span style="color: red">{{ $errors->first('no_registrasi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Hari/Tanggal</label>
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
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
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
