@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
<form class="form" action="{{ action('JurnalController@rekap') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label>Tanggal 1:</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="tglA" type="text" class="form-control pull-right" id="datepicker">
    </div>
    <!-- /.input group -->
  </div>
  <div class="form-group">
    <label>Tanggal 2:</label>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="tglA" type="text" class="form-control pull-right" id="datepicker1">
    </div>
    <!-- /.input group -->
  </div>
  <input type="submit" name="submit" value="cari" >
</form>
</div>
@endsection
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
      $(function() {
        $( "#datepicker" ).datepicker();
      });
      $(function() {
        $( "#datepicker1" ).datepicker();
      });
  </script>
