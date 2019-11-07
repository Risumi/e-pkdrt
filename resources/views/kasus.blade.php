@include('header')

<body>
    <br>
    <div class="container">
        <div class="card card-default row">
            <div class="card-header">
                Kasus
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Registrasi</th>
                            <th>Hari, tanggal</th>
                            <th>Konselor</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kasus as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nomor_registrasi }}</td>
                                <td>{{ $data->hari }}</td>
                                <td>{{ $data->konselor }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td><a href='{{ url("kasus/edit/$data->id_kasus") }}'>EDIT</a>
                                </td>

                            </tr>
                        @endforeach                     
                    </tbody>
                </table>
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