<div class="card-header">Pelapor</div>
<div class="card-body">

        <div class="form-group row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputNama" name="nama_pelapor" value="{{ old('nama_pelapor') }}">
                @if ($errors->has('nama_pelapor'))
                    <span style="color: red">{{ 'Kolom nama harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin_pelapor" id="RadioJKL"
                        value="Laki-laki" <?= ('Laki-laki' == old('jenis_kelamin_pelapor') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioJKL">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin_pelapor" id="RadioJKLP"
                        value="Perempuan"  <?= ('Perempuan' == old('jenis_kelamin_pelapor') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioJKP">Perempuan</label>
                </div>
                @if ($errors->has('jenis_kelamin_pelapor'))
                    <span style="color: red">{{ 'Kolom jenis kelamin harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="inputUsia" name="usia_pelapor" min="0" value="{{ old('usia_pelapor') }}">
                @if ($errors->has('usia_pelapor'))
                    <span style="color: red">{{ 'Kolom usia pelapor harus berisi nilai minimal 0' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputTTL" name="ttl_pelapor" value="{{ old('ttl_pelapor') }}">
                @if ($errors->has('ttl_pelapor'))
                    <span style="color: red">{{ 'Kolom TTL harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" id="inputAlamat" rows="3" name="alamat_pelapor">{{ old('alamat_pelapor') }}</textarea>
                @if ($errors->has('alamat_pelapor'))
                    <span style="color: red">{{ 'Kolom alamat harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" id="inputNO" name="telepon_pelapor" value="{{ old('telepon_pelapor') }}">
                @if ($errors->has('telepon_pelapor'))
                    <span style="color: red">{{ 'Kolom No. Telp/HP harus berisi angka maksimal 12 digit' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputPendidikan" name="pendidikan_pelapor">
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1/S2/S3">S1/S2/S3</option>
                </select>
                @if ($errors->has('pendidikan_pelapor'))
                    <span style="color: red">{{ 'Kolom pendidikan harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputAgama" name="agama_pelapor">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
                @if ($errors->has('agama_pelapor'))
                    <span style="color: red">{{ 'Kolom agama harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputPekerjaan" name="pekerjaan_pelapor">
                    <option value="Pedagang/Tani/Nelayan">Pedagang/Tani/Nelayan</option>
                    <option value="Swasta/Buruh">Swasta/Buruh</option>
                    <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                    <option value="Pelajar">Pelajar</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                </select>
                @if ($errors->has('pekerjaan_pelapor'))
                    <span style="color: red">{{ 'Kolom pekerjaan harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-5">
                <select class="custom-select" id="inputStatus" name="status_pelapor">
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Duda/Janda">Duda/Janda</option>
                    <option value="Sirri">Sirri</option>
                </select>
                @if ($errors->has('status_pelapor'))
                    <span style="color: red">{{ 'Kolom status harus berisi nilai' }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <a class="btn btn-warning" id="btBackPelapor">Back</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success" id="btNextPelapor">Next</a>
            </div>
        </div>
</div>

<script type="text/javascript">
    $('#btNextPelapor').click(function() {
        $('#pills-pelapor').attr('class', 'tab-pane fade');
        $('#pills-korban').attr('class', 'tab-pane fade show active');
    });
    $('#btBackPelapor').click(function() {
        $('#pills-pelapor').attr('class', 'tab-pane fade');
        $('#pills-kasus').attr('class', 'tab-pane fade show active');
    });
</script>