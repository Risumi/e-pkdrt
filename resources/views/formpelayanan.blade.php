@include('header')

<body>

    <div class="container">
        <br>
        <div class="card card-default">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Layanan</div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputInstansi" class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-5">
                            <select class="custom-select" id="inputInstansi" name="inputInstansi">
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
                        <label for="inputPelayanan" class="col-sm-2 col-form-label">Pelayanan yang Diberikan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputPelayanan" name="inputPelayanan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDetail" class="col-sm-2 col-form-label">Detail Pelayanan</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDetail" name="inputDetail" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Pelayanan</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" name="inputDeskripsi" rows="3"></textarea>
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
        <br>
    </div>
</body>

</html>
