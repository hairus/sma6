@extends('/admin/layouts')
@section('breadcum')
    Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
	<form action="/bk/edit/kls/cari" method="post">
	  {{csrf_field()}}
			<div class="form-group">
	            <label>Masukkan Tanggal 1</label>
	            <div class="input-group date">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <input name="tgl1" type="text" class="form-control pull-right" id="datepicker" placeholder="format th/bln/tgl contoh: 20171230">
	            </div>
	            <!-- /.input group -->
	          </div>
	          <div class="form-group">
	            <label>Masukkan Tanggal 2</label>
	            <div class="input-group date">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <input name="tgl2" type="text" class="form-control pull-right" id="datepicker" placeholder="format th/bln/tgl contoh: 20171230">
	            </div>
	            <!-- /.input group -->
	          </div>
	        <input type="submit" value="CARI" class="btn btn-primary"/>
	</form>
@endsection