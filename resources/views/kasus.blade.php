@include('header')

<body>
    <br>
    <div class="container">
        <div class="card card-default row">
            <div class="card-header">
                Kasus
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <a href="{{route('kasusEdit', ['id' => 1])}}" class="btn btn-info">Kasus 1</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm">
                        <a href="{{route('kasusBaru')}}" class="btn btn-primary">Tambah Data</a>
                        <a href="#" class="btn btn-secondary">Cari Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
