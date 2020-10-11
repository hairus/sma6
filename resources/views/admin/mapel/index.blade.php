@extends('admin.layouts')
@section('breadcum')
  Mapel
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <hr>
  <div class="row">
  <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Mapel</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Mapel</th>
              <th>Keterangan</th>
            </tr>
            <?php
            $no = 1;
             ?>
            @foreach ($Mapels as $mapel)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$mapel->mapel}}</td>
              <td>{{$mapel->ket}}</td>
            </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li>{{$Mapels->links()}}</li>
          </ul>
        </div>
      </div>

        <!-- /.box-body -->
      </div>
            <!-- /.box -->
</div>
@endsection
