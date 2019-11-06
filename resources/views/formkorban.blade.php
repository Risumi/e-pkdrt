@include('header')

<body>

    <div class="container">
    <br>
        <div class="card card-default">
            <div class="card-header">Korban</div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioJK" id="RadioJKL"
                                    value="Laki-laki">
                                <label class="form-check-label" for="RadioJKL">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioJK" id="RadioJKLP"
                                    value="Perempuan">
                                <label class="form-check-label" for="RadioJKP">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputUsia" class="col-sm-2 col-form-label">Usia</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="inputUsia">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTTL" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTTL">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputAlamat" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNO" class="col-sm-2 col-form-label">No. Telp/HP</label>
                        <div class="col-sm-5">
                            <input type="tel" class="form-control" id="inputNO">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputPendidikan">
                                <option value="TK">TK</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="S1/S2/S3">S1/S2/S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAgama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputAgama">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                        <div class="input-group col-sm-5">
                            <select class="custom-select" id="inputPekerjaan">
                                <option value="Pedagang/Tani/Nelayan">Pedagang/Tani/Nelayan</option>
                                <option value="Swasta/Buruh">Swasta/Buruh</option>
                                <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option value="Pelajar">Pelajar</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputStatus">
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Duda/Janda">Duda/Janda</option>
                                <option value="Sirri">Sirri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDifabel" class="col-sm-2 col-form-label">Difabel</label>
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioDifabel" id="RadioDifabelY"
                                    value="Ya">
                                <label class="form-check-label" for="RadioDifabelY">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioDifabel" id="RadioDifabelT"
                                    value="Tidak">
                                <label class="form-check-label" for="RadioDifabelT">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKdrt" class="col-sm-2 col-form-label">KDRT</label>
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioKDRT" id="RadioKDRTY"
                                    value="Ya">
                                <label class="form-check-label" for="RadioKDRTY">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioKDRT" id="RadioKDRTT"
                                    value="Tidak">
                                <label class="form-check-label" for="RadioKDRTT">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKekerasan" class="col-sm-2 col-form-label">Tindak Kekerasan Yang Dialami
                            Korban</label>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fisik" id="checkKekerasan1">
                                <label class="form-check-label" for="checkKekerasan1">
                                    Fisik
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Psikis" id="checkKekerasan2">
                                <label class="form-check-label" for="checkKekerasan2">
                                    Psikis
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Seksual" id="checkKekerasan3">
                                <label class="form-check-label" for="checkKekerasan3">
                                    Seksual
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Penelantaran"
                                    id="checkKekerasan4">
                                <label class="form-check-label" for="checkKekerasan4">
                                    Penelantaran
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Trafficking"
                                    id="checkKekerasan5">
                                <label class="form-check-label" for="checkKekerasan5">
                                    Trafficking
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Eksploitasi"
                                    id="checkKekerasan6">
                                <label class="form-check-label" for="checkKekerasan6">
                                    Eksploitasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Lainnya" id="checkKekerasan7">
                                <label class="form-check-label" for="checkKekerasan7">
                                    Lainnya
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTrafficking" class="col-sm-2 col-form-label">Kategori Trafficking</label>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Eksploitasi Seksual"
                                    id="checkTrafficking1">
                                <label class="form-check-label" for="checkTrafficking1">
                                    Eksploitasi Seksual
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Perbudakan"
                                    id="checkTrafficking2">
                                <label class="form-check-label" for="checkTrafficking2">
                                    Perbudakan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Perdagangan Organ Tubuh"
                                    id="checkTrafficking3">
                                <label class="form-check-label" for="checkTrafficking3">
                                    Perdagangan Organ Tubuh
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Perdagangan Narkoba"
                                    id="checkTrafficking3">
                                <label class="form-check-label" for="checkTrafficking3">
                                    Perdagangan Narkoba
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <a href="#" class="btn btn-primary">Tambah data</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</body>

</html>
