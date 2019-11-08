@include('header')

<body>

    <div class="container">
    <br>

        @if(session('notification'))
            <div class="alert alert-success alert-dismisable">
                <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                <strong>{{ session('notification') }}</strong>
            </div>            
        <br>            
        @endif
        <div class="card card-default">
            <div class="card-header">Pelaku</div>
            <div class="card-body">
                <form action='{{ url("kasus/edit/$idKasus/pelaku/$idPelaku") }}' method="post">
                    @csrf
                    <div class="form-group row">    
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputNama" name="nama" value="{{$pelaku->nama}}">
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
                                    value="Laki-laki" {{("Laki-laki" == $pelaku->jenis_kelamin) ? 'checked' : '' }}>
                                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="RadioJKLP"
                                    value="Perempuan" {{("Perempuan" == $pelaku->jenis_kelamin) ? 'checked' : '' }}>
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
                            <input type="number" class="form-control" id="inputUsia" name="usia" value="{{$pelaku->usia}}">
                            @if ($errors->has('usia'))
                                <span style="color: red">{{ $errors->first('usia') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTTL" name="ttl" value="{{$pelaku->ttl}}">
                            @if ($errors->has('ttl'))
                                <span style="color: red">{{ $errors->first('ttl') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputAlamat" name="alamat" rows="3">{{$pelaku->alamat}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
                        <div class="col-sm-5">
                            <input type="tel" class="form-control" id="inputNO" name="telepon" value="{{$pelaku->telepon}}">
                            @if ($errors->has('telepon'))
                                <span style="color: red">{{ $errors->first('telepon') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputPendidikan" name="pendidikan">
                                <option value="TK" {{("TK" == $pelaku->pendidikan) ? 'selected' : '' }}>TK</option>
                                <option value="SD" {{("SD" == $pelaku->pendidikan) ? 'selected' : '' }}>SD</option>
                                <option value="SMP"{{("SMP" == $pelaku->pendidikan) ? 'selected' : '' }}>SMP</option>
                                <option value="SMA"{{("SMA" == $pelaku->pendidikan) ? 'selected' : '' }}>SMA</option>
                                <option value="S1/S2/S3" {{("S1/S2/S3" == $pelaku->pendidikan) ? 'selected' : '' }}>S1/S2/S3</option> 
                            </select>
                            @if ($errors->has('pendidikan'))
                                <span style="color: red">{{ $errors->first('pendidikan') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputAgama" name="agama">
                                <option value="Islam" {{("Islam" == $pelaku->agama) ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{("Kristen" == $pelaku->agama) ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{("Katolik" == $pelaku->agama) ? 'selected' : '' }}>Katolik</option>
                                <option value="Budha" {{("Budha" == $pelaku->agama) ? 'selected' : '' }}>Budha</option>
                                <option value="Hindu" {{("Hindu" == $pelaku->agama) ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghucu" {{("Konghucu" == $pelaku->agama) ? 'selected' : '' }}>Konghucu</option>
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
                                <option value="Pedagang/Tani/Nelayan" {{("Pedagang/Tani/Nelayan" == $pelaku->pekerjaan) ? 'selected' : '' }}>Pedagang/Tani/Nelayan</option>
                                <option value="Swasta/Buruh" {{("Swasta/Buruh" == $pelaku->pekerjaan) ? 'selected' : '' }}>Swasta/Buruh</option>
                                <option value="PNS/TNI/Polri" {{("PNS/TNI/Polri" == $pelaku->pekerjaan) ? 'selected' : '' }}>PNS/TNI/Polri</option>
                                <option value="Pelajar" {{("Pelajar" == $pelaku->pekerjaan) ? 'selected' : '' }}>Pelajar</option>
                                <option value="Ibu Rumah Tangga" {{("Ibu Rumah Tangga" == $pelaku->pekerjaan) ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                <option value="Tidak Bekerja" {{("Tidak Bekerja" == $pelaku->pekerjaan) ? 'selected' : '' }}>Tidak Bekerja</option>
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
                                <option value="Belum Menikah" {{("Belum Menikah" == $pelaku->status) ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{("Menikah" == $pelaku->status) ? 'selected' : '' }}>Menikah</option>
                                <option value="Duda/Janda" {{("Duda/Janda" == $pelaku->status) ? 'selected' : '' }}>Duda/Janda</option>
                                <option value="Sirri" {{("Sirri" == $pelaku->status) ? 'selected' : '' }}>Sirri</option>
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
                                    value="Ya" {{("Ya" == $pelaku->difabel) ? 'checked' : '' }}>
                                <label class="form-check-label" for="RadioDifabelY">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="difabel" id="RadioDifabelT"
                                    value="Tidak" {{("Tidak" == $pelaku->difabel) ? 'checked' : '' }}>
                                <label class="form-check-label" for="RadioDifabelT">Tidak</label>
                            </div>
                            @if ($errors->has('difabel'))
                                <span style="color: red">{{ $errors->first('difabel') }}</span>
                            @endif
                        </div>
                    </div>                                        
                    <div class="form-group row">
                        <label for="inputHubungan" class="col-sm-2 col-form-label">Hubungan Dengan Korban</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputHubungan" name="hubungan_dengan_korban" value="{{$pelaku->hubungan_dengan_korban}}">
                            @if ($errors->has('hubungan_dengan_korban'))
                                <span style="color: red">{{ $errors->first('hubungan_dengan_korban') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button class="btn btn-primary" type="submit">Update Pelaku</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</body>

</html>
