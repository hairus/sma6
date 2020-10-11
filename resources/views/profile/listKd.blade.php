@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">SHOW MAPPING KD</div>
@endsection
@section('content')
    <table class="table table-bordered" id="table_id">
        <thead>
            <tr>
                <th>NO</th>
                <th>MAPEL</th>
                <th>JUMLAH KD</th>
                <th>GURU</th>
                <th>KELAS</th>
                <th>SMT</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach ($lists as $list)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $list->mapel->mapel }}</td>
                <td>{{ $list->jumkd }}</td>
                <td>{{ $list->guru->name }}</td>
                <td>{{ $list->kls->nm_kelas }}</td>
                <td>{{ $list->smt }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@section('script')
    <script>
        $('#table_id').DataTable();
    </script>
@stop
@endsection
