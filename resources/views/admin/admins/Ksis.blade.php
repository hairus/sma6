@extends('/admin/layouts')
@section('breadcum')
Detail kelas
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                Detail Kelas
            </div>
            <div class="box-body">
                <div class="form-group">
                    <a class="pull-left" href="{{ url('admin/role99')}}">
                        <button class="btn btn-sm btn-success margin">kembali</button>
                    </a>
                    <a href="{{ url('admin/downloadSiswa/'.$kls->id)}}" class="pull-left">
                        <button class="btn btn-sm btn-success margin">Download Excel</button>
                    </a>
                </div>
                <br>
                <form action="{{ url('admin/updateNis')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Update Nis</label>
                        <input type="file" name="file" id="" class="form-control" required>
                    </div>
                    <button class="btn btn-sm btn-success">update</button>
                </form>
                <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nun</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody>
                        @foreach($kelas_siswa as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->users->nis }}</td>
                            <td>{{ $data->users->username }}</td>
                            <td>{{ strtoupper($data->users->name) }}</td>
                            <td>{{ $data->kelas->nm_kelas }}</td>
                            <td>
                                <a href="{{ url('admin/del/ksis/'.$data->id )}}">
                                    <button class="btn btn-danger"><span class="fa fa-sign-out"></span> Keluarkan Siswa</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
