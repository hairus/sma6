@extends('/admin/layouts')
@section('breadcum')
Setingan Kelas
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="box-title">Setingan Kelas</div>
                    </div>
                    <div class="box-body">
                        <form action="{{ url('admin/saveKls')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Create Kelas</label>
                                <input type="text" name="kelas" id="" class="form-control">
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="box-title">Result Kelas</div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover" id="list">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($kelas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nm_kelas }}</td>
                                    <td>
                                        <button onclick="return confirm(' Anda Yakin Menghapus?');" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#list").DataTable();
    });
</script>
@stop
