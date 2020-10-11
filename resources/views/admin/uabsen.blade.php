@extends('/admin/layouts')
@section('breadcum')
  Absen
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
      @foreach ($kelas as $list)
        <a href="/admin/AdminUAbsen/kelas/{{$list->id}}" class="btn btn-primary">
          <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
        </a>
      @endforeach
  </div>
  {{$kelas->links()}}
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">History Absensi {{Auth::user()->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody><tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Nisn</th>
                  <th>Kelas</th>
                  <th>Jam Ke</th>
                  <th>Pengabsen</th>
                  <th>Keterangan</th>
                </tr>
                <?php
                $no = 1;
                 ?>
                @foreach ($Absen as $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{$data->siswas->nama}}</td>
                    <td>{{$data->nisn}}</td>
                    <td>{{$data->Kelas->nm_kelas}}</td>
                    <td>{{$data->jam_ke}}</td>
                    <td>{{$data->user}}</td>
                    <td>{{$data->keterangan}}</td>
                  </tr>
                  {{$Absen->links()}}
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@endsection
