@extends('/admin/layouts')
@section('breadcum')
  Absen
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
<div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Admin Ganti Role Guru</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form">
            <!-- text input -->
            
            <!-- select -->
            <div class="form-group">
              <label>Guru</label>
              <select class="form-control">
                @foreach($guru as $gurus)
                <option value="{{ $gurus->id }}">{{ $gurus->name }}</option>
                @endforeach
              </select>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <select class="form-control">
                    @for($x = 1; $x <= 8; $x++)
                    <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
                </select>
            </div>
          </form>
        </div>
      </div>
@endsection