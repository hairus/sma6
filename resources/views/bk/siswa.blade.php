@extends('/admin/layouts')
@section('breadcum')
    Edit Absen Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Siswa</h3>

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
                <tbody>
                <tr>
                  <th>No</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Jam</th>
                  <th>Kondisi</th>
                  <th>Ket</th>
                </tr>
                <?php $no = 1; ?>
                @foreach($siswas as $siswa)	
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $siswa->siswas->nama}}</td>
                  <td>{{ $siswa->date }}</td>
                  <td>{{ $siswa->jam_ke }}</td>
                  <td>{{ $siswa->kondisi}}</td>
                  <td>{{ $siswa->ket}}</td>
                </tr>
                @endforeach
                
              </tbody></table>
              {{ $siswas->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

	
	
	
@endsection