<div class="card text-white bg-warning mb-3">
    <div class="card-header">Data Kasus</div>
</div>
<div class="card-body">

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
            <label for="inputNik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" id="inputNik" name="nik"
                    value="{{ old('nik') }}">
                @if ($errors->has('nik'))
                <span style="color: red">{{ $errors->first('nik') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTglKejadian" class="col-sm-2 col-form-label">Tanggal Kejadian</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="inputTglKejadian" name="kejadian"
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
                    <option value="Rumah Tangga" <?= ('Rumah Tangga' == old('kategori') ? 'selected' : ''); ?>>Rumah Tangga</option>
                    <option value="Tempat Kerja" <?= ('Tempat Kerja' == old('kategori') ? 'selected' : ''); ?>>Tempat Kerja</option>
                    <option value="Sekolah" <?= ('Sekolah' == old('kategori') ? 'selected' : ''); ?>>Sekolah</option>
                    <option value="Fasilitas Umum" <?= ('Fasilitas Umum' == old('kategori') ? 'selected' : ''); ?>>Fasilitas Umum</option>                                
                    <option value="Lainnya" <?= ('Lainnya' == old('kategori') ? 'selected' : ''); ?>>Lainnya</option>
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
                <select class="custom-select" id="inputKecamatanNew" name="kecamatan">
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
            <label class="col-sm-6 col-form-label"></label>
            <div class="col-sm-5">
                <a class="btn btn-success" id="btNextKasus">Next</a>
            </div>
        </div>
</div>
<script type="text/javascript">
    $('#btNextKasus').click(function() {
        if( $("input:empty").length == 0 ){

        }
        $('#pills-kasus').attr('class', 'tab-pane fade');
        $('#pills-pelapor').attr('class', 'tab-pane fade show active');
    });
</script>