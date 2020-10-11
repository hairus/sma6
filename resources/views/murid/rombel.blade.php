@extends('/admin/layouts')
@section('breadcum')
Siswa Kelas
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box box-danger">
            <div class="box-header">
                List Siswa
            </div>
            <div class="box-body">
                <table class="table">
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    @php
                    $no =1;
                    @endphp
                    @foreach($kls as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->users->nis }}</td>
                        <td><span class="badge bg-blue">{{ strtoupper($data->users->name) }}</span></td>
                        <td><span class="badge bg-red">{{ $data->kelas->nm_kelas }}</span></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop
