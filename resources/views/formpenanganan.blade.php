@include('header')

<body>

    <div class="container">
        <br>
        <div class="card card-default">
            @if(session('notification'))
                <div class="alert alert-success alert-dismisable">
                    <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                    <strong>{{ session('notification') }}</strong>
                </div>     
            @endif
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Penanganan</div>
            </div>
            <div class="card-body">
                <form action='{{ url("kasus/edit/$idKasus/pelaku/$idPelaku/penanganan/new") }}' method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputInstansi" name="instansi">
                                <option value="Bapas">Bapas</option>
                                <option value="Dinas Kesehatan">Dinas Kesehatan</option>
                                <option value="UPPA Polresta">UPPA Polresta</option>
                                <option value="RSUD">RSUD</option>
                                <option value="LPA">LPA</option>
                                <option value="WCC Dian Mutiara">WCC Dian Mutiara</option>
                                <option value="DSP3AP2KB">DSP3AP2KB</option>
                                <option value="RSSA">RSSA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputJenis" class="col-sm-2 col-form-label">Jenis Proses</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputJenis" name="jenis_proses">                                
                                <option value="Pemeriksaan">Pemeriksaan</option>
                                <option value="Penyelidikan">Penyelidikan</option>
                                <option value="Penyidikan">Penyidikan</option>
                                <option value="Penangkapan">Penangkapan</option>
                                <option value="Peninjauan Kembali">Peninjauan Kembali</option>
                                <option value="Penahanan">Penahanan</option>
                                <option value="Pengeledahan">Pengeledahan</option>
                                <option value="Penyitaan">Penyitaan</option>
                                <option value="Pra Penuntutan Kasasi">Pra Penuntutan Kasasi</option>
                                <option value="Diversi">Diversi</option>
                                <option value="Penuntutan">Penuntutan</option>
                                <option value="Pengadilan TK I">Pengadilan TK I</option>
                                <option value="Pengadilan TK II">Pengadilan TK II</option>
                                <option value="Kasasi">Kasasi</option>
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Proses</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" name="deskripsi_proses" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary">Tambah Penanganan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>                
    </div>
</body>

</html>
