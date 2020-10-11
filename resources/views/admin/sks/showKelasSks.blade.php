@extends('/admin/layouts')
@section('breadcum')
    Kelas SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
            <!-- Application buttons -->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Kelas sks</h3>
              </div>
              <div class="box-body">
                @foreach($kelas as $kls)
                <a href="/admin/sks/showKelasSks/{{$kls->id}}">
                  <span class="btn btn-app">
                    <i class="fa fa-group"></i> {{$kls->nm_kelas}}
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