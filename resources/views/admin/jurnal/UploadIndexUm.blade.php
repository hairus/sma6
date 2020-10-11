@extends('admin.layouts')
@section('breadcum')
  Upload
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
  <!-- disini memberikan space atau tempat untuk menampilkan notif -->
    @if (count($errors) > 0)
        <div class="col-6">
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif
	</div>
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Upload File Untuk semua guru</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/UpUm">
                {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama File</label>
                  <input name="nama_file" class="form-control"  placeholder="Nama File" type="text">
                  @if ($errors->has('nama_file')) <p class="help-block">{{ $errors->first('nama_file') }}</p> @endif
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <input name="ket" id="exampleInputFile" class="form-control" placeholder="keterangan" type="text">
                </div>
                <div class="form-group">
                  <label>File input</label>
                  <input name="nama_type" id="exampleInputFile" type="file">
                </div>
              </div>
              <!-- tabel -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hasil Upload</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody><tr>
                  <th>#</th>
				  <th>Nama Guru</th>
                  <th>Nama File</th>
                  <th>Keterangan</th>
                  <th>File</th>
                  <th>Semester</th>
                  <th>Tahun Pelajaran</th>
                  <th>Aksi</th>
                </tr>
				<?php $no = 1 ;?>
                  @foreach ($files as $data)
                <tr>
                  <td>{{ $no++ }}</td>
				  <td>{{ $data->nGurus->nama }}</td>
                  <td>{{ $data->nama_file }}</td>
                  <td>  {{ $data->ket }}</td>
                  <td>  {{ $data->file }}</td>
                  <td>  {{ $data->Tanya->semester }}</td>
                  <td> {{ $data->Tanya->tahun }} </td>
                  <td><a href="/upUm/{{$data->file}}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></button></a></td>
                    <td><form action="/admin/upUm/del/{{$data->id}}" method="post">
                        {{csrf_field() }}
                        <button class="btn bg-maroon margin" type="submit" name="button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </form>
                    </td>
                </tr>
                  @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection