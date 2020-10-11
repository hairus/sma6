@extends('/admin/layouts')
@section('breadcum')
PJJ
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-title">
                                Aktifitas
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="{{url('guru/imateri')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Pilih Mapel</label>
                                    <select name="mapel_id" id="" class="form-control" required>
                                        @foreach($guru_mapels as $data)
                                        <option value="{{ $data->mapel_id }}" {{ old('mapel_id') == "$data->mapel_id" ? 'selected' : '' }}>
                                            {{ $data->mapels->mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Kelas</label>
                                    <select name="kelas_id" id="kelas" class="form-control" multiple required>
                                        @foreach($kelas as $data)
                                        <option value="{{ $data->id }}" {{ old('kelas_id') == "$data->id" ? 'selected' : '' }}>
                                            {{ $data->nm_kelas  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Aksi</label>
                                    <select name="deskripsi" class="form-control" required>
                                        <option value="">---</option>
                                        <option value="tugas" {{ old('deskripsi') == "tugas" ? 'selected' : '' }}>Tugas
                                        </option>
                                        <option value="materi" {{ old('deskripsi') == "materi" ? 'selected' : '' }}>
                                            Materi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="tanggal" value="{{ old('tanggal') }}" id="datepicker">
                                    </div>
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Mulai</label>
                                        <div class="input-group">
                                            <input type="text" name="start" class="form-control timepicker" required>

                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Terahir</label>

                                        <div class="input-group">
                                            <input type="text" name="end" class="form-control timepicker" required>

                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <button class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-title">
                                Aksi
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mapel</th>
                                                <th>Deskripsi</th>
                                                <th>Kelas</th>
                                                <th>tanggal</th>
                                                <th>start</th>
                                                <th>end</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        @php $no = 1; @endphp
                                        <tbody>
                                            @foreach($materis as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->mapels->mapel }}</td>
                                                <td>{{ $data->deskripsi }}</td>
                                                <td>{{ $data->kelas->nm_kelas }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->start }}</td>
                                                <td>{{ $data->end }}</td>
                                                <td>
                                                    <a href="{{ url('guru/mi/'.$data->id.'/del') }}">
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
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-title">
                                Report Harian (pusing masih belu nemmu logika)
                            </div>
                        </div>
                        <div class="box-body">
                            <pjj></pjj>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-title">
                                Disini Tempat total
                            </div>
                        </div>
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
        $('#kelas').select2();
        $("#list").DataTable();
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('#reservation').daterangepicker();
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'YYYY-MM-DD h:mm A'
        });
        $(".timepicker").timepicker({
            showInputs: false,
            showMeridian: false
        });

    });
</script>
@stop
