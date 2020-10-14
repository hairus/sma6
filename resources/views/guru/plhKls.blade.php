@extends('admin.layouts')
@section('breadcum')
Upload Nilai
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<br>
<br>
<div class="container">
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">
                Pilih Kelas
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('guru/plhKls') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Pilih kelas</label>
                    <select name="kelas_id" id="" class="form-control" required>
                        <option value="">---</option>
                        @foreach ($kelas as $data)
                        <option value="{{ $data->id }}">{{ $data->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">pilih</button>
            </form>
        </div>
    </div>
</div>
@endsection
