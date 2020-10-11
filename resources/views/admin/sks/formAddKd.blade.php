@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
  <form class="" action="/admin/sks/addKD" method="post">
    {{ csrf_field() }}
        <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">PENGISIAN KD</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kode KD</label>

                    <div class="col-sm-10">
                      <input type="text" name="kode_kd" class="form-control" id="inputEmail3" placeholder="1.1/2.1/3.1/4.1.1/4.1.2/4.1.3/RPP-1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Semseter</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="smt">
                        @for ($i=1; $i <= 6; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Kelas</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="kelas">
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Mapel</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="mapel">
                        @foreach($list_mapel as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->mapel }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="guru_id" value="{{ Auth::user()->id }}">
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
        </div>
    </form>
@endsection
