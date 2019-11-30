<h3>Korban ke-<span id="counterKorban">{{ ($x+1) }}</span></h3>
    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputNama{{ $x }}" name="nama_korban[]" value='{{ old("nama_korban.$x") }}'>
            @if ($errors->has("nama_korban.$x"))
                <span style="color: red">{{ $errors->first('nama_korban.0') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban{{ $x }}" id="RadioJKL{{ $x }}"
                    value="Laki-laki" <?= ('Laki-laki' == old("jenis_kelamin_korban$x") ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban{{ $x }}" id="RadioJKLP{{ $x }}"
                    value="Perempuan"  <?= ('Perempuan' == old("jenis_kelamin_korban$x") ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKP">Perempuan</label>
            </div>
            @if ($errors->has("jenis_kelamin_korban$x"))
                <span style="color: red">{{ $errors->first("jenis_kelamin_korban$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="inputUsia{{ $x }}" name="usia_korban[]" min="0" value='{{ old("usia_korban.$x") }}'>
            @if ($errors->has("usia_korban.$x"))
                <span style="color: red">{{ $errors->first("usia_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputTTL{{ $x }}" name="ttl_korban[]" value='{{ old("ttl_korban.$x") }}'>
            @if ($errors->has("ttl_korban.$x"))
                <span style="color: red">{{ $errors->first("ttl_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-5">
            <textarea type="text" class="form-control" id="inputAlamat{{ $x }}" rows="3" name="alamat_korban[]">{{ old("alamat_korban.$x") }}</textarea>
            @if ($errors->has("alamat_korban.$x"))
                <span style="color: red">{{ $errors->first("alamat_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="inputNO{{ $x }}" name="telepon_korban[]" value='{{ old("telepon_korban.$x") }}'>
            @if ($errors->has("telepon_korban.$x"))
                <span style="color: red">{{ $errors->first("telepon_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPendidikan{{ $x }}" name="pendidikan_korban[]">
                <option value="TK" <?= ('TK' == old("pendidikan_korban.$x") ? 'selected' : ''); ?>>TK</option>
                <option value="SD" <?= ('SD' == old("pendidikan_korban.$x") ? 'selected' : ''); ?>>SD</option>
                <option value="SMP" <?= ('SMP' == old("pendidikan_korban.$x") ? 'selected' : ''); ?>>SMP</option>
                <option value="SMA" <?= ('SMA' == old("pendidikan_korban.$x") ? 'selected' : ''); ?>>SMA</option>
                <option value="S1/S2/S3" <?= ('S1/S2/S3' == old("pendidikan_korban.$x") ? 'selected' : ''); ?>>S1/S2/S3</option>
            </select>
            @if ($errors->has("pendidikan_korban.$x"))
                <span style="color: red">{{ $errors->first("pendidikan_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputAgama{{ $x }}" name="agama_korban[]">
                <option value="Islam" <?= ('Islam' == old("agama_korban.$x") ? 'selected' : ''); ?>>Islam</option>
                <option value="Kristen" <?= ('Kristen' == old("agama_korban.$x") ? 'selected' : ''); ?>>Kristen</option>
                <option value="Katolik" <?= ('Katolik' == old("agama_korban.$x") ? 'selected' : ''); ?>>Katolik</option>
                <option value="Budha" <?= ('Budha' == old("agama_korban.$x") ? 'selected' : ''); ?>>Budha</option>
                <option value="Hindu" <?= ('Hindu' == old("agama_korban.$x") ? 'selected' : ''); ?>>Hindu</option>
                <option value="Konghucu" <?= ('Konghucu' == old("agama_korban.$x") ? 'selected' : ''); ?>>Konghucu</option>
            </select>
            @if ($errors->has("agama_korban.$x"))
                <span style="color: red">{{ $errors->first("agama_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPekerjaan{{ $x }}" name="pekerjaan_korban[]">
                <option value="Pedagang/Tani/Nelayan" <?= ('Guru' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>Pedagang/Tani/Nelayan</option>
                <option value="Swasta/Buruh" <?= ('Swasta/Buruh' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>Swasta/Buruh</option>
                <option value="PNS/TNI/Polri" <?= ('PNS/TNI/Polri' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>PNS/TNI/Polri</option>
                <option value="Pelajar" <?= ('Pelajar' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>Pelajar</option>
                <option value="Ibu Rumah Tangga" <?= ('Ibu Rumah Tangga' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>Ibu Rumah Tangga</option>
                <option value="Tidak Bekerja" <?= ('Tidak Bekerja' == old("pekerjaan_korban.$x") ? 'selected' : ''); ?>>Tidak Bekerja</option>
            </select>
            @if ($errors->has("pekerjaan_korban.$x"))
                <span style="color: red">{{ $errors->first("pekerjaan_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-5">
            <select class="custom-select" id="inputStatus{{ $x }}" name="status_korban[]">
                <option value="Belum Menikah" <?= ('Belum Menikah' == old("status_korban.$x") ? 'selected' : ''); ?>>Belum Menikah</option>
                <option value="Menikah" <?= ('Menikah' == old("status_korban.$x") ? 'selected' : ''); ?>>Menikah</option>
                <option value="Duda/Janda" <?= ('Duda/Janda' == old("status_korban.$x") ? 'selected' : ''); ?>>Duda/Janda</option>
                <option value="Sirri" <?= ('Sirri' == old("status_korban.$x") ? 'selected' : ''); ?>>Sirri</option>
            </select>
            @if ($errors->has("status_korban$x"))
                <span style="color: red">{{ $errors->first("status_korban.$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban{{ $x }}" id="RadioDifabelY{{ $x }}"
                    value="Ya" <?= ('Ya' == old("difabel_korban".$x) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioDifabelY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban{{ $x }}" id="RadioDifabelT{{ $x }}"
                    value="Tidak" <?= ('Tidak' == old("difabel_korban".$x) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioDifabelT">Tidak</label>
            </div>
            @if ($errors->has("difabel_korban$x"))
                <span style="color: red">{{ $errors->first("difabel_korban$x") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputKdrt" class="col-sm-2 col-form-label">KDRT</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kdrt_korban{{ $x }}" id="RadioKDRTY{{ $x }}"
                    value="Ya" <?= ('Ya' == old("kdrt_korban$x") ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kdrt_korban{{ $x }}" id="RadioKDRTT{{ $x }}"
                    value="Tidak" <?= ('Tidak' == old("kdrt_korban$x") ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTT">Tidak</label>
            </div>
            @if ($errors->has("kdrt_korban$x"))
                <span style="color: red">{{ $errors->first("kdrt_korban$x") }}</span>
            @endif
        </div>
    </div>
    <?php
        $valueKekerasan2 = old("tindak_kekerasan_korban.$x");
        $valueTrafficking2 = old("trafficking_korban.$x");
        $idSectionTrafficking = "sectionTrafficking$x";

        $listTrafficking2 = '';
        if ($valueKekerasan2 != null){
            $listTrafficking2 = implode(" ",  $valueKekerasan2);
        }
    ?>
    <div class="form-group row">
        <label for="inputKekerasan" class="col-sm-2 col-form-label">Tindak Kekerasan Yang Dialami
            Korban</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Fisik" id="checkKekerasan1" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Fisik') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan1">
                    Fisik
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Psikis" id="checkKekerasan2" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Psikis') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan2">
                    Psikis
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Seksual" id="checkKekerasan3" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Seksual') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan3">
                    Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Penelantaran"
                    id="checkKekerasan4" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Penelantaran') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan4">
                    Penelantaran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Trafficking"
                    id="checkKekerasan5{{ $x }}" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Trafficking') : ''; ?>/>
                <label class="form-check-label" for="checkKekerasan5">
                    Trafficking
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi"
                    id="checkKekerasan6" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Eksploitasi') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan6">
                    Eksploitasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lainnya" id="checkKekerasan7" name="tindak_kekerasan_korban[{{ $x }}][]" <?= ($valueKekerasan2 != null) ? cekComboBox($valueKekerasan2, 'Lainnya') : ''; ?>>
                <label class="form-check-label" for="checkKekerasan7">
                    Lainnya
                </label>
            </div>
            @if ($errors->has("tindak_kekerasan_korban.$x.0"))
                <span style="color: red">{{ $errors->first("tindak_kekerasan_korban.$x.0") }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row" id="sectionTrafficking{{ $x }}" style="display: none;">
        <label for="inputTrafficking" class="col-sm-2 col-form-label">Kategori Trafficking</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi Seksual"
                    id="checkTrafficking1" name="trafficking_korban[{{ $x }}][]" <?= ($valueTrafficking2 != null) ? cekComboBox($valueTrafficking2, 'Eksploitasi Seksual') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking1">
                    Eksploitasi Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perbudakan"
                    id="checkTrafficking2" name="trafficking_korban[{{ $x }}][]" <?= ($valueTrafficking2 != null) ? cekComboBox($valueTrafficking2, 'Perbudakan') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking2">
                    Perbudakan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Organ Tubuh"
                    id="checkTrafficking3" name="trafficking_korban[{{ $x }}][]" <?= ($valueTrafficking2 != null) ? cekComboBox($valueTrafficking2, 'Perdagangan Organ Tubuh') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking3">
                    Perdagangan Organ Tubuh
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Narkoba"
                    id="checkTrafficking4" name="trafficking_korban[{{ $x }}][]" <?= ($valueTrafficking2 != null) ? cekComboBox($valueTrafficking2, 'Perdagangan Narkoba') : ''; ?>>
                <label class="form-check-label" for="checkTrafficking4">
                    Perdagangan Narkoba
                </label>
            </div>
            @if ($errors->has("trafficking_korban.$x.0"))
                <span style="color: red">{{ $errors->first("trafficking_korban.$x.0") }}</span>
            @endif
        </div>
    </div>
<script type="text/javascript">
    $(function() {
        const checkbox = $("#checkKekerasan5"+ {{ $x }});
        var secTrafic = $("#sectionTrafficking"+ {{ $x }});
        checkbox.change(function(event) {
            var checkbox = event.target;
            if (checkbox.checked) {
                secTrafic.css('display', '');
            } else {
                secTrafic.css('display', 'none');
            }
        });
        var trafficking2 = "{{ $listTrafficking2 }}";
            if(trafficking2.indexOf('Trafficking') !== -1)
                $('#'+"{{ $idSectionTrafficking }}").css('display', '');
    });
</script>
