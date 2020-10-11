@extends('/admin/layouts')
@section('breadcum')
    Management User
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <br>
    <br>
    <div class="container mt-lg-auto">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        List User
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="table">
                        <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        </thead>
                        <tbody>
                        @php $no = 1 @endphp
                        @foreach($user as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{$data->name}}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role }}</td>
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
    <script>
        $('#table').dataTable();
    </script>
@endsection