<div class="card text-white bg-warning mb-3">
    <div class="card-header">Data Kasus</div>
</div>
<div class="card-body">

        <div class="form-group row">
            <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
            <div class="col-sm-5">
                <input type="text" class="form-control {{ $errors->has('no_registrasi')? 'is-invalid':'' }}" id="inputRegistrasi" name="no_registrasi"
                    value="{{ $noRegist }}" readonly>
                @if ($errors->has('no_registrasi'))
                    <div class="invalid-feedback">{{ $errors->first('no_registrasi') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-5">
                <input type="number" class="form-control {{ $errors->has('nik')? 'is-invalid':'' }}" id="inputNik" name="nik"
                    value="{{ old('nik') }}">
                @if ($errors->has('nik'))
                    <div class="invalid-feedback">{{ $errors->first('nik') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTglKejadian" class="col-sm-2 col-form-label">Tanggal Kejadian</label>
            <div class="col-sm-5">
                <input type="date" class="form-control {{ $errors->has('kejadian')? 'is-invalid':'' }}" id="inputTglKejadian" name="kejadian"
                    value="{{ old('kejadian') }}">
                @if ($errors->has('kejadian'))
                    <div class="invalid-feedback">{{ $errors->first('kejadian') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control {{ $errors->has('deskripsi')? 'is-invalid':'' }}" id="inputDeskripsi" rows="5" name="deskripsi">{{ old('deskripsi') }}</textarea>
                @if ($errors->has('deskripsi'))
                    <div class="invalid-feedback">{{ $errors->first('deskripsi') }}</div>
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
                <textarea type="text" class="form-control {{ $errors->has('TKP')? 'is-invalid':'' }}" id="inputTKP" rows="5"
                    name="TKP">{{ old('TKP') }}</textarea>
                @if ($errors->has('TKP'))
                    <div class="invalid-feedback">{{ $errors->first('TKP') }}</div>
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
        <div class="form-group row" id="kelurahan">
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