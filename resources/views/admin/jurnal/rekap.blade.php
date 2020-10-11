@extends('admin.layouts')
@section('breadcum')
    Rekap Jurnal
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                Riwayat Jurnal Per kelas
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding table-responsive">
            <table class="table table-condensed">
                <tbody><tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam Ke</th>
                    <th>Mapel</th>
                    <th>Ki/kd</th>
                    <th>Materi</th>
                    <th>Obs Siswa</th>
                    <th>Tindakan</th>
                    <th>Waktu</th>
                </tr>
                <?php $no = 1;?>
                @foreach($jurnals as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->user }}</td>
                    <td>{{ $data->kelas }}</td>
                    <td>{{ $data->hari }}</td>
                    <td>{{ $data->jam_ke }}</td>
                    <td>{{ $data->mapels->mapel }}</td>
                    <td>{{ $data->kikd_ke }}</td>
                    <td>{{ $data->materi }}</td>
                    <td>{{ $data->siswa }}</td>
                    <td>{{ $data->tindakan }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection