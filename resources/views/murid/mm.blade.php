@extends('/admin/layouts')
@section('breadcum')
Nis
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <div class="box-title">
                        Aktifitas
                    </div>
                </div>
                <div class="box-body">
                    <a href="{{ url('siswa/materi') }}">
                        <button class="btn btn-sm btn-info">Kembali</button>
                    </a>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Mapel</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>#</th>
                                    <th>Mengumpulkan</th>
                                </tr>
                            </thead>
                            @php
                            $no = 1;
                            $wkt_skr = date('H:i:s');
                            @endphp
                            <tbody>
                                @foreach($imateris as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->mapels->mapel }}</td>
                                    <td>{{ $data->start }}</td>
                                    <td>{{ $data->end }}</td>
                                    <td>

                                        {{--  logika dsini untuk download  --}}
                                        @php
                                        $wkt_skr = strtotime(date('H:i:s'));
                                        $start = strtotime($data->start);
                                        $end = strtotime($data->end);
                                        @endphp

                                        @if( $wkt_skr > $start )
                                        <form action="{{ url('/siswa/download') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="materi_id" value="{{ $data->id }}">
                                            <button class="btn btn-sm btn-success">Download</button>
                                        </form>
                                        @else
                                        <span class="badge bg-purple">waktu belum memenuhi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $wkt_skr > $start )
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        @else
                                        <span class="badge bg-purple">waktu belum memenuhi</span>
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
@endsection
