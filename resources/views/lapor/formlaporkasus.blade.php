@include('header')
<script src="{{ asset('kecamatan.js') }}"></script>
<body>

    <div class="container">
        <br>
        @if(session('notification'))
        <div class="alert alert-success alert-dismisable">
            <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
            <strong>{{ session('notification') }}</strong>
        </div>
        @endif
        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismisable">
            <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
            <strong>Mohon mengisi semua form</strong>
        </div>
        @endif

        <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-kasus-tab" data-toggle="pill" href="#pills-kasus" role="tab" aria-controls="pills-kasus" aria-selected="true">Data Kasus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-pelapor-tab" data-toggle="pill" href="#pills-pelapor" role="tab" aria-controls="pills-prlapor" aria-selected="false">Identitas Pelapor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-korban-tab" data-toggle="pill" href="#pills-korban" role="tab" aria-controls="pills-korban" aria-selected="false">Data Korban</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-pelaku-tab" data-toggle="pill" href="#pills-pelaku" role="tab" aria-controls="pills-pelaku" aria-selected="false">Data Pelaku</a>
            </li>
        </ul> -->
        <form action="{{ url('/kasus/new') }}" method="post">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="tab-content" id="pills-tabContent">
            <div class="card card-default tab-pane fade show active"  id="pills-kasus" role="tabpanel" aria-labelledby="pills-home-kasus">
                @include('lapor/tabKasus')
            </div>
            <div class="tab-pane fade" id="pills-pelapor" role="tabpanel" aria-labelledby="pills-pelapor-tab">
                @include('lapor/tabPelapor')
            </div>
            <div class="tab-pane fade" id="pills-korban" role="tabpanel" aria-labelledby="pills-korban-tab">
                @include('lapor/tabKorban')
            </div>
            <div class="tab-pane fade" id="pills-pelaku" role="tabpanel" aria-labelledby="pills-pelaku-tab">
                @include('lapor/tabPelaku')
            </div>
        </div>
        <br>
        </form>
    </div>
</body>
</html>