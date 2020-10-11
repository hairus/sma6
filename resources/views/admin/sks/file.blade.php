@extends('admin.layouts')
@section('breadcum')
  File UKBM
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
  <!-- disini memberikan space atau tempat untuk menampilkan notif -->
             <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hasil Upload</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody><tr>
                  <th>#</th>
                  <th>Mapel</th>
                  <th>Ukbm</th>
                  <th>Download</th>
                </tr>
        <?php $no = 1 ;?>
          @foreach($mapels as $UpPem)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $UpPem->mapel->mapel }}</td>
                  <td>{{ $UpPem->ukbm->jdlKbm }}</td>
                  <td><a href="/UpPem/{{ $UpPem->link }}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></button></a></td>
                </tr>
          @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection