<!-- Modal -->
<div class="modal fade" id="modalTambahKorban" tabindex="-1" role="dialog" aria-labelledby="modalTambahKorbanTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Korban</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card card-default">
		            @if(session('notification'))
		                <div class="alert alert-success alert-dismisable">
		                    <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
		                    <strong>{{ session('notification') }}</strong>
		                </div>
		            @endif
		            <div class="card-header">Korban</div>
		            <div class="card-body">
		                <form action='{{ url("kasus/edit/$idKasus/korban/new") }}' method="post">
		                    @csrf
		                    <div class="form-group row">
		                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" id="inputNama" name="nama" value="{{ old('nama') }}">
		                            @if ($errors->has('nama'))
		                                <span style="color: red">{{ 'Kolom nama harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
		                        <div class="col-sm-10">
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKL"
		                                    value="Laki-laki">
		                                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
		                            </div>
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKP"
		                                    value="Perempuan" <?= ('Perempuan' == old('jenis_kelamin') ? 'checked' : ''); ?>>
		                                <label class="form-check-label" for="RadioJKP">Perempuan</label>
		                            </div>
		                            @if ($errors->has('jenis_kelamin'))
		                                <span style="color: red">{{ 'Kolom jenis kelamin harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
		                        <div class="col-sm-2">
		                            <input type="number" class="form-control" id="inputUsia" name="usia" min="0" value="{{ old('usia') }}">
		                        </div>
		                        <div class="col-sm-8">
		                            @if ($errors->has('usia'))
		                                <span style="color: red">{{ 'Kolom usia harus berisi angka minimal 0' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" id="inputTTL" name="ttl" value="{{ old('ttl') }}">
		                            @if ($errors->has('ttl'))
		                                <span style="color: red">{{ 'Kolom TTL harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
		                        <div class="col-sm-10">
		                            <textarea type="text" class="form-control" id="inputAlamat" rows="3" name="alamat">{{ old('alamat') }}</textarea>
		                            @if ($errors->has('alamat'))
		                                <span style="color: red">{{ 'Kolom alamat harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
		                        <div class="col-sm-10">
		                            <input type="number" class="form-control" id="inputNO" name="telepon" value="{{ old('telepon') }}">
		                            @if ($errors->has('telepon'))
		                                <span style="color: red">{{ 'Kolom No. Telp/HP harus berisi angka maksimal 12 digit' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
		                        <div class="input-group col-sm-10">
		                            <select class="custom-select" id="inputPendidikan" name="pendidikan">
		                                <option value="TK">TK</option>
		                                <option value="SD">SD</option>
		                                <option value="SMP">SMP</option>
		                                <option value="SMA">SMA</option>
		                                <option value="S1/S2/S3">S1/S2/S3</option>
		                            </select>
		                            @if ($errors->has('pendidikan'))
		                                <span style="color: red">{{ 'Kolom pendidikan harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
		                        <div class="input-group col-sm-10">
		                            <select class="custom-select" id="inputAgama" name="agama">
		                                <option value="Islam">Islam</option>
		                                <option value="Kristen">Kristen</option>
		                                <option value="Katolik">Katolik</option>
		                                <option value="Budha">Budha</option>
		                                <option value="Hindu">Hindu</option>
		                                <option value="Konghucu">Konghucu</option>
		                            </select>
		                            @if ($errors->has('agama'))
		                                <span style="color: red">{{ 'Kolom agama harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
		                        <div class="input-group col-sm-10">
		                            <select class="custom-select" id="inputPekerjaan" name="pekerjaan">
		                                <option value="Pedagang/Tani/Nelayan">Pedagang/Tani/Nelayan</option>
		                                <option value="Swasta/Buruh">Swasta/Buruh</option>
		                                <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
		                                <option value="Pelajar">Pelajar</option>
		                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
		                                <option value="Tidak Bekerja">Tidak Bekerja</option>
		                            </select>
		                            @if ($errors->has('pekerjaan'))
		                                <span style="color: red">{{ 'Kolom pekerjaan harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
		                        <div class="col-sm-10">
		                            <select class="custom-select" id="inputStatus" name="status">
		                                <option value="Belum Menikah">Belum Menikah</option>
		                                <option value="Menikah">Menikah</option>
		                                <option value="Duda/Janda">Duda/Janda</option>
		                                <option value="Sirri">Sirri</option>
		                            </select>
		                            @if ($errors->has('status'))
		                                <span style="color: red">{{ 'Kolom status harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
		                        <div class="col-sm-10">
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="difabel" id="RadioDifabelY"
		                                    value="Ya" <?= ('Ya' == old('difabel') ? 'checked' : ''); ?>>
		                                <label class="form-check-label" for="RadioDifabelY">Ya</label>
		                            </div>
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="difabel" id="RadioDifabelT"
		                                    value="Tidak" <?= ('Tidak' == old('difabel') ? 'checked' : ''); ?>>
		                                <label class="form-check-label" for="RadioDifabelT">Tidak</label>
		                            </div>
		                            @if ($errors->has('difabel'))
		                                <span style="color: red">{{ 'Kolom difabel harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputKdrt" class="col-sm-2 col-form-label">KDRT</label>
		                        <div class="col-sm-10">
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="kdrt" id="RadioKDRTY"
		                                    value="Ya" <?= ('Ya' == old('kdrt') ? 'checked' : ''); ?>>
		                                <label class="form-check-label" for="RadioKDRTY">Ya</label>
		                            </div>
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="kdrt" id="RadioKDRTT"
		                                    value="Tidak" <?= ('Tidak' == old('kdrt') ? 'checked' : ''); ?>>
		                                <label class="form-check-label" for="RadioKDRTT">Tidak</label>
		                            </div>
		                            @if ($errors->has('kdrt'))
		                                <span style="color: red">{{ 'Kolom KDRT harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputKekerasan" class="col-sm-2 col-form-label">Tindak Kekerasan Yang Dialami
		                            Korban</label>
		                        <div class="col-sm-10">
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Fisik" id="checkKekerasan1" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan1">
		                                    Fisik
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Psikis" id="checkKekerasan2" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan2">
		                                    Psikis
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Seksual" id="checkKekerasan3" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan3">
		                                    Seksual
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Penelantaran"
		                                    id="checkKekerasan4" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan4">
		                                    Penelantaran
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Trafficking"
		                                    id="checkKekerasan5" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan5">
		                                    Trafficking
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Eksploitasi"
		                                    id="checkKekerasan6" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan6">
		                                    Eksploitasi
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Lainnya" id="checkKekerasan7" name="tindak_kekerasan[]">
		                                <label class="form-check-label" for="checkKekerasan7">
		                                    Lainnya
		                                </label>
		                            </div>
		                            @if ($errors->has('tindak_kekerasan'))
		                                <span style="color: red">{{ 'Kolom kekerasan harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <input type="hidden" name="modal" value="#btnModalTambahKorban">
		                    <div class="form-group row">
		                        <label for="inputTrafficking" class="col-sm-2 col-form-label">Kategori Trafficking</label>
		                        <div class="col-sm-10">
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Eksploitasi Seksual"
		                                    id="checkTrafficking1" name="trafficking[]">
		                                <label class="form-check-label" for="checkTrafficking1">
		                                    Eksploitasi Seksual
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Perbudakan"
		                                    id="checkTrafficking2" name="trafficking[]">
		                                <label class="form-check-label" for="checkTrafficking2">
		                                    Perbudakan
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Perdagangan Organ Tubuh"
		                                    id="checkTrafficking3" name="trafficking[]">
		                                <label class="form-check-label" for="checkTrafficking3">
		                                    Perdagangan Organ Tubuh
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <input class="form-check-input" type="checkbox" value="Perdagangan Narkoba"
		                                    id="checkTrafficking3" name="trafficking[]">
		                                <label class="form-check-label" for="checkTrafficking3">
		                                    Perdagangan Narkoba
		                                </label>
		                            </div>
		                            @if ($errors->has('trafficking'))
		                                <span style="color: red">{{ 'Kolom trafficking harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label class="col-sm-5 col-form-label"></label>
		                        <div class="col-sm-6">
		                            <button class="btn btn-primary" type="submit">Tambah Korban</button>
		                        </div>
		                    </div>
		                </form>
		            </div>
		        </div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>