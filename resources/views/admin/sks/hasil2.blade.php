@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="alert alert-warning">
            <h4>Mohon Perhatian !!!</h4>
            <h4>Bapak Ibu Pengajar Proses ini akan memakan waktu</h4>
        </div>
<form class="form" action="{{ route('olah') }}" method="post">
    {{ csrf_field() }}
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
            <div class="form-group">
                <label>Pilih Kelas</label>
                    <select class="form-control" name="kelas">Pilih Kelas
                        <option>Kelas</option>
                        @foreach($kelas as $kelass)
                        <option value="{{ $kelass->id }}">{{ $kelass->nm_kelas }}</option>
                        @endforeach
                    </select>
            </div>
             <div class="form-group">
                <label>Pilih Semester</label>
                    <select class="form-control" name="semester">Pilih Semester
                        <option>Pilih Semester</option>
                        @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->smt }}</option>
                        @endforeach
                    </select>
            </div>
        <input type="hidden" name="guru_id" value="{{ Auth::user()->id }}">
            <button class="btn btn-danger">Proses</button>

    </div>
</form>
    </div>
@endsection
