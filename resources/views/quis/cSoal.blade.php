@extends('/admin/layouts')
@section('breadcum')
    Quiz
@endsection
@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Setting Soal Ujian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/setUj') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                            <label>Jenis ujian</label>
                            <select class="form-control" name="ju_id">
                                <option value="0">---------</option>
                                    @foreach ($ju as $item)
                                    <option value="{{ $item->id }}">{{ $item->ju }}</option>
                                    @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="jur_id">
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                            @endforeach
                        </select>
                        </div>
                    <div class="form-group">
                        <label>Mapel</label>
                        <select class="form-control" name="mapel_id">
                                @foreach ($mapel as $item)
                                <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                                @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kategori Kelas</label>
                        <select class="form-control" name="kat">
                                @foreach ($kat as $item)
                                <option value="{{ $item->kat_kelas }}">{{ $item->kat_kelas }}</option>
                                @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kelas</label>
                        <p><span class="bg-danger"><small>Jika Ulangan harian maka ini *Wajib di isi <i><b>(SELAIN ITU ABAIKAN)</b></i></small></span></p>
                        <select class="form-control" name="kelas_id">
                            <option value="0">---------</option>
                                @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nm_kelas }}</option>
                                @endforeach
                        </select>
                      </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">My Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <th>No</th>
                                    <th>Evaluasi</th>
                                    <th>Mapel</th>
                                    <th>Ju</th>
                                    <th>Tgl</th>
                                </tr>
                                <?php
                                $no = 1;
                                ?>
                                @foreach ($data_ujian as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td><span class="badge bg-light-blue">{{ $item->user->name }}</span></td>
                                    <td><span class="badge bg-light-blue">{{ $item->mapel->mapel }}</span></td>
                                    <td><span class="badge bg-light-blue">{{ $item->ju->ju }}</span></td>
                                    <td><span class="badge bg-light-blue">{{ $item->created_at }}</span></td>
                                </tr>
                                @endforeach
                        </tbody></table>
                    </div>
              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
      <textarea name="" id="textarea" cols="30" rows="10">

      </textarea>
@endsection
@section('script')
    <script>
        CKEDITOR.replace( 'textarea', { toolbar : [ [ 'EqnEditor', 'Bold', 'Italic' ] ] });
        //$('#textarea').ckeditor();
    </script>
@endsection