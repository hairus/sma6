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
    <h4>Siswa : {{$data1->siswas->nama}} / <b>Proses edit siswa</b></h4>
<form class="form" action="/admin/AdminAbsen/{{$data1->id}}" method="post">


  <input type="hidden" name="user" value="{{Auth::user()->name}}">

  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" name="nama" value="{{$data1->siswas->nama}}" disabled>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Kelas</label>
    <input type="text" class="form-control" name="kelas" value="{{$data1->kelass->nm_kelas}}" disabled>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Jam</label>
    <input type="text" class="form-control" name="jam" value="{{$data1->jam_ke}}" disabled>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Pengajar</label>
    <input type="text" class="form-control" name="jam" value="{{$data1->user}}" disabled>
  </div>

  <div class="form-group">
      <label>Keterangan</label>
      <select name="kondisi" class="form-control">
        <option value="Masuk">Masuk</option>
        <option value="Ijin">Ijin</option>
        <option value="Sakit">Sakit</option>
        <option value="Dispen">Dispen</option>
        <option value="Alpa">Alpa</option>
      </select>
    </div>
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
  <input class="btn btn-primary" type="submit" name="submit" value="simpan">
  </form>
  </div>
@endsection
