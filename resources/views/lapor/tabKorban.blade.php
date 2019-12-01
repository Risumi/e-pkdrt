<div class="card-header">Korban
    @if(session('totKorban') === null)
        <a class="float-right" id="addKorban" title="Tambah Korban">+</a>
    @endif
</div>
<div>
<span id="formTabKorbanMain">
    
<div class="card-body" id="formTabKorban">
<h3>Korban ke-<span id="counterKorban">1</span></h3>
    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('nama_korban.0')? 'is-invalid':'' }}" id="inputNama" name="nama_korban[]" value="{{ old('nama_korban.0') }}">
            @if ($errors->has('nama_korban.0'))
                <div class="invalid-feedback">{{ $errors->first('nama_korban.0') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban" id="RadioJKL"
                    value="Laki-laki" <?= ('Laki-laki' == old('jenis_kelamin_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban" id="RadioJKLP"
                    value="Perempuan"  <?= ('Perempuan' == old('jenis_kelamin_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKP">Perempuan</label>
            </div>
            @if ($errors->has('jenis_kelamin_korban'))
                <span style="color: red">{{ $errors->first("jenis_kelamin_korban") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
        <div class="col-sm-2">
            <input type="text" class="form-control {{ $errors->has('usia_korban.0')? 'is-invalid':'' }}" id="inputUsia" name="usia_korban[]" min="0" value="{{ old('usia_korban.0') }}">
            @if ($errors->has('usia_korban.0'))
                <div class="invalid-feedback">{{ $errors->first('usia_korban.0') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('ttl_korban.0')? 'is-invalid':'' }}" id="inputTTL" name="ttl_korban[]" value="{{ old('ttl_korban.0') }}">
            @if ($errors->has('ttl_korban.0'))
                <div class="invalid-feedback">{{ $errors->first('ttl_korban.0') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-5">
            <textarea type="text" class="form-control {{ $errors->has('alamat_korban.0')? 'is-invalid':'' }}" id="inputAlamat" rows="3" name="alamat_korban[]">{{ old('alamat_korban.0') }}</textarea>
            @if ($errors->has('alamat_korban.0'))
                <div class="invalid-feedback">{{ $errors->first('alamat_korban.0') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
        <div class="col-sm-5">
            <input type="number" class="form-control {{ $errors->has('telepon_korban.0')? 'is-invalid':'' }}" id="inputNO" name="telepon_korban[]" value="{{ old('telepon_korban.0') }}">
            @if ($errors->has('telepon_korban.0'))
                <div class="invalid-feedback">{{ $errors->first('telepon_korban.0') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPendidikan" name="pendidikan_korban[]">
                <option value="TK" <?= ('TK' == old('pendidikan_korban.0') ? 'selected' : ''); ?>>TK</option>
                <option value="SD" <?= ('SD' == old('pendidikan_korban.0') ? 'selected' : ''); ?>>SD</option>
                <option value="SMP" <?= ('SMP' == old('pendidikan_korban.0') ? 'selected' : ''); ?>>SMP</option>
                <option value="SMA" <?= ('SMA' == old('pendidikan_korban.0') ? 'selected' : ''); ?>>SMA</option>
                <option value="S1/S2/S3" <?= ('S1/S2/S3' == old('pendidikan_korban.0') ? 'selected' : ''); ?>>S1/S2/S3</option>
            </select>
            @if ($errors->has('pendidikan_korban.0'))
                <span style="color: red">{{ $errors->first('pendidikan_korban.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputAgama" name="agama_korban[]">
                <option value="Islam" <?= ('Islam' == old('agama_korban.0') ? 'selected' : ''); ?>>Islam</option>
                <option value="Kristen" <?= ('Kristen' == old('agama_korban.0') ? 'selected' : ''); ?>>Kristen</option>
                <option value="Katolik" <?= ('Katolik' == old('agama_korban.0') ? 'selected' : ''); ?>>Katolik</option>
                <option value="Budha" <?= ('Budha' == old('agama_korban.0') ? 'selected' : ''); ?>>Budha</option>
                <option value="Hindu" <?= ('Hindu' == old('agama_korban.0') ? 'selected' : ''); ?>>Hindu</option>
                <option value="Konghucu" <?= ('Konghucu' == old('agama_korban.0') ? 'selected' : ''); ?>>Konghucu</option>
            </select>
            @if ($errors->has('agama_korban.0'))
                <span style="color: red">{{ $errors->first('agama_korban.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPekerjaan" name="pekerjaan_korban[]">
                <option value="Pedagang/Tani/Nelayan" <?= ('Guru' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>Pedagang/Tani/Nelayan</option>
                <option value="Swasta/Buruh" <?= ('Swasta/Buruh' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>Swasta/Buruh</option>
                <option value="PNS/TNI/Polri" <?= ('PNS/TNI/Polri' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>PNS/TNI/Polri</option>
                <option value="Pelajar" <?= ('Pelajar' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>Pelajar</option>
                <option value="Ibu Rumah Tangga" <?= ('Ibu Rumah Tangga' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>Ibu Rumah Tangga</option>
                <option value="Tidak Bekerja" <?= ('Tidak Bekerja' == old('pekerjaan_korban.0') ? 'selected' : ''); ?>>Tidak Bekerja</option>
            </select>
            @if ($errors->has('pekerjaan_korban.0'))
                <span style="color: red">{{ $errors->first('pekerjaan_korban.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-5">
            <select class="custom-select" id="inputStatus" name="status_korban[]">
                <option value="Belum Menikah" <?= ('Belum Menikah' == old('status_korban.0') ? 'selected' : ''); ?>>Belum Menikah</option>
                <option value="Menikah" <?= ('Menikah' == old('status_korban.0') ? 'selected' : ''); ?>>Menikah</option>
                <option value="Duda/Janda" <?= ('Duda/Janda' == old('status_korban.0') ? 'selected' : ''); ?>>Duda/Janda</option>
                <option value="Sirri" <?= ('Sirri' == old('status_korban.0') ? 'selected' : ''); ?>>Sirri</option>
            </select>
            @if ($errors->has('status_korban.0'))
                <span style="color: red">{{ $errors->first('status_korban.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban" id="RadioDifabelY"
                    value="Ya" <?= ('Ya' == old('difabel_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioDifabelY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban" id="RadioDifabelT"
                    value="Tidak" <?= ('Tidak' == old('difabel_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioDifabelT">Tidak</label>
            </div>
            @if ($errors->has('difabel_korban'))
                <span style="color: red">{{ $errors->first('difabel_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputKdrt" class="col-sm-2 col-form-label">KDRT</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kdrt_korban" id="RadioKDRTY"
                    value="Ya" <?= ('Ya' == old('kdrt_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kdrt_korban" id="RadioKDRTT"
                    value="Tidak" <?= ('Tidak' == old('kdrt_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTT">Tidak</label>
            </div>
            @if ($errors->has('kdrt_korban'))
                <span style="color: red">{{ $errors->first('kdrt_korban') }}</span>
            @endif
        </div>
    </div>
    <?php
        $valueKekerasan = old("tindak_kekerasan_korban.0");
        $valueTrafficking = old("trafficking_korban.0");

        $listTrafficking = '';
        if ($valueKekerasan != null)
            $listTrafficking = implode(" ",  $valueKekerasan);
    ?>
    <div class="form-group row">
        <label for="inputKekerasan" class="col-sm-2 col-form-label">Tindak Kekerasan Yang Dialami
            Korban</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Fisik" id="checkKekerasan1" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Fisik') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan1">
                    Fisik
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Psikis" id="checkKekerasan2" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Psikis') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan2">
                    Psikis
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Seksual" id="checkKekerasan3" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Seksual') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan3">
                    Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Penelantaran"
                    id="checkKekerasan4" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Penelantaran') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan4">
                    Penelantaran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Trafficking"
                    id="checkKekerasan5" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Trafficking') : ''; ?>/>
                <label class="form-check-label" for="checkKekerasan5">
                    Trafficking
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi"
                    id="checkKekerasan6" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Eksploitasi') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan6">
                    Eksploitasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lainnya" id="checkKekerasan7" name="tindak_kekerasan_korban[0][]" <?= ($valueKekerasan != null) ? cekComboBox($valueKekerasan, 'Lainnya') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan7">
                    Lainnya
                </label>
            </div>
            @if ($errors->has('tindak_kekerasan_korban.0.0'))
                <span style="color: red">{{ $errors->first('tindak_kekerasan_korban.0.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row" id="sectionTrafficking" style="display: none;">
        <label for="inputTrafficking" class="col-sm-2 col-form-label">Kategori Trafficking</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi Seksual"
                    id="checkTrafficking1" name="trafficking_korban[0][]" <?= ($valueTrafficking != null) ? cekComboBox($valueTrafficking, 'Eksploitasi Seksual') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking1">
                    Eksploitasi Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perbudakan"
                    id="checkTrafficking2" name="trafficking_korban[0][]" <?= ($valueTrafficking != null) ? cekComboBox($valueTrafficking, 'Perbudakan') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking2">
                    Perbudakan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Organ Tubuh"
                    id="checkTrafficking3" name="trafficking_korban[0][]" <?= ($valueTrafficking != null) ? cekComboBox($valueTrafficking, 'Perdagangan Organ Tubuh') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking3">
                    Perdagangan Organ Tubuh
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Narkoba"
                    id="checkTrafficking4" name="trafficking_korban[0][]" <?= ($valueTrafficking != null) ? cekComboBox($valueTrafficking, 'Perdagangan Narkoba') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking4">
                    Perdagangan Narkoba
                </label>
            </div>
            @if ($errors->has('trafficking_korban.0.0'))
                <span style="color: red">{{ $errors->first('trafficking_korban.0.0') }}</span>
            @endif
        </div>
    </div>
<?php
    for ($x = 1; $x < session('totKorban'); $x++) { ?>
        @include('lapor/formKorban')
<?php
    }
    function cekComboBox($array, $value) {
        for ($i = 0; $i < count($array); $i++) { 
            if($array[$i] == $value)
                return "checked";
        }
        return "";
    }
?>
</div>
</span>
        <div class="form-group row">
            <div class="col-sm-6">
                <a class="btn btn-warning" id="btBackKorban">Back</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success" id="btNextKorban">Next</a>
            </div>
        </div>
</div>
        <?php //echo '<pre>';print_r($errors); echo '</pre>';
        ?>
<script type="text/javascript">
    $(function() {
        $('#btNextKorban').click(function() {
            $('#pills-korban').attr('class', 'tab-pane fade');
            $('#pills-pelaku').attr('class', 'tab-pane fade show active');
        });
        $('#btBackKorban').click(function() {
            $('#pills-korban').attr('class', 'tab-pane fade');
            $('#pills-pelapor').attr('class', 'tab-pane fade show active');
        });

        const checkbox = $("#checkKekerasan5");
        checkbox.change(function(event) {
            var checkbox = event.target;
            if (checkbox.checked) {
                $('#sectionTrafficking').css('display', '');
                // $("input[name='trafficking_korban']").attr('disabled', true);
            } else {
                $('#sectionTrafficking').css('display', 'none');
            }
        });

        counterKorban = 1;
        $('#addKorban').click(function() {
            var $clone = $( "#formTabKorban" ).clone().appendTo( "#formTabKorbanMain" );
            // $clone.find('[id]').each(function(){
            $clone.find("input[name='tindak_kekerasan_korban[0][]']").each(function(){
                // this.name += counterKorban;
                this.name = "tindak_kekerasan_korban[" + counterKorban + "][]";
                // this.id += counterKorban;
            });
            $clone.find("input[name='trafficking_korban[0][]']").each(function(){
                this.name = "trafficking_korban[" + counterKorban + "][]";
            });
            $clone.find("input[type='radio']").each(function(){
                this.name += counterKorban;
            });
            $clone.find('[id]').each(function(){
                this.id += counterKorban;
            });
            const checkbox = $("#checkKekerasan5"+ counterKorban);
            var secTrafic = $("#sectionTrafficking"+ counterKorban);
            checkbox.change(function(event) {
                var checkbox = event.target;
                if (checkbox.checked) {
                    console.log('ye'+ counterKorban);
                    // $("#sectionTrafficking"+ counterKorban).css('display', '');
                    secTrafic.css('display', '');
                } else {
                    console.log('yah'+ counterKorban);
                    // $("#sectionTrafficking"+ counter).css('display', 'none');
                    secTrafic.css('display', 'none');
                }
            });
            $('#counterKorban'+counterKorban).html(counterKorban+1);


            counterKorban++;
        })

        var trafficking0 = "{{ $listTrafficking }}";
        if(trafficking0.indexOf('Trafficking') !== -1)
            $('#sectionTrafficking').css('display', '');
        // var id = ['#inputNama', '#inputUsia', '#inputTTL', '#inputAlamat', '#inputNO'];
        // for (var i = 0; i < "{{ (session('totKorban')-1) }}"; i++) {
        //     var $clone = $( "#formTabKorban" ).clone().appendTo( "#formTabKorbanMain" );
        //     $clone.find('[id]').each(function(){
        //         this.id += (i+1);
        //     });
        //     for (var j = 0; j < id.length; j++) {
        //         $(id[j]).val("{{ old('nama_korban.j') }}");
        //     }
        // }
    });
</script>
