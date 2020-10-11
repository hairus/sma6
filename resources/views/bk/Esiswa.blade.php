@extends('/admin/layouts')
@section('breadcum')
    Edit Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')

		 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Siswa</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Pengabsen</th>
                  <th>Jam ke</th>
                  <th>Kondisi</th>
                  <th>Waktu</th>
                  <th>Waktu Edit</th>
                  <th>Aksi</th>
                </tr>
                <?php $no = 1; ?>
                @foreach($absens as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->siswas->nama }}</td>
                  <td>{{ $data->Kelass->nm_kelas }}</td>
                  <td>{{ $data->user }}</td>
                  <td>{{ $data->jam_ke }}</td>
                  <td>{{ $data->kondisi }}</td>
                  <td>{{ $data->created_at }}</td>
                  <td>{{ $data->updated_at }}</td>
                  <td><a href="/bk/edit/id/{{$data->id}}"><button class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection
