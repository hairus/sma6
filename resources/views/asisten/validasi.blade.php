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
            <form action="{{ url('/guru/asisten/validasi') }}" method="post">
                @csrf
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <th>No</th>
                        <th>Kd</th>
                        <th>Soal</th>
                        <th>a</th>
                        <th>b</th>
                        <th>c</th>
                        <th>d</th>
                        <th>e</th>
                        <th>jawab</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($soal as $data)
                    {{-- jika flag sudah di nilai --}}
                    @if($data->flag == 1)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->kd->kd }}</td>
                            <td>{!! $data->soal !!}</td>
                            <td>{!! $data->a !!}</td>
                            <td>{!! $data->b !!}</td>
                            <td>{!! $data->c !!}</td>
                            <td>{!! $data->d !!}</td>
                            <td>{!! $data->e !!}</td>
                            <td>{!! $data->jawab !!}</td>
                            <td>
                                <input type="hidden" name="guru_id" value="{{ $data->guru_id }}">
                                <input type="hidden" name="mapel_id" value="{{ $data->mapel_id }}">
                                <input type="hidden" name="soal_id{{$data->id}}" id="soal_id" value="{{ $data->id }}">
                                <select name="valid{{$data->id}}" required>
                                    <option value="">---</option>
                                    @if($data->valid == 0)
                                    <option value="0" selected>tidak valid</option>
                                    <option value="1">valid</option>
                                    @else
                                    <option value="0">tidak valid</option>
                                    <option value="1" selected>valid</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                    @else
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->kd->kd }}</td>
                        <td>{!! $data->soal !!}</td>
                        <td>{!! $data->a !!}</td>
                        <td>{!! $data->b !!}</td>
                        <td>{!! $data->c !!}</td>
                        <td>{!! $data->d !!}</td>
                        <td>{!! $data->e !!}</td>
                        <td>{!! $data->jawab !!}</td>
                        <td>
                            <input type="hidden" name="guru_id" value="{{ $data->guru_id }}">
                            <input type="hidden" name="mapel_id" value="{{ $data->mapel_id }}">
                            <input type="hidden" name="soal_id{{$data->id}}" id="soal_id" value="{{ $data->id }}">
                            <select name="valid{{$data->id}}" required>
                                <option value="">---</option>
                                <option value="0">tidak valid</option>
                                <option value="1">valid</option>
                            </select>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody></table>
            </div>
                <button class="btn btn-info" type="submit">Simpan</button>
            </form>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop
