@extends('admin.layouts')
@section('breadcum')
    Data Upload Siswa Baru
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="box mt-5">
                <div class="box-header">
                    Upload File Siswa
                </div>
                <div class="box-body">
                    <table id="table_id" class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nun</th>
                            <th>Asal Sekolah</th>
                            <th>Data</th>
                        </thead>
                        <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->ppdb['asal_sekolah'] }}</td>
                            <td>
                                @foreach($user->koperasi as $data)
                                    <a target="_blank" href="/ppdb/{{$data->berkas}}">
                                <button class="btn btn-info">File</button>
                                    </a>
                                @endforeach
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
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection
