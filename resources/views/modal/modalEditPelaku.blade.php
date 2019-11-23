<!-- Modal -->
<div class="modal fade" id="modalEditPelaku{{$data->id_pelaku}}" tabindex="-1" role="dialog"
    aria-labelledby="modalEditPelakuTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Pelaku</h5>
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
                    <div class="card-header">Data Pelaku</div>
                    <div class="card-body">
                        <form action='{{ url("kasus/edit/$idKasus/pelaku/$data->id_pelaku") }}' method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputNama" name="nama"
                                        value="{{$data->nama}}">
                                    @if ($errors->has('nama'))
                                    <span style="color: red">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKL"
                                            value="Laki-laki"
                                            {{("Laki-laki" == $data->jenis_kelamin) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="RadioJKL">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKP"
                                            value="Perempuan"
                                            {{("Perempuan" == $data->jenis_kelamin) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="RadioJKP">Perempuan</label>
                                    </div>
                                    @if ($errors->has('jenis_kelamin'))
                                    <span style="color: red">{{ $errors->first('jenis_kelamin') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="inputUsia" name="usia"
                                        value="{{$data->usia}}">
                                    @if ($errors->has('usia'))
                                    <span style="color: red">{{ $errors->first('usia') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputTTL" name="ttl"
                                        value="{{$data->ttl}}">
                                    @if ($errors->has('ttl'))
                                    <span style="color: red">{{ $errors->first('ttl') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" id="inputAlamat" name="alamat"
                                        rows="3">{{$data->alamat}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
                                <div class="col-sm-5">
                                    <input type="tel" class="form-control" id="inputNO" name="telepon"
                                        value="{{$data->telepon}}">
                                    @if ($errors->has('telepon'))
                                    <span style="color: red">{{ $errors->first('telepon') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                                <div class="input-group col-sm-5">
                                    <select class="custom-select" id="inputPendidikan" name="pendidikan">
                                        <option value="TK" {{("TK" == $data->pendidikan) ? 'selected' : '' }}>TK
                                        </option>
                                        <option value="SD" {{("SD" == $data->pendidikan) ? 'selected' : '' }}>SD
                                        </option>
                                        <option value="SMP" {{("SMP" == $data->pendidikan) ? 'selected' : '' }}>SMP
                                        </option>
                                        <option value="SMA" {{("SMA" == $data->pendidikan) ? 'selected' : '' }}>SMA
                                        </option>
                                        <option value="S1/S2/S3"
                                            {{("S1/S2/S3" == $data->pendidikan) ? 'selected' : '' }}>S1/S2/S3</option>
                                    </select>
                                    @if ($errors->has('pendidikan'))
                                    <span style="color: red">{{ $errors->first('pendidikan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="modal" value="#btnModalEditPelaku{{$data->id_pelaku}}">
                            <div class="form-group row">
                                <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="input-group col-sm-5">
                                    <select class="custom-select" id="inputAgama" name="agama">
                                        <option value="Islam" {{("Islam" == $data->agama) ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{("Kristen" == $data->agama) ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{("Katolik" == $data->agama) ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Budha" {{("Budha" == $data->agama) ? 'selected' : '' }}>Budha
                                        </option>
                                        <option value="Hindu" {{("Hindu" == $data->agama) ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Konghucu" {{("Konghucu" == $data->agama) ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                    @if ($errors->has('agama'))
                                    <span style="color: red">{{ $errors->first('agama') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="input-group col-sm-5">
                                    <select class="custom-select" id="inputPekerjaan" name="pekerjaan">
                                        <option value="Pedagang/Tani/Nelayan"
                                            {{("Pedagang/Tani/Nelayan" == $data->pekerjaan) ? 'selected' : '' }}>
                                            Pedagang/Tani/Nelayan</option>
                                        <option value="Swasta/Buruh"
                                            {{("Swasta/Buruh" == $data->pekerjaan) ? 'selected' : '' }}>Swasta/Buruh
                                        </option>
                                        <option value="PNS/TNI/Polri"
                                            {{("PNS/TNI/Polri" == $data->pekerjaan) ? 'selected' : '' }}>PNS/TNI/Polri
                                        </option>
                                        <option value="Pelajar"
                                            {{("Pelajar" == $data->pekerjaan) ? 'selected' : '' }}>Pelajar</option>
                                        <option value="Ibu Rumah Tangga"
                                            {{("Ibu Rumah Tangga" == $data->pekerjaan) ? 'selected' : '' }}>Ibu Rumah
                                            Tangga</option>
                                        <option value="Tidak Bekerja"
                                            {{("Tidak Bekerja" == $data->pekerjaan) ? 'selected' : '' }}>Tidak Bekerja
                                        </option>
                                    </select>
                                    @if ($errors->has('pekerjaan'))
                                    <span style="color: red">{{ $errors->first('pekerjaan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-5">
                                    <select class="custom-select" id="inputStatus" name="status">
                                        <option value="Belum Menikah"
                                            {{("Belum Menikah" == $data->status) ? 'selected' : '' }}>Belum Menikah
                                        </option>
                                        <option value="Menikah" {{("Menikah" == $data->status) ? 'selected' : '' }}>
                                            Menikah</option>
                                        <option value="Duda/Janda"
                                            {{("Duda/Janda" == $data->status) ? 'selected' : '' }}>Duda/Janda</option>
                                        <option value="Sirri" {{("Sirri" == $data->status) ? 'selected' : '' }}>Sirri
                                        </option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <span style="color: red">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="difabel" id="RadioDifabelY"
                                            value="Ya" {{("Ya" == $data->difabel) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="RadioDifabelY">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="difabel" id="RadioDifabelT"
                                            value="Tidak" {{("Tidak" == $data->difabel) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="RadioDifabelT">Tidak</label>
                                    </div>
                                    @if ($errors->has('difabel'))
                                    <span style="color: red">{{ $errors->first('difabel') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputHubungan" class="col-sm-2 col-form-label">Hubungan Dengan
                                    Korban</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputHubungan"
                                        name="hubungan_dengan_korban" value="{{$data->hubungan_dengan_korban}}">
                                    @if ($errors->has('hubungan_dengan_korban'))
                                    <span style="color: red">{{ $errors->first('hubungan_dengan_korban') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary" type="submit">Update Data</button>
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
