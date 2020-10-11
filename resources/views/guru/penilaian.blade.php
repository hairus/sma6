@extends('/admin/layouts')
@section('breadcum')
    Penilaian
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="body">
        <div class="box box-primary">
            <div class="box-header with-border">
                <form action="{{ route('saveSkd') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-froup">
                        <label for="">Mapel</label>
                        <select class="form-control" name="mapel">
                            @foreach ($mapel as $mapels)
                                <option value="{{ $mapels->id }}">{{ $mapels->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-froup">
                        <label for="">Semester</label>
                        <select class="form-control" name="mapel">
                            @for($x = 1; $x <= 6; $x++)
                                <option value="{{ $x }}">{{ $x}}</option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection