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
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-title">Edit Nilai</h3>
    <h4>{{ $nilaiEdit->siswa->nama }}</h4>
    <h4>{{ $nilaiEdit->Ukbm->jdlKbm }}</h4>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
<form role="form" action="/{{$user}}/sks/update" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="box-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Nilai</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="nilai" value="{{ $nilaiEdit->nilai }}">
            </div>
            <input type="hidden" name="kd" value="{{ $nilaiEdit->kd }}">
            <input type="hidden" name="nis" value="{{ $nilaiEdit->nis }}">
            <input type="hidden" name="id" value="{{ $nilaiEdit->id }}">
            <input type="hidden" name="kelas_id" value="{{ $nilaiEdit->kelas_id }}">
            <input type="hidden" name="mapel_id" value="{{ $nilaiEdit->mapel_id }}">
        </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
@endsection