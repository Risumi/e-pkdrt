@include('header')

<body>

    <div class="container">
        <br>
        <div class="card card-default">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Rujukan</div>
            </div>
            <div class="card-body">
                <form>                    
                    <div class="form-group row">
                        <label for="inputTglRujukan" class="col-sm-2 col-form-label">Tanggal Rujukan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRujukan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKota" class="col-sm-2 col-form-label">Kota/Kab, Provinsi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKota">
                        </div>
                    </div>
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
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <a href="#" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
