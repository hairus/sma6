@extends('/admin/layouts')
@section('breadcum')
  Absen Guru
@endsection
@section('breadcumSub')
 Controller
@endsection
@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">
        Riwayat Absensi Guru tanggal {{date('d-m-Y')}}
      </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
      <table class="table table-condensed">
        <tbody><tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jam Ke</th>
          <th>Keterangan</th>
          <th>Catatan</th>
          <th>Waktu</th>
          <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
         ?>
        @foreach ($Ag as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{$data->gurus->nama}}</td>
            <td>{{$data->kelass->nm_kelas}}</td>
            <td>{{$data->jam_ke}}</td>
            <td>
              @if($data->ket == 1)
                  Mengajar
              @elseif ($data->ket == 2)
                  Mengajar ada Tugas
              @elseif ($data->ket == 3)
                  Dinas Luar
              @elseif ($data->ket == 4)
                  Tidak Masuk
              @elseif ($data->ket == 5)
                  Tidak Masuk Ada Tugas
              @endif
            </td>
            <td>{{$data->catatan}}</td>
            <td>{{$data->created_at}}</td>
            <td><a href="/piket/{{$data->id}}/edit"><button type="button" class="btn btn-danger">EDIT</button></a></td>
          </tr>
        @endforeach

      </tbody></table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection
