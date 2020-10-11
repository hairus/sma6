@extends('admin.layouts')
@section('breadcum')
    Siswa tidak input nilai
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    siswa nilai tidak lengkap sip
                </div>
                <div class="box-body">
                    <table id="table_id" class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nun</th>
                            <th>Jumlah nilai</th>
                        </thead>
                        <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($user as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->username }}</td>
                            <td>
                                @php
                                $count = \App\Models\angket_nilai::where('user_id', $data->id)->count();
                                @endphp
                                {{ $count }}
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
