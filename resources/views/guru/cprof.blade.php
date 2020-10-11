@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Cetak Profile Siswa</div>
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Semester {{ $smt }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body with-border">
                <table class="table table-borderer table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Progress</th>
                    </thead>
                    @php $no = 1; @endphp
                    @foreach($siswa as $data)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->users->name }}</td>
                            <td>{{ $data->kelas->nm_kelas }}</td>
                            <td>
                                <a href="{{ url('guru/cetak/'.$smt.'/'.$data->nis) }}" target="_blank">
                                    <div class="btn btn-success"><i class="fa fa-print"></i></div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection
