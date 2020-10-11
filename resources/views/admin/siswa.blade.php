@extends('admin/layouts')
@section('breadcum')
  Siswa
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <center><h1>Halaman Siswa</h1></center>
  <div class="container">
    <a href="{{url('/admin/siswa/create')}}"<button class="btn btn-primary">Tambah</button></a>
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama</th>
          <th>Nisn</th>
          <th>Kode Kelas</th>
          <th>Nama Kelas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
        ?>
        @foreach ($siswas as $list)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $list->nama }}</td>
            <td>{{ $list->nisn }}</td>
            <td>{{ $list->kelas_id }}</td>
            <td>{{ $list->Kelass->nm_kelas }}</td>
            <td> <a href="{{url('/admin/siswa/'.$list->id.'/edit')}}">Edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$siswas->links()}}
  </div>

@endsection
