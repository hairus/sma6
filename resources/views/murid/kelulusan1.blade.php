@extends('/admin/layouts')
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                Pengumuman Resmi SMAN 1 Sumenep
            </div>
            <hr>
            <div class="box-body">
                <h3>Selamat Ananda</h3>
                <br>
                <b>{{ Auth::user()->name }}</b>
                <br>Anda di nyatakan <br><b>LULUS</b>
                <br>
                <hr>
                <p><u><i>Silakan Melakukan Pengecekan Administrasi di Wali Kelas masing masing</i></u></p>
                <a href="{{ asset('rekap.pdf') }}">
            <button class="btn btn-info">Rekap Kelulusan Peserta Didik</button>
                </a>
            </div>
        </div>

    </div>
    </div>
@stop
