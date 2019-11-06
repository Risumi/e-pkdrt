@include('header')

<body>

    <div class="container">
        <div class="card card-default">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Data Kasus</div>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card card-default">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Data Korban</div>
            </div>
            <div class="card-body">
                <a href="{{route('korbanBaru')}}" class="btn btn-primary">Tambah Korban</a>
            </div>
        </div>
        <div class="card card-default">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Data Pelaku</div>
            </div>
            <div class="card-body">
                <a href="{{route('pelakuBaru')}}" class="btn btn-primary">Tambah Pelaku</a>
            </div>
        </div>
    </div>
</body>

</html>
