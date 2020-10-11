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
              <h3 class="box-title">Upload UKBM</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/sks/saveUp">
                {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Materi/UKBM</label>
                  <input name="nama_file" class="form-control"  placeholder="Contoh: Ketuhanan Yang Maha Esa" type="text">
                  @if ($errors->has('nama_file')) <p class="help-block">{{ $errors->first('nama_file') }}</p> @endif
                </div>
                <div class="form-group">
                  <label>Pilih Kelas</label>
                  <select name="kelas" class="form-control">
                      <option>----------</option>
                    @foreach ($kelas as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->nm_kelas }}</option>
                    @endforeach
                      <option value="0">Bank Data Pribadi</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kompetensi Dasar</label>
                  <select name="kd" class="form-control">
                      <option>----------</option>
                    @foreach($ukbms as $ukbm)
                    <option value="{{ $ukbm->id }}">{{ $ukbm->jdlKbm }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Semester</label>
                  <select name="semester" class="form-control">
                      <option>----------</option>
                    @for($x = 1; $x <= 8; $x++)
                    <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label>Masukkan File</label>
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
                  <th>Aksi</th>
                </tr>
        <?php $no = 1 ;?>
        @foreach($UpPems as $UpPem)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $UpPem->user->name }}</td>
                  <td>{{ $UpPem->namaFile }}</td>
                  <td> {{$UpPem->kelas->nm_kelas }} </td>
                  <td>{{$UpPem->mapel->mapel }}</td>
                  <td>{{$UpPem->link }}</td>
                  <td>{{$UpPem->smt }}</td>
                  <td><a href="/UpPem/{{$UpPem->link}}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></button></a></td>
                  <td><form action="/admin/sks/hapusUpload/{{$UpPem->id}}" method="post">
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
