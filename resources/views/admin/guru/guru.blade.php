@extends('admin.layouts')
@section('breadcum')
  Guru
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="box">
  <div class="col-md-12">
    <a href="{{ route('guru.create')}}"><button type="button" class="btn btn-block btn-primary">Tambah Guru</button></a>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Guru</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="table_id">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Guru</th>
                  <th>Jabatan</th>
                  <th>Nip</th>
                  <th>Status</th>
                  <th>email</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;?>
                @foreach ($Gurus as $list)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $list->nama }}</td>
                    <td>{{ $list->user->status }}</td>
                    <td>{{ $list->nip }}</td>
                    <td><?php
                    if ($list->status == 1) {
                      echo 'aktif';
                    }else {
                      echo 'tidak aktif';
                    }
                     ?></td>
                    <td>{{ $list->user->email }}</td>
                  </tr>
                @endforeach
                </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li>{{$Gurus->links()}}</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
  </div>
@endsection

