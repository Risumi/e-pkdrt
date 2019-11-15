@include('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<body>
    <br>
    <div class="container">
        <div class="card card-default row">
            <div class="card-header">
                Kasus
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="tabel-data">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Action</th>
                            <th>No. Registrasi</th>
                            <th>Hari, tanggal</th>
                            <th>Konselor</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kasus as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href='{{ url("kasus/$data->id_kasus/print") }}' class='btn btn-sm btn-success'><i
                                        class="fa fa-print" aria-hidden="true"></i></a>
                            <a href='{{ url("kasus/edit/$data->id_kasus") }}' class='btn btn-sm btn-info'><i
                                        class="fa fa-gg" aria-hidden="true"></i></a> 
                                        </td>
                            <td>{{ $data->nomor_registrasi }}</td>
                            <td>{{ $data->hari }}</td>
                            <td>{{ $data->konselor }}</td>
                            <td>{{ $data->deskripsi }}</td>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    $(document).ready(function () {
                        $('#tabel-data').DataTable();
                    });

                </script>

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
