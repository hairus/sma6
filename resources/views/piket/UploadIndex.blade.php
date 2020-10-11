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
            <form role="form" enctype="multipart/form-data" method="post" action="/piket/simpanUpload">
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
                  </select>
                </div>
                <div class="form-group">
                  <label>Pilih </label>
                  <select name="kelas" class="form-control" onchange="kelas" id="opsi">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                    <option value="wakasek">Wakasek</option>
                    <option value="ekstra">Ekstra</option>
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
                  <td><a href="/upload/{{$data->file}}"><button class="btn btn-primary">Download</button></a></td>
                </tr>
                  @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection
