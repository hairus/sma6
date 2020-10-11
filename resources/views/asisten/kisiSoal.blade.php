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
                <h3 class="box-title">Pengecekan Kisi kisi Soal</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="dataTable">
                    <thead>
                        <th>No</th>
                        <th>User</th>
                        <th>Mapel</th>
                        <th>Download</th>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($fileKisi as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                @foreach($data->kisiSoals as $mapel)
                                    <li>{{ $mapel->mapels->mapel }}</li>
                                @endforeach
                            </td>
                            <td>
                                @foreach($data->kisiSoals as $download)
                                    <a href="{{ url('/guru/kurilukum/downFile/'.$download->id) }}">
                                        <button class="btn btn-info">{{$download->nama}}</button>
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop
