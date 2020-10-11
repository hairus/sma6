@extends('/admin/layouts')
@section('breadcum')
View Set KD
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="box">
        <div class="box-header">
            <div class="title">View Set Kd</div>
        </div>
        <div class="box-body">
            <table class="table table-hover" id="table">
                <thead>
                    <th>No</th>
                    <th>Guru</th>
                    <th>Mapel</th>
                    <th>Kelas</th>
                    <th>KD</th>
                    <th>ta</th>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pkd as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->guru->name }}</td>
                        <td>{{ $data->mapel->mapel }}</td>
                        <td>{{ $data->kls->nm_kelas }}</td>
                        <td>{{ $data->jumkd }}</td>
                        <td>{{ $data->tas->tahun }} - {{ $data->ta_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#table').dataTable();
</script>
@endsection
