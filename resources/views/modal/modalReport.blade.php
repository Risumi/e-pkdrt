<!-- Modal -->
</style>
<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modalReportTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-default">
                    @if(session('notification'))
                    <div class="alert alert-success alert-dismisable">
                        <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                        <strong>{{ session('notification') }}</strong>
                    </div>
                    @endif
                    <div class="card-header">Report</div>
                    <div class="card-body">
                        <form action='{{ url("report") }}' method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="inputJenis" class="col-sm-3 col-form-label">Jenis Report</label>
                                <div class="col-sm-7">
                                    <select class="custom-select" id="inputJenis" name="jenis_report">
                                        <option value="Ciri Korban & Pelaku">Ciri Korban & Pelaku</option>
                                        <option value="Bentuk Kekerasan, Tempat Kejadian & Pelayanan">Bentuk Kekerasan,
                                            Tempat Kejadian & Pelayanan</option>
                                        <option value="Kasus & Korban Anak/Dewasa Terlayani">Kasus & Korban Anak/Dewasa
                                            Terlayani</option>
                                        <option value="Kasus & Korban Laki-Laki/Perempuan Terlayani">Kasus & Korban
                                            Laki-Laki/Perempuan Terlayani</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Periode Laporan</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="periode_kasus"
                                            id="RadioPeriodeTgl" value="Tanggal Kasus">
                                        <label class="form-check-label" for="RadioPeriodeTgl">Tanggal Kasus</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputTgl1" name="tgl1">
                                </div>
                                <label class="col-sm-1 col-form-label">s/d</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputTgl2" name="tgl2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="periode_kasus"
                                            id="RadioPeriodeTri" value="Triwulan">
                                        <label class="form-check-label" for="RadioPeriodeTri">Triwulan</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="inputTri1" name="triwulan1">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <label class="col-sm-1 col-form-label">s/d</label>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="inputTri2" name="triwulan2">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="inputTriThn" name="triwulan_tahun" value="2019">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="periode_kasus"
                                            id="RadioPeriodeSem" value="Semester">
                                        <label class="form-check-label" for="RadioPeriodeSem">Semester</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="inputSmt1" name="semester1">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <label class="col-sm-1 col-form-label">s/d</label>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="inputSmt2" name="semester2">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="inputSmtThn" name="semester_tahun" value="2019">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputJK" class="col-sm-3 col-form-label">Jenis Kelamin Korban</label>
                                <div class="col-sm-7">
                                    <select class="custom-select" id="inputJK" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUsia" class="col-sm-3 col-form-label">Status Usia Korban</label>
                                <div class="col-sm-7">
                                    <select class="custom-select" id="inputUsia" name="status_usia">
                                        <option value="">Pilih Status Usia</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Dewasa">Dewasa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputKecamatanFilter" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-7">
                                    <select class="form-control custom-select" id="inputKecamatanFilter" name="kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                        <option value="LOWOKWARU">LOWOKWARU</option>
                                        <option value="BLIMBING">BLIMBING</option>
                                        <option value="KLOJEN">KLOJEN</option>
                                        <option value="SUKUN">SUKUN</option>
                                        <option value="KEDUNGKANDANG">KEDUNGKANDANG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
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
