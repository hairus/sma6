@extends('/admin/layouts')
@section('breadcum')
  Kelas
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
    <a href="{{url('/admin/kelas/create')}}"><input type="button" class="btn btn-primary" name="tambah" value="tambah"></a>
    <h2>Tabel Kelas</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kelas</th>
          <th>Kode Kelas</th>
        </tr>
      </thead>
      <tbody>
          <?php $no = 1; ?>
          @foreach ($Kelas as $kelas)
        <tr>
          <td><?php echo $no++;?></td>
          <td><a href="{{url('/admin/kelas').'/'.$kelas->kd_kelas }}" class="btn btn-primary">{{$kelas->nm_kelas}}</a></td>
          <td>{{$kelas->kd_kelas}}</td>
        </tr>
          @endforeach
      </tbody>
      <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
          <li><a href="#">«</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">»</a></li>
        </ul>
      </div>
    </table>
    {{ $Kelas->links()}}
  </div>
@endsection
