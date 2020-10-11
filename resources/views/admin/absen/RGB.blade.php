@extends('/admin/layouts')
@section('breadcum')
    Rekap Guru Bulanan
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <h1>Rekap Guru yang menggunakan absen dengan SIDEMIT di bulan  {{date('m')}}</h1>
    <div class="box-body no-padding table-responsive">
    <table class="table table-condensed">
        <tbody><tr>
            <th>#</th>
            <th>Nama</th>
            <th>Jumlah</th>
        </tr>
        <?php
        $no = 1;
        ?>
        @foreach ($rekaps as $rekap)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$rekap->user}}</td>
                <td>{{$rekap->jumlah}}</td>
            </tr>
        @endforeach
        </tbody></table>
    </div>
@endsection