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
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Rujukan</div>
            </div>
            <div class="card-body">
                <form action='{{ url("kasus/edit/$idKasus/korban/$idKorban/rujukan/new") }}' method="post">
                @csrf               
                    <div class="form-group row">
                        <label for="inputTglRujukan" class="col-sm-2 col-form-label">Tanggal Rujukan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRujukan" name="tanggal_rujukan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKota" class="col-sm-2 col-form-label">Kota/Kab, Provinsi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKota" name="kota">
                        </div>
                    </div>
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
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="inputDeskripsi" name="deskripsi_rujukan" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
