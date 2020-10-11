@extends('/admin/layouts')
@section('breadcum')
    Profile Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="col box">
        <div class="header">
            <h3>Pelaporan Absensi Per hari</h3>
        </div>
        <hr>
    <table class="table">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Jam-Ke</th>
            <th>Keterangan</th>
            <th>Pengabsen</th>
        </thead>
        <tbody>
        @for($x = 1; $x <= 15; $x++)
        @foreach($absen->where('jam_ke', $x) as $ab)
            <tr>
                <td>{{ $x }}</td>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ $x }}</td>
                <td>{{ $ab->kondisi }}</td>
                <td>{{ $ab->user }}</td>
            </tr>
        @endforeach
        @endfor
        </tbody>
    </table>
    </div>
@endsection