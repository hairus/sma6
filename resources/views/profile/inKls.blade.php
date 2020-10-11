@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">Kelas</div>
@endsection
@section('content')
    @php
        $role = '';
      if(Auth::user()->role == 1)
          {
              $role = 'admin';
          }
          elseif (Auth::user()->role == 2)
          {
            $role ='guru';
          }
          elseif (Auth::user()->role == 3)
          {
            $role ='piket';
          }
          elseif (Auth::user()->role == 4)
          {
            $role ='bk';
          }
          elseif (Auth::user()->role == 5)
          {
            $role ='kepala';
          }
          elseif (Auth::user()->role == 6)
          {
            $role ='siswa';
          }
          elseif (Auth::user()->role == 7)
          {
            $role ='pengawas';
          }
    @endphp
    <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Kelas Ajar</h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                @foreach($kelasGuru as $kelas)
                                    <a href="/{{$role}}/sks/mycourse/{{ $kelas->kelas_id }}">
                                        <span class="btn btn-app">
                                            <span class="badge bg-purple"></span>
                                            <i class="fa fa-users"></i> {{ $kelas->kls->nm_kelas }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection