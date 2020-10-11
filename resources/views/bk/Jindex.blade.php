@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
      @foreach ($kelas as $list)
        <a href="/bk/jurnal/kelas/{{$list->id}}" class="btn btn-primary">
          <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
        </a>
      @endforeach
  </div>
  {{$kelas->links()}}
  <div class="box">
      <div class="box-header with-border">
		<h2  class="box-title"> Tanggal {{ date('d-m-Y') }} </h2>
		<br>
		<h3 class="box-title">History Jurnal {{Auth::user()->name}} </h3>
      </div>
      <!-- /.box-header -->
      <a href="/piket/jurnal/cetak"><button type="button" class="btn bg-purple btn-flat margin">Cetak Jurnal</button></a>
      <div class="box-body">
        <table class="table table-bordered">
          <tbody><tr>
            <th style="width: 10px">#</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jam</th>
            <th>Mapel</th>
            <th>Kd</th>
            <th>Materi</th>
            <th>Siswa</th>
            <th>Keterangan</th>
			<th>Tindak Lanjut</th>
            <th>Smt</th>
            <th>Waktu</th>
            <th>TA</th>
          </tr>
          <?php $no = 1; ?>
          @foreach ($jurnals as $jurnal)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$jurnal->gurus->nama}}</td>
            <td>{{$jurnal->kelas}}</td>
            <td>{{$jurnal->jam_ke}}</td>
            <td>{{$jurnal->mapels->mapel}}</td>
            <td>{{$jurnal->kikd_ke}}</td>
            <td>{{$jurnal->materi}}</td>
            <td>{{$jurnal->siswa}}</td>
            <td>{{$jurnal->sikap}}</td>
			<td>{{$jurnal->spi}}</td>
            <td>{{$jurnal->semester}}</td>
            <td>{{$jurnal->created_at}}</td>
            <td>{{$jurnal->ta->tahun}}</td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
    </div>
@endsection
