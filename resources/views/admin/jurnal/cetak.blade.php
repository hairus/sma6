@extends('admin.layouts')
@section('breadcum')
  Cetak Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cetak Jurnal</h3>
            </div>
            <!-- /.box-header -->
			<h4 class="box-title">Pengajar : {{ Auth::user()->name }}</h4>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
				<tr>
                  <th>ID</th>
                  <th>Mapel</th>
                  <th>Materi</th>
                  <th>Kelas</th>
				  <th>Siswa</th>
				  <th>Observasi</th>
				  <th>Tindak Lanjut</th>
				  <th>Semester</th>
				  <th>Tahun Ajaran</th>
				  <th>Waktu</th>
                </tr>
				<?php
				$no = 1;
				?>
				@foreach($datas as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->mapels->mapel }}</td>
                  <td>{{ $data->materi }}</td>
				  <td>{{ $data->kelas }}</td>
				  <td>{{ $data->siswa }}</td>
				  <td>{{ $data->sikap }}</td>
				  <td>{{ $data->spi }}</td>
				  <td>{{ $data->tas->id }}</td>
				  <td>{{ $data->tas->tahun }}</td>
				  <td>{{ $data->created_at }}</td>
                </tr>
				@endforeach
              </tbody>
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		<script>
				window.print();
		</script>
@endsection
