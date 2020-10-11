@extends('/admin/layouts')
@section('breadcum')
    Set Guru Ukbm
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box box-info col-md-6">
        <div class="box-header with-border">
            <h3 class="box-title">General Elements</h3>
        </div>
        <div class="row">
            <div class="box-body">
                <form role="form" action="{{ route('simpGU') }}" method="post">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Pilih Guru</label>
                        <select class="form-control" name="guru_id">
                            @foreach ($guru as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Guru acuan</label>
                        <select class="form-control" name="guru_id2">
                            @foreach ($guru as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Mapel</label>
                        <select class="form-control" name="mapel_id">
                            @foreach($mapel as $data)
                            <option value="{{ $data->id }}">{{ $data->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"> simpan </button>
                </form>
            </div>
        </div>
    </div>
@endsection