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
              <h3 class="box-title">Upload Kelengkapan</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/AdminAbsen/simpan">
                {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama File</label>
                  <input name="nama_file" class="form-control"  placeholder="Contoh: RPP Ekonomi X" type="text">
                  @if ($errors->has('nama_file')) <p class="help-block">{{ $errors->first('nama_file') }}</p> @endif
                </div>
                <div class="form-group">
                  <label>Pilih Mapel</label>
                  <select name="mapel" class="form-control">
                      <option>----------</option>
                    @foreach ($mapels as $mapel)
                    <option value="{{ $mapel->mapel }}">{{ $mapel->mapel }}</option>
                    @endforeach
                      <option value="0">Bank Data Pribadi</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Pilih Kelas</label>
                  <select name="kelas" class="form-control">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                    <option value="ekstra">Ekstra</option>
                      <option value="kurkilum">Wakasek Kurikulum</option>
                      <option value="sarpras">Wakasek Sarpras</option>
                      <option value="humas">Wakasek Humas</option>
                      <option value="kesiswaan">Wakasek Kesiswaan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>File input</label>
                  <input name="nama_type" id="exampleInputFile" type="file">
                </div>
              </div>
              <!-- tabellllllllllllllllllllll -->

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
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Mapel</th>
                  <th>File</th>
                  <th>Semester</th>
                  <th>Tahun Pelajaran</th>
                  <th>Aksi</th>
                </tr>
				<?php $no = 1 ;?>
                  @foreach ($files as $data)
                <tr>
                  <td>{{ $no++ }}</td>
				  <td>{{ $data->guruss->nama }}</td>
                  <td>  {{ $data->nama_file }}</td>
                  <td>  {{ $data->kelas }}</td>
                  <td>  {{ $data->mapel }}</td>
                  <td> {{ $data->file }} </td>
                  <td>{{ $data->TaNya->semester }}</td>
                  <td>{{ $data->TaNya->tahun }}</td>
                  <td><a href="/upload/{{$data->file}}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></button></a></td>
                    <td><form action="/admin/del/{{$data->id}}" method="post">
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
