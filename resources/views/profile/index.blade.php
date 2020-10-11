@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">SET KD</div>
@endsection
@section('content')
@php
$role = '';
if(Auth::user()->role == 1)
{
$role = 'admin';
}
elseif (Auth::user()->role == 2)
{
$role ='guru';
}
elseif (Auth::user()->role == 3)
{
$role ='piket';
}
elseif (Auth::user()->role == 4)
{
$role ='bk';
}
elseif (Auth::user()->role == 5)
{
$role ='kepala';
}
elseif (Auth::user()->role == 6)
{
$role ='siswa';
}
elseif (Auth::user()->role == 7)
{
$role ='pengawas';
}
@endphp
<div class="content">
    <div class="row">
        <form action="{{ url($role.'/sks/simpSetKD') }}" method="post">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="box box-primary col-md-6">
                    <div class="form-group ">
                        <label>Mapel</label>
                        <select class="form-control" name="mapel" required>
                            <option value="0">------</option>
                            @foreach($mapels as $mapel)
                            <option value="{{ $mapel->mapel_id }}">{{ $mapel->mapel }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('mapel')) <p class="help-block btn-danger">{{ $errors->first('mapel') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control select2" name="smt" required>
                            <option value="0">------</option>
                            @for($x = 1; $x <= 8; $x++) <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                        </select>
                        @if ($errors->has('smt')) <p class="help-block btn-danger">{{ $errors->first('smt') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Banyaknya KD/Semester</label>
                        <select class="form-control select2" name="kd" required>
                            <option value="0">------</option>
                            @for($y = 1; $y <= 20; $y++) <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                        </select>
                        @if ($errors->has('kd')) <p class="help-block btn-danger">{{ $errors->first('kd') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <div class="checkbox">
                            @foreach($kelas as $kls)
                            @if($kls->id == 11)<br>@elseif($kls->id == 21)<br>@endif
                            <label class="checkbox-inline">
                                <input type="checkbox" value="{{ $kls->id }}" name="kls[]">{{ $kls->nm_kelas }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">List Pemetaan</h3>
                </div>
                <div class="box-body">
                    <div class="box-body">
                        <table id="table_id" class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Guru Pengampu</th>
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Jumlah KD</th>
                                    <th>Ta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $no = 1; ?>
                            <tbody>
                                @foreach($pdk as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->guru->name }} {{ $p->id }}</td>
                                    <td>{{ $p->mapel->mapel }}</td>
                                    <td>{{ $p->kls->nm_kelas }}</td>
                                    <td><span class="badge bg-blue">{{ $p->smt }}</span> </td>
                                    <td>{{ $p->jumkd }}</td>
                                    <td>{{ $p->tas->tahun }} - {{ $p->tas->id }}</td>
                                    <td>
                                        <a href="{{ url($role.'/sks/dl/'.$p->id) }}"><span class="badge bg-red"><i class="fa fa-trash"></i></a></span>
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
@section('script')
<script>
    $('.select2').select2();
    $('#table_id').DataTable();
</script>
@stop
@endsection
