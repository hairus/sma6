@extends('/admin/layouts')
@section('breadcum')
    Edit Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/bk/update/{{$absens->id}}" method="post">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" value="{{$absens->siswas->nama}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kelas</label>
                  <input type="text" class="form-control" value="{{$absens->Kelass->nm_kelas}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Jam Ke</label>
                  <input type="text" class="form-control" value="{{$absens->jam_ke}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Pengabsen</label>
                  <input type="text" class="form-control" value="{{$absens->user}}">
                </div>
                <div class="form-group">
                  <label>Kondisi</label>
                  <select class="form-control" name="kondisi">
                    <option value="masuk">masuk</option>
                    <option value="sakit">sakit</option>
                    <option value="ijin">Ijin</option>
                    <option value="dispen">dispen</option>
                    <option value="alpa">alpa</option>
                  </select>
                </div>
                <input type="hidden" name="user" value="{{Auth::user()->name}}">
                <input type="hidden" name="_method" value="put">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
@endsection
