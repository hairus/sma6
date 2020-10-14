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
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <div class="box-title">
                    List User semua
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" id="table">
                    <thead>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Kelas</th>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach($user as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nis }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                            <td>
                                @if(isset($data->kelas))
                                {{ $data->kelas->kelas }}
                                @else
                                -
                                @endif
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
<script>
    $('#table').dataTable();
</script>
@endsection
