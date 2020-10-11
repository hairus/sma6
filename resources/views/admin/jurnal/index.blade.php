@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  {!!
  /*
    untuk menentukan siapa yang login dan semua link akan menuju ke dari rolenya masing masing
  */
          $role = '';
          if(Auth::user()->role == 1)
              {
                  $role = 'admin';
              }
              elseif (Auth::user()->role == 2)
              {
                $role ='guru';
              }
              elseif (Auth::user()->role == 3)
              {
                $role ='piket';
              }
              elseif (Auth::user()->role == 4)
              {
                $role ='bk';
              }
              elseif (Auth::user()->role == 5)
              {
                $role ='kepala';
              }
              elseif (Auth::user()->role == 6)
              {
                $role ='siswa';
              }
              elseif (Auth::user()->role == 7)
              {
                $role ='pengawas';
              }

  !!}
  <div class="container">
      @foreach ($kelas as $list)
        <a href="/{{ $role }}/jurnal/kelas/{{$list->id}}" class="btn btn-primary">
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
	  <a href="/admin/jurnal/cetak"><button type="button" class="btn bg-purple btn-flat margin">Cetak Jurnal</button></a>
      <!-- /.box-header -->
      <div class="box-body no-padding table-responsive">
        <table class="table table-condensed">
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
			<th>Tindak Lajut</th>
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
