@extends('admin/layouts')

@section('content')

<form class="form" action="/admin/siswa" method="post">
  {{csrf_field()}}
  <div class="col-md-8">
  <div class="form-group">
    <label for="usr">Nama Siswa</label>
    @if (count($errors) > 0 )
        <div class="alert alert-danger">
          <strong>Danger!</strong> {{ $errors->first('nama')}}
        </div>
    @endif
      <input type="text" name="nama" class="form-control" value="{{ old('nama')}}" id="usr">
  </div>
  <div class="form-group">
    <label for="usr">Nisn</label>
      <input type="text" name="nisn" class="form-control" id="usr" value="{{old('nisn')}}">
  </div>
  <div class="form-group">
  <label for="sel1">Pilih Kelas:</label>
  <select class="form-control" name="kelas" id="sel1">
    @foreach ($kelas as $list)
    <option value="{{$list->id}}"> {{$list->nm_kelas}} </option>
    @endforeach

  </select>
</div>
  <div class="form-group">
    <label for="usr">alamat</label>
      <input type="text" name="alamat" class="form-control" id="usr" value="{{old('alamat')}}">
  </div>
  <button class="btn btn-primary" type="submit" name="button">Simpan</button>
  <button class="btn btn-default" type="reset" name="button">Batal</button>
  <a href="{{ url('/admin/siswa')}}"><button class="btn btn-info" type="button" name="button">Kembali</button></a>
</div>
</form>

@endsection
