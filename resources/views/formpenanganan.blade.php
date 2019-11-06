@include('header')

<body>

    <div class="container">
        <br>
        <div class="card card-default">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Penanganan</div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputInstansi">
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
                        <label for="inputJenis" class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputJenis">                                
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
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <a href="#" class="btn btn-primary">Update Data</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>                
    </div>
</body>

</html>
