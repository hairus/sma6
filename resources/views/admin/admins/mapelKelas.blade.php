@extends('/admin/layouts')
@section('breadcum')
Setting Mapel Kelas
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title">
                        Input Mapel Ke Kelas
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ url('admin/saveMapelKelas')}}" class="form" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Pilih Kelas</label>
                            <select name="kelas_id" id="" class="form-control select">
                                @foreach($kelas as $data)
                                <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Mapel</label>
                            <select name="mapel_id[]" id="" class="form-control select" multiple>
                                @foreach($mapels as $data)
                                <option value="{{ $data->id }}">{{ $data->mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-sm btn-success">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title">
                        Mapel Kelas
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="list">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            @php $no =1; @endphp
                            <tbody>
                                @foreach($mapel_kelas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kelas->nm_kelas}}</td>
                                    <td>{{ $data->mapels->mapel }}</td>
                                    <td>
                                        <a href="{{ url('admin/delMapelKelas/'.$data->id)}}">
                                            <button onclick="return confirm(' Anda Yakin Menghapus?');" class="btn btn-sm btn-danger">Delete</button>
                                        </a>
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
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select').select2();
        $("#list").DataTable();
    });
</script>
@stop
