@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<?php
$user = '';
    if(Auth::user()->role == 1)
      {
           $user = 'admin';
      }
      elseif(Auth::user()->role == 2)
      {
          $user = 'guru';
      }
      elseif(Auth::user()->role == 3)
      {
          $user = 'piket';
      }
      elseif(Auth::user()->role == 4)
      {
          $user = 'bk';
      }
      elseif(Auth::user()->role == 5)
      {
          $user = 'Kepala/wakasek';
      }
      elseif(Auth::user()->role == 6)
      {
          $user = 'siswa';
      }
      elseif(Auth::user()->role == 7)
      {
          $user = 'pengawas';
      }
?>
<form class="form" action="/{{$user}}/detail" method="post">
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
            <button class="btn btn-primary">Pilih</button>

    </div>
</form> 
@endsection
