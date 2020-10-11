@extends('/admin/layouts')
@section('breadcum')
  Absen
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">History Absensi hari ini tanggal {{ date('d-m-Y')}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
      <table class="table table-condensed">
        <tbody><tr>
          <th>#</th>
          <th>Nama</th>
          <th>Nisn</th>
          <th>Kelas</th>
          <th>Jam Ke</th>
          <th>Pengabsen</th>
          <th>Keterangan</th>
          <th>Catatan</th>
          <th>Waktu</th>
        </tr>
		
        <?php
        $no = 1;
         ?>
        @foreach ($absens as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$data->siswas->nama}}</td>
            <td>{{$data->nisn}}</td>
            <td>{{$data->Kelass->nm_kelas}}</td>
            <td>{{$data->jam_ke}}</td>
            <td>{{$data->user}}</td>
            <td>{{$data->kondisi}}</td>
            <td>{{$data->ket}}</td>
            <td>{{$data->created_at}}</td>
          </tr>
        @endforeach

      </tbody></table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection
