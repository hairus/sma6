@extends('/admin/layouts')
@section('breadcum')
  Absen/Edit
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
    <h3>Hai {{Auth::user()->status .' - '. Auth::user()->name}}</h3>
<form class="form" action="/admin/AdminAbsenGuru/{{$data->id}}" method="post">


  <input type="hidden" name="user" value="{{Auth::user()->name}}">

  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" name="nama" value="{{$data->gurus->nama}}" disabled>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Jam Ke</label>
    <input type="text" class="form-control" name="nama" value="{{$data->jam_ke}}" disabled>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Mapel</label>
    <input type="text" class="form-control" name="nama" value="{{$data->mapels->mapel}}" disabled>
  </div>

  <div class="form-group">
      <label>Keterangan</label>
      <select name="ket" class="form-control">
        <option value="1">Mengajar</option>
        <option value="2">Mengajar ada tugas</option>
        <option value="3">Tugas Dinas/Rapat</option>
        <option value="4">Tidak Masuk</option>
        <option value="5">Tidak Masuk Ada Tugas</option>
      </select>
    </div>
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
  <input class="btn btn-primary" type="submit" name="submit" value="simpan">
  </form>
  </div>
@endsection
