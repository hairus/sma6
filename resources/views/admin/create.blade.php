@extends('admin/layouts')

@section('content')

<form class="form" action="/admin/kelas" method="post">
  {{csrf_field()}}
  <div class="col-md-8">
  <div class="form-group">
    <label for="usr">Name kelas</label>
    @if (count($errors) > 0 )
        <div class="alert alert-danger">
          <strong>Danger!</strong> {{ $errors->first('nm_kelas')}}
        </div>
    @endif
      <input type="text" name="nm_kelas" class="form-control" value="{{ old('kelas')}}" id="usr">
  </div>
  <div class="form-group">
    <label for="usr">Kode kelas</label>
      <input type="text" name="kd_kelas" class="form-control" id="usr" value="{{old('kd_kelas')}}">
  </div>
  <button class="btn btn-primary" type="submit" name="button">Simpan</button>
  <button class="btn btn-default" type="reset" name="button">Batal</button>
</div>
</form>

@endsection
