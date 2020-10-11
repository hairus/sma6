@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Cek Profile Siswa</div>
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Profile Siswa Per Kelas</h3>
                </div>
                <form action="{{ route('hitung') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Mapel</label>
                            <select name="mapel_id" id="kls" class="form-control" required>
                                <option value="">-----</option>
                                @foreach ($gms as $data)
                                <option value="{{ $data->mapel_id }}"> {{ $data->mapels->mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select name="kls" id="kls" class="form-control" required>
                                <option value="">-----</option>
                                @foreach ($pkd as $kls)
                                <option value="{{ $kls->kelas_id }}"> {{ $kls->kls->nm_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Smt</label>
                            <select name="smt" id="smt" class="form-control" required>
                                <option value="0">-----</option>
                                @for($x = 1; $x <= 6; $x++) <option value="{{ $x }}"> {{ $x }}</option>
                                    @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
