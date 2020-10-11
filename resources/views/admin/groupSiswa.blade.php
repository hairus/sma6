@extends('admin.layouts')

  @section('breadcum')
    Kelas
  @endsection

  @section('breadcumSub')
    Controller
  @endsection

  @section('content')
    <h3>Daftar Nama Siswa di kelas {{$kelas->nm_kelas}}</h3>
  <table class="table table-borderer">
    <tr>
      <th>Nama Kelas</th>
      <th>Nama Siswa</th>
      <th>Kode Nisn</th>
      @foreach ($kelas->siswas as $list)
      </tr>
        <td><a href="{{url('admin/kelas')}}"class="btn btn-primary">{{$kelas->nm_kelas}}</a></td>
        <td>{{$list->nama}}</td>
        <td>{{$list->nisn}}</td>
      </tr>
      @endforeach

  </table>

  </h1>
  @endsection
