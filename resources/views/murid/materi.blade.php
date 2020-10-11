@extends('/admin/layouts')
@section('breadcum')
Materi Pembelajaran
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="containter">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="box-title">
                            Mapel
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mapel</th>
                                        <th>Banyaknya Materi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($mapels as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="{{ url('siswa/mm/'.$data->mapel_id) }}">
                                                <span class="badge bg-orange">
                                                    {{ $data->mapel->mapel }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            @if($data->materis->count() > 0)
                                            <span class="badge bg-red">{{ $data->materis->count() }}</span>
                                            @else
                                            <span class="badge bg-blue">{{ $data->materis->count() }}</span>
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
        </div>
    </div>
</div>

@endsection
