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
            <strong>Mohon mengisi semua form dengan benar</strong>
        </div>
        @endif

        <form action="{{ url('/kasus/new') }}" method="post" id="formLapor">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="tab-content" id="pills-tabContent">
            <div class="card card-default tab-pane fade"  id="pills-kasus" role="tabpanel" aria-labelledby="pills-home-kasus">
                @include('lapor/tabKasus')
            </div>
            <div class="tab-pane fade" id="pills-pelapor" role="tabpanel" aria-labelledby="pills-pelapor-tab">
                @include('lapor/tabPelapor')
            </div>
            <div class="tab-pane fade  show active" id="pills-korban" role="tabpanel" aria-labelledby="pills-korban-tab">
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