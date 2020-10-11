@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Export / Import Data</div>
@endsection
@section('content')
<div class="col-md-6">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">EXPORT/IMPOR DATA</h3>
        </div>
        <div class="box-body">
            @if(Auth::user()->role == 1)
            <form action="{{ route('exp') }}" method="post">
                @elseif(Auth::user()->role == 2)
                <form action="{{ route('exp1') }}" method="post">
                    @endif
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Mapel</label>
                        <select name="mapel_id" id="" class="form-control" required>
                            <option value="">-----------</option>
                            @foreach ($gm as $data)
                            <option value="{{ $data->mapel_id }}">{{ $data->mapels->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="kelas" id="" class="form-control" required>
                            <option value="0">-----------</option>
                            @foreach ($kelas as $kls)
                            <option value="{{ $kls->kelas_id }}">{{ $kls->kls->nm_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="smt" id="" class="form-control">
                            @for($x = 1; $x <= 6; $x++) <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Export</label>
                        <a href=""><button class="btn btn-success form-control"><span class="fa fa-download"></span></button></a>
                    </div>
                </form>
                @if(Auth::user()->role == 1)
                <form action="{{ route('impExcel') }}" enctype="multipart/form-data" method="post">
                    @elseif(Auth::user()->role == 2)
                    <form action="{{ route('impExcel1') }}" enctype="multipart/form-data" method="post">
                        @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Import</label>
                            <input type="file" class="form-control" name="import_file">
                        </div>
                        <input type="submit" name="simpan" class="btn btn-primary">
                    </form>
        </div>
    </div>
</div>
@endsection
