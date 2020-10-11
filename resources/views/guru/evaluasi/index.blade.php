@extends('/admin/layouts')
@section('breadcum')
    Evaluasi
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <form action="{{ url('guru/eva/mapels')  }}" method="post">
        @csrf
            <div class="form-group">
                <label for="">Pilih Mapel</label>
                <select name="mapel_id" id="" class="form-control">
                    @foreach($evas as $data)
                    <option value="{{ $data->mapel_id }}">{{ $data->mapels->mapel }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-info" type="submit">Pilih</button>
        </form>
    </div>
@endsection
