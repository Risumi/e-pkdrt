@include('header')
<script src="{{ asset('kecamatan.js') }}"></script>
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
                <div class="card-header">Data Kasus <button type="button" class="btn btn-secondary float-right" id="addKorban">+</button></div>
            </div>
            <div class="card-body">
                <form action="{{url('/nyoba')}}" method="post">
                    @csrf
                    <span id="formTabKorbanMain">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group row" id="formTabKorban">
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputNama" name="nama_korban[]" value="{{ old('nama_korban.*') }}">
                            @if ($errors->has('nama_korban.*'))
                                <span style="color: red">{{ $errors->first('nama_korban.*') }}</span>
                            @endif
                        </div>
                    </div>
                    </span>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</body>
</html>
<script type="text/javascript">
    $(function() {        
        $('#addKorban').click(function() {
            var $clone = $( "#formTabKorban" ).clone().appendTo( "#formTabKorbanMain" );            
        })        
    });
</script>