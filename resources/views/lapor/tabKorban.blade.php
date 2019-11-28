<div class="card-header">Korban<a class="float-right" id="addKorban">+</a></div>
<span id="formTabKorbanMain">
    
<div class="card-body" id="formTabKorban">
<h3>Korban ke-<span id="counterKorban">1</span></h3>
    <div class="form-group row">
        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputNama" name="nama_korban[]" value="{{ old('nama_korban.*') }}">
            @if ($errors->has('nama_korban.*'))
                <span style="color: red">{{ $errors->first('nama_korban.*') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban" id="RadioJKL"
                    value="Laki-laki" <?= ('Laki-laki' == old('jenis_kelamin_korban[]') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin_korban" id="RadioJKLP"
                    value="Perempuan"  <?= ('Perempuan' == old('jenis_kelamin_korban[]') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioJKP">Perempuan</label>
            </div>
            @if ($errors->has('jenis_kelamin_korban'))
                <span style="color: red">{{ $errors->first('jenis_kelamin_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="inputUsia" name="usia_korban[]" min="0" value="{{ old('usia_korban[]') }}">
            @if ($errors->has('usia_korban[]'))
                <span style="color: red">{{ $errors->first('usia_korban[]') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputTTL" name="ttl_korban[]" value="{{ old('ttl_korban[]') }}">
            @if ($errors->has('ttl_korban[]'))
                <span style="color: red">{{ $errors->first('ttl_korban[]') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-5">
            <textarea type="text" class="form-control" id="inputAlamat" rows="3" name="alamat_korban[]">{{ old('alamat_korban[]') }}</textarea>
            @if ($errors->has('alamat_korban[]'))
                <span style="color: red">{{ $errors->first('alamat_korban[]') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="inputNO" name="telepon_korban[]" value="{{ old('telepon_korban[]') }}">
            @if ($errors->has('telepon_korban[]'))
                <span style="color: red">{{ $errors->first('telepon_korban[]') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPendidikan" name="pendidikan_korban[]">
                <option value="TK" <?= ('TK' == old('pendidikan_korban') ? 'selected' : ''); ?>>TK</option>
                <option value="SD" <?= ('SD' == old('pendidikan_korban') ? 'selected' : ''); ?>>SD</option>
                <option value="SMP" <?= ('SMP' == old('pendidikan_korban') ? 'selected' : ''); ?>>SMP</option>
                <option value="SMA" <?= ('SMA' == old('pendidikan_korban') ? 'selected' : ''); ?>>SMA</option>
                <option value="S1/S2/S3" <?= ('S1/S2/S3' == old('pendidikan_korban') ? 'selected' : ''); ?>>S1/S2/S3</option>
            </select>
            @if ($errors->has('pendidikan_korban'))
                <span style="color: red">{{ $errors->first('pendidikan_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputAgama" name="agama_korban[]">
                <option value="Islam" <?= ('Islam' == old('agama_korban') ? 'selected' : ''); ?>>Islam</option>
                <option value="Kristen" <?= ('Kristen' == old('agama_korban') ? 'selected' : ''); ?>>Kristen</option>
                <option value="Katolik" <?= ('Katolik' == old('agama_korban') ? 'selected' : ''); ?>>Katolik</option>
                <option value="Budha" <?= ('Budha' == old('agama_korban') ? 'selected' : ''); ?>>Budha</option>
                <option value="Hindu" <?= ('Hindu' == old('agama_korban') ? 'selected' : ''); ?>>Hindu</option>
                <option value="Konghucu" <?= ('Konghucu' == old('agama_korban') ? 'selected' : ''); ?>>Konghucu</option>
            </select>
            @if ($errors->has('agama_korban'))
                <span style="color: red">{{ $errors->first('agama_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="input-group col-sm-5">
            <select class="custom-select" id="inputPekerjaan" name="pekerjaan_korban[]">
                <option value="Pedagang/Tani/Nelayan" <?= ('Guru' == old('pekerjaan_korban') ? 'selected' : ''); ?>>Pedagang/Tani/Nelayan</option>
                <option value="Swasta/Buruh" <?= ('Swasta/Buruh' == old('pekerjaan_korban') ? 'selected' : ''); ?>>Swasta/Buruh</option>
                <option value="PNS/TNI/Polri" <?= ('PNS/TNI/Polri' == old('pekerjaan_korban') ? 'selected' : ''); ?>>PNS/TNI/Polri</option>
                <option value="Pelajar" <?= ('Pelajar' == old('pekerjaan_korban') ? 'selected' : ''); ?>>Pelajar</option>
                <option value="Ibu Rumah Tangga" <?= ('Ibu Rumah Tangga' == old('pekerjaan_korban') ? 'selected' : ''); ?>>Ibu Rumah Tangga</option>
                <option value="Tidak Bekerja" <?= ('Tidak Bekerja' == old('pekerjaan_korban') ? 'selected' : ''); ?>>Tidak Bekerja</option>
            </select>
            @if ($errors->has('pekerjaan_korban'))
                <span style="color: red">{{ $errors->first('pekerjaan_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-5">
            <select class="custom-select" id="inputStatus" name="status_korban[]">
                <option value="Belum Menikah" <?= ('Belum Menikah' == old('status_korban') ? 'selected' : ''); ?>>Belum Menikah</option>
                <option value="Menikah" <?= ('Menikah' == old('status_korban') ? 'selected' : ''); ?>>Menikah</option>
                <option value="Duda/Janda" <?= ('Duda/Janda' == old('status_korban') ? 'selected' : ''); ?>>Duda/Janda</option>
                <option value="Sirri" <?= ('Sirri' == old('status_korban') ? 'selected' : ''); ?>>Sirri</option>
            </select>
            @if ($errors->has('status_korban'))
                <span style="color: red">{{ $errors->first('status_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
        <div class="col-sm-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban[]" id="RadioDifabelY"
                    value="Ya" <?= ('Ya' == old('difabel_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioDifabelY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="difabel_korban[]" id="RadioDifabelT"
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
                <input class="form-check-input" type="radio" name="kdrt_korban[]" id="RadioKDRTY"
                    value="Ya" <?= ('Ya' == old('kdrt_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTY">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kdrt_korban[]" id="RadioKDRTT"
                    value="Tidak" <?= ('Tidak' == old('kdrt_korban') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="RadioKDRTT">Tidak</label>
            </div>
            @if ($errors->has('kdrt_korban'))
                <span style="color: red">{{ $errors->first('kdrt_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputKekerasan" class="col-sm-2 col-form-label">Tindak Kekerasan Yang Dialami
            Korban</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Fisik" id="checkKekerasan1" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan1">
                    Fisik
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Psikis" id="checkKekerasan2" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan2">
                    Psikis
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Seksual" id="checkKekerasan3" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan3">
                    Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Penelantaran"
                    id="checkKekerasan4" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan4">
                    Penelantaran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Trafficking"
                    id="checkKekerasan5" name="tindak_kekerasan_korban[0][]"/>
                <label class="form-check-label" for="checkKekerasan5">
                    Trafficking
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi"
                    id="checkKekerasan6" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan6">
                    Eksploitasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lainnya" id="checkKekerasan7" name="tindak_kekerasan_korban[0][]">
                <label class="form-check-label" for="checkKekerasan7">
                    Lainnya
                </label>
            </div>
            @if ($errors->has('tindak_kekerasan_korban'))
                <span style="color: red">{{ $errors->first('tindak_kekerasan_korban') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row" id="sectionTrafficking" style="display: none;">
        <label for="inputTrafficking" class="col-sm-2 col-form-label">Kategori Trafficking</label>
        <div class="col-sm-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Eksploitasi Seksual"
                    id="checkTrafficking1" name="trafficking_korban[0][]">
                <label class="form-check-label" for="checkTrafficking1">
                    Eksploitasi Seksual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perbudakan"
                    id="checkTrafficking2" name="trafficking_korban[0][]">
                <label class="form-check-label" for="checkTrafficking2">
                    Perbudakan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Organ Tubuh"
                    id="checkTrafficking3" name="trafficking_korban[0][]">
                <label class="form-check-label" for="checkTrafficking3">
                    Perdagangan Organ Tubuh
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perdagangan Narkoba"
                    id="checkTrafficking4" name="trafficking_korban[0][]">
                <label class="form-check-label" for="checkTrafficking4">
                    Perdagangan Narkoba
                </label>
            </div>
            @if ($errors->has('trafficking_korban'))
                <span style="color: red">{{ $errors->first('trafficking_korban') }}</span>
            @endif
        </div>
    </div>
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
        <?php echo '<pre>';print_r($errors); echo '</pre>';
    echo $errors->nama_korban;
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

        counter = 1;
        $('#addKorban').click(function() {
            var $clone = $( "#formTabKorban" ).clone().appendTo( "#formTabKorbanMain" );
            // $clone.find('[id]').each(function(){
            $clone.find("input[name='tindak_kekerasan_korban[0][]']").each(function(){
                console.log('sa');
                // this.name += counter;
                this.name = "tindak_kekerasan_korban[" + counter + "][]";
                // this.id += counter;
            });
            $clone.find("input[name='trafficking_korban[0][]']").each(function(){
                this.name = "trafficking_korban[" + counter + "][]";
            });
            $clone.find('[id]').each(function(){
                this.id += counter;
            });
            const checkbox = $("#checkKekerasan5"+ counter);
            var secTrafic = $("#sectionTrafficking"+ counter);
            checkbox.change(function(event) {
                var checkbox = event.target;
                if (checkbox.checked) {
                    console.log('ye'+ counter);
                    // $("#sectionTrafficking"+ counter).css('display', '');
                    secTrafic.css('display', '');
                } else {
                    console.log('yah'+ counter);
                    // $("#sectionTrafficking"+ counter).css('display', 'none');
                    secTrafic.css('display', 'none');
                }
            });
            $('#counterKorban'+counter).html(counter+1);


            counter++;
        })

        var id = ['#inputNama', '#inputUsia', '#inputTTL', '#inputAlamat', '#inputNO'];
        for (var i = 0; i < "{{ (session('totKorban')-1) }}"; i++) {
            var $clone = $( "#formTabKorban" ).clone().appendTo( "#formTabKorbanMain" );
            $clone.find('[id]').each(function(){
                this.id += (i+1);
            });
            for (var j = 0; j < id.length; j++) {
                $(id[j]).val("{{ old('nama_korban.j') }}");
            }
        }
    });
</script>