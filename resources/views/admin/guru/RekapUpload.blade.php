@extends('admin.layouts')
@section('breadcum')
  Rekap Upload
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rekap Upload</h3>
            </div>
            <!-- /.box-header -->
			<h4 class="box-title"></h4>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="dataTable">
                  <thead>
                      <th>No</th>
                      <th>Nama Guru</th>
                      <th>Nama File</th>
                      <th>Mapel</th>
                      <th>Kelas</th>
                      <th>File</th>
                      <th>Semester</th>
                      <th>Tahun Pelajaran</th>
                      <th>Aksi</th>
                  </thead>
                  <tbody>
				<?php
				$no = 1;
				?>
				@foreach($data as $upload)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $upload->guruss->nama }}</td>
                    <td>{{ $upload->nama_file }}</td>
                    <td>{{ $upload->mapel }}</td>
                    <td>{{ $upload->kelas }}</td>
                    <td>{{ $upload->file }}</td>
                    <td>{{ $upload->TaNya->semester }}</td>
                    <td>{{ $upload->TaNya->tahun }}</td>
                    <td>
                        <a href="/upload/{{$upload->file}}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></i></button></a>
{{--                        <form action="/admin/delete/{{$upload->id}}" method="post">--}}
{{--                            {{csrf_field() }}--}}
{{--                            <button class="btn bg-purple margin" type="submit" name="button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>--}}
{{--                        </form>--}}
                    </td>
                </tr>
				@endforeach
              </tbody>
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
@endsection
