@extends('/admin/layouts')
@section('breadcum')
  Ganti Password
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
<form class="form" action="{{action('AdminAbsenController@updatePass')}}" method="post">
    <div class="form-group col-md-3">
	{{ csrf_field() }}
		<div class="form-group">
			<label>Masukkan Password Lama</label>
			<input type="text" name="old" class="form-control">
		</div>
		<div class="form-group">
			<label>Masukkan Password Baru</label>
			<input type="text" name="newP" class="form-control">
		</div>
		<input type="submit" class="btn btn-primary" value="Simpan">
	</div>
</form>
</div>
@endsection