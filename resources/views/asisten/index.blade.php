@extends('/admin/layouts')
@section('breadcum')
    Asisten Kurikulum
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pengecekan Soal yang telah di input</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="dataTable">
                    <thead>
                        <th>No</th>
                        <th>User</th>
                        <th>Mapel</th>
                        <th>Jumlah Soal</th>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($jumSoal as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            @if($data->guruMapel->count() == 1)
                                {{ $data->guruMapel[0]['mapel'] }}
                            @else
                                @foreach($data->guruMapel as $mapel)
                                    <li>{{ $mapel->mapel }}</li>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $data->soals_count }}</td>
                    </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop
