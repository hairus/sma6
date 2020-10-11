@extends('/admin/layouts')
@section('breadcum')
Absen
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<?php
$user = '';
if (Auth::user()->role == 1) {
    $user = 'admin';
} elseif (Auth::user()->role == 2) {
    $user = 'guru';
} elseif (Auth::user()->role == 3) {
    $user = 'piket';
} elseif (Auth::user()->role == 4) {
    $user = 'bk';
} elseif (Auth::user()->role == 5) {
    $user = 'Kepala/wakasek';
} elseif (Auth::user()->role == 6) {
    $user = 'siswa';
} elseif (Auth::user()->role == 7) {
    $user = 'pengawas';
}

$no = 1;
?>
<div class="container">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Delete Jam Jika ada kesalahan input jam pada tanggal {{ date('d-m-Y') }}</h3>
        </div>

        <div class="box-body no-padding table-responsive">
            <table class="table table-condensed">
                <thead>
                    <th>No</th>
                    <th>Guru Pengajar</th>
                    <th>Kelas</th>
                    <th>Jam</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($absSaya as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->user }}</td>
                        <td>{{ $data->Kelass->nm_kelas }}</td>
                        <td>{{ $data->jam_ke }}</td>
                        <td>
                            <a href="{{ '/guru/absen/delJam/'.$data->jam_ke }}">
                                <button class="btn btn-danger delete" value="{{ $data->jam_ke }}">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-header -->
    </div>
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">History Absensi hari ini tanggal {{ date('d-m-Y') }}</h3>
        </div>
        <div class="box-body no-padding table-responsive">
            <table class="table table-condensed" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nisn</th>
                        <th>Kelas</th>
                        <th>Jam Ke</th>
                        <th>Pengabsen</th>
                        <th>Keterangan</th>
                        <th>Catatan</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absens as $data1)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{$data1->users->name }}</td>
                        <td>{{$data1->users->nis }}</td>
                        <td>{{$data1->Kelass->nm_kelas}}</td>
                        <td>{{$data1->jam_ke}}</td>
                        <td>{{$data1->user}}</td>
                        <td>{{$data1->kondisi}}</td>
                        <td>{{$data1->ket}}</td>
                        <td>{{$data1->created_at}}</td>
                        <td><a href="/{{$user}}/edit/{{$data1->id}}"><button class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.box-body -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.delete').click(function(e) {
            if (!confirm('Apakah anda yakin menghapus Absen?'))
                event.preventDefault();
        });
    });
</script>
@stop
