<div class="card-header">Pelaku
     @if(session('totPelaku') === null)
    <a class="float-right" id="addPelaku" title="Tambah Pelaku">+</a>
    @endif
</div>
<div>
<span id="formTabPelakuMain">
    <div class="card-body" id="formTabPelaku">
    <h3>Pelaku ke-<span id="counterPelaku">1</span></h3>
        <div class="form-group row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control {{ $errors->has('nama_pelaku.0')? 'is-invalid':'' }}" id="inputNama" name="nama_pelaku[]" value="{{ old('nama_pelaku.0') }}">
                @if ($errors->has('nama_pelaku.0'))
                    <div class="invalid-feedback">{{ $errors->first('nama_pelaku.0') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin_pelaku" id="RadioJKL"
                        value="Laki-laki" <?= ('Laki-laki' == old('jenis_kelamin_pelaku') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioJKL">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin_pelaku" id="RadioJKLP"
                        value="Perempuan" <?= ('Perempuan' == old('jenis_kelamin_pelaku') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioJKP">Perempuan</label>
                </div>
                @if ($errors->has('jenis_kelamin_pelaku'))
                    <span style="color: red">{{ $errors->first('jenis_kelamin_pelaku') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-sm-2">
                <input type="text" class="form-control {{ $errors->has('usia_pelaku.0')? 'is-invalid':'' }}" id="inputUsia" name="usia_pelaku[]" min="0" value="{{ old('usia_pelaku.0') }}">
                @if ($errors->has('usia_pelaku.0'))
                    <div class="invalid-feedback">{{ $errors->first('usia_pelaku.0') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="text" class="form-control {{ $errors->has('ttl_pelaku.0')? 'is-invalid':'' }}" id="inputTTL" name="ttl_pelaku[]" value="{{ old('ttl_pelaku.0') }}">
                @if ($errors->has('ttl_pelaku.0'))
                    <div class="invalid-feedback">{{ $errors->first('ttl_pelaku.0') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control {{ $errors->has('alamat_pelaku.0')? 'is-invalid':'' }}" id="inputAlamat" name="alamat_pelaku[]" rows="3">{{ old('alamat_pelaku.0') }}</textarea>
                @if ($errors->has('alamat_pelaku.0'))
                    <div class="invalid-feedback">{{ $errors->first('alamat_pelaku.0') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
            <div class="col-sm-5">
                <input type="number" class="form-control {{ $errors->has('telepon_pelaku.0')? 'is-invalid':'' }}" id="inputNO" name="telepon_pelaku[]" value="{{ old('telepon_pelaku.0') }}">
                @if ($errors->has('telepon_pelaku.0'))
                    <div class="invalid-feedback">{{ $errors->first('telepon_pelaku.0') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputPendidikan" name="pendidikan_pelaku[]">
                    <option value="TK" <?= ('TK' == old('pendidikan_pelaku.0') ? 'selected' : ''); ?>>TK</option>
                    <option value="SD" <?= ('SD' == old('pendidikan_pelaku.0') ? 'selected' : ''); ?>>SD</option>
                    <option value="SMP" <?= ('SMP' == old('pendidikan_pelaku.0') ? 'selected' : ''); ?>>SMP</option>
                    <option value="SMA" <?= ('SMA' == old('pendidikan_pelaku.0') ? 'selected' : ''); ?>>SMA</option>
                    <option value="S1/S2/S3" <?= ('S1/S2/S3' == old('pendidikan_pelaku.0') ? 'selected' : ''); ?>>S1/S2/S3</option>
                </select>
                @if ($errors->has('pendidikan_pelaku.0'))
                    <span style="color: red">{{ $errors->first('pendidikan_pelaku.0') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputAgama" name="agama_pelaku[]">
                    <option value="Islam" <?= ('Islam' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Islam</option>
                    <option value="Kristen" <?= ('Kristen' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Kristen</option>
                    <option value="Katolik" <?= ('Katolik' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Katolik</option>
                    <option value="Budha" <?= ('Budha' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Budha</option>
                    <option value="Hindu" <?= ('Hindu' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Hindu</option>
                    <option value="Konghucu" <?= ('Konghucu' == old('agama_pelaku.0') ? 'selected' : ''); ?>>Konghucu</option>
                </select>
                @if ($errors->has('agama_pelaku.0'))
                    <span style="color: red">{{ $errors->first('agama_pelaku.0') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputPekerjaan" name="pekerjaan_pelaku[]">
                    <option value="Pedagang/Tani/Nelayan" <?= ('Pedagang/Tani/Nelayan' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>Pedagang/Tani/Nelayan</option>
                    <option value="Swasta/Buruh" <?= ('Swasta/Buruh' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>Swasta/Buruh</option>
                    <option value="PNS/TNI/Polri" <?= ('PNS/TNI/Polri' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>PNS/TNI/Polri</option>
                    <option value="Pelajar" <?= ('Pelajar' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>Pelajar</option>
                    <option value="Ibu Rumah Tangga" <?= ('Ibu Rumah Tangga' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>Ibu Rumah Tangga</option>
                    <option value="Tidak Bekerja" <?= ('Tidak Bekerja' == old('pekerjaan_pelaku.0') ? 'selected' : ''); ?>>Tidak Bekerja</option>
                </select>
                @if ($errors->has('pekerjaan_pelaku.0'))
                    <span style="color: red">{{ $errors->first('pekerjaan_pelaku.0') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-5">
                <select class="custom-select" id="inputStatus" name="status_pelaku[]">
                    <option value="Belum Menikah" <?= ('Belum Menikah' == old('status_pelaku.0') ? 'selected' : ''); ?>>Belum Menikah</option>
                    <option value="Menikah" <?= ('Menikah' == old('status_pelaku.0') ? 'selected' : ''); ?>>Menikah</option>
                    <option value="Duda/Janda" <?= ('Duda/Janda' == old('status_pelaku.0') ? 'selected' : ''); ?>>Duda/Janda</option>
                    <option value="Sirri" <?= ('Sirri' == old('status_pelaku.0') ? 'selected' : ''); ?>>Sirri</option>
                </select>
                @if ($errors->has('status_pelaku.0'))
                    <span style="color: red">{{ $errors->first('status_pelaku.0') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
            <div class="col-sm-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="difabel_pelaku" id="RadioDifabelY"
                        value="Ya" <?= ('Ya' == old('difabel_pelaku') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioDifabelY">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="difabel_pelaku" id="RadioDifabelT"
                        value="Tidak" <?= ('Tidak' == old('difabel_pelaku') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="RadioDifabelT">Tidak</label>
                </div>
                @if ($errors->has('difabel_pelaku'))
                    <span style="color: red">{{ $errors->first('difabel_pelaku') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputHubungan" class="col-sm-2 col-form-label">Hubungan Dengan Korban</label>
            <div class="input-group col-sm-5">
                <select class="custom-select" id="inputHubungan" name="hubungan_dengan_korban[]">
                    <option value="Orang Tua" <?= ('Orang Tua' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Orang Tua</option>
                    <option value="Keluarga/Saudara" <?= ('Keluarga/Saudara' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Keluarga/Saudara</option>
                    <option value="Suami/Istri" <?= ('Suami/Istri' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Suami/Istri</option>
                    <option value="Tetangga" <?= ('Tetangga' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Tetangga</option>
                    <option value="Pacar/Teman" <?= ('Pacar/Teman' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Pacar/Teman</option>
                    <option value="Guru" <?= ('Guru' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Guru</option>
                    <option value="Majikan" <?= ('Majikan' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Majikan</option>
                    <option value="Rekan Kerja" <?= ('Rekan Kerja' == old('hubungan_dengan_korban.0') ? 'selected' : ''); ?>>Rekan Kerja</option>
                </select>
                @if ($errors->has('hubungan_dengan_korban.0'))
                    <span style="color: red">{{ $errors->first('hubungan_dengan_korban.0') }}</span>
                @endif
            </div>
        </div>
        <?php
            for ($y = 1; $y < session('totPelaku'); $y++) { ?>
                @include('lapor/formPelaku')
        <?php
            }
        ?>
    </div>
</span>
    <div class="form-group row">
        <div class="col-sm-2 text-left">
            <a class="btn btn-warning" id="btBackPelaku">Back</a>
        </div>
        <div class="col-sm-3 ">
            <button class="btn btn-primary float-right">Tambah Data</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#btBackPelaku').click(function() {
            $('#pills-pelaku').attr('class', 'tab-pane fade');
            $('#pills-korban').attr('class', 'tab-pane fade show active');
        });

        counterPelaku = 1;
        $('#addPelaku').click(function() {
            var $clone = $( "#formTabPelaku" ).clone().appendTo( "#formTabPelakuMain" );
            $clone.find("input[type='radio']").each(function(){
                this.name += counterPelaku;
            });
            $clone.find('[id]').each(function(){
                this.id += counterPelaku;
            });
            $('#counterPelaku'+counterPelaku).html(counterPelaku+1);

            counterPelaku++;
        })
    });
</script>
