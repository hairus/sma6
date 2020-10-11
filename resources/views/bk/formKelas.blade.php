@extends('/admin/layouts')
@section('breadcum')
  Absen
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
<div class="row">
    <div class="col-md-6">
            <!-- Application buttons -->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Kelas sks</h3>
              </div>
              <div class="box-body">
                @foreach($bk as $kls)
                <a href="/{{$user}}/sks/showKelasSks/{{$kls->kelas_id}}">
                  <span class="btn btn-app">
                    <i class="fa fa-group"></i> {{$kls->kelas->nm_kelas}}
                  </span>
                </a>
                @endforeach
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Various colors -->
    </div>
</div>
@endsection