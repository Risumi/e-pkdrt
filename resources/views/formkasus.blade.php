@include('header')

<body>
    <div class="container">
        <br>
        <div class="card card-default">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Data Kasus</div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputRegistrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputRegistrasi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTglRegist" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputTglRegist">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputKonselor" class="col-sm-2 col-form-label">Konselor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputKonselor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
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
        <br>
        <div class="card card-default">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Data Korban</div>
            </div>
            <div class="card-body">
                <div class="col-sm">
                    <a href="{{route('korbanEdit',['idKasus' => $idKasus,'idKorban' => 1])}}" class="btn btn-dark">Korban 1</a>
                    <a href="{{route('pelayananBaru',['idKasus' => $idKasus,'idKorban' => 1])}}" class="btn btn-info">Layanan</a>
                    <a href="{{route('rujukanBaru',['idKasus' => $idKasus,'idKorban' => 1])}}" class="btn btn-secondary">Rujukan</a>
                </div>
                <br>
                <div class="col-sm">
                    <a href="{{route('korbanBaru',['idKasus' => $idKasus])}}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>
        <br>
        <div class="card card-default">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Data Pelaku</div>
            </div>
            <div class="card-body">
                <div class="col-sm">
                    <a href="{{route('pelakuEdit',['idKasus' => $idKasus,'idPelaku' => 1])}}" class="btn btn-info">Pelaku 1</a>
                    <a href="{{route('penangananBaru',['idKasus' => $idKasus,'idPelaku' => 1])}}" class="btn btn-light">Penanganan</a>
                </div>
                <br>
                <div class="col-sm">
                    <a href="{{route('pelakuBaru',['idKasus' => $idKasus])}}" class="btn btn-secondary">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
