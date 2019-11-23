<!-- Modal -->
<div class="modal fade" id="modalTambahPelaku" tabindex="-1" role="dialog" aria-labelledby="modalTambahPelakuTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Pelaku</h5>
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
		            <div class="card-header">Pelaku</div>
		            <div class="card-body">
		                <form action='{{ url("kasus/edit/$idKasus/pelaku/new") }}' method="post">
		                    @csrf
		                    <div class="form-group row">
		                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" id="inputNama" name="nama" value="{{ old('nama') }}">
		                            @if ($errors->has('nama'))
		                                <span style="color: red">{{ 'Kolom nama harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
		                        <div class="col-sm-5">
		                            <div class="form-check form-check-inline">
		                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKL"
		                                    value="Laki-laki" <?= ('Laki-laki' == old('jenis_kelamin') ? 'checked' : ''); ?>>
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
		                                <span style="color: red">{{ 'Kolom usia harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" id="inputTTL" name="ttl" value="{{ old('ttl') }}">
		                            @if ($errors->has('ttl'))
		                                <span style="color: red">{{ 'Kolom TTL harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
		                        <div class="col-sm-5">
		                            <textarea type="text" class="form-control" id="inputAlamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
		                        <div class="col-sm-5">
		                            <input type="tel" class="form-control" id="inputNO" name="telepon" value="{{ old('telepon') }}">
		                            @if ($errors->has('telepon'))
		                                <span style="color: red">{{ 'Kolom No. Telp/HP harus berisi nilai' }}</span>
		                            @endif
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
		                        <div class="input-group col-sm-5">
		                            <select class="custom-select" id="inputPendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
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
		                        <div class="input-group col-sm-5">
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
		                        <div class="input-group col-sm-5">
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
		                        <div class="col-sm-5">
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
		                        <div class="col-sm-5">
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
				                <label for="inputHubungan" class="col-sm-2 col-form-label">Hubungan Dengan Korban</label>
				                <div class="input-group col-sm-5">
				                    <select class="custom-select" id="inputHubungan" name="hubungan_dengan_korban">
				                        <option value="Orang Tua">Orang Tua</option>
				                        <option value="Keluarga/Saudara">Keluarga/Saudara</option>
				                        <option value="Suami/Istri">Suami/Istri</option>
				                        <option value="Tetangga">Tetangga</option>
				                        <option value="Pacar/Teman">Pacar/Teman</option>
				                        <option value="Guru">Guru</option>
				                        <option value="Majikan">Majikan</option>
				                        <option value="Rekan Kerja">Rekan Kerja</option>
				                    </select>
				                    @if ($errors->has('hubungan_dengan_korban'))
				                        <span style="color: red">{{ 'Kolom hubungan harus berisi nilai' }}</span>
				                    @endif
				                </div>
				            </div>
		                    <div class="form-group row">
		                        <label class="col-sm-2 col-form-label"></label>
		                        <div class="col-sm-5">
		                            <button class="btn btn-primary" type="submit">Tambah Pelaku</button>
		                            <input type="hidden" name="modal" value="#btnModalTambahPelaku">
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