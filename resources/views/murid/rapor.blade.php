@extends('/admin/layouts')
@section('breadcum')
    Download Rapor Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="section">
        <div class="row col-md-12">
            <div class="box">
                <div class="box-header">
                    Download Rapor
                </div>
                <div class="box-body">
                    @if(isset($rapor))

                    <a href="/smansa/public/file_rapor/{{ $rapor->rapor }}">
                        <button class="btn btn-primary">Klik Untuk Mendownload Rapor</button>
                    </a>
                    @else
                        <h3>Maaf anda mendapat kan PKPD karena ada beberapa mapel yang tidak tuntas Atau Silakan Menghubungi Walinya</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
