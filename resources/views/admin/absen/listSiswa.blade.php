@extends('admin.layouts')
@section('breadcum')
    List Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box">
        <form role="form" action="{{ route('sisA') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                    <div class="form-group">
                        <label>Pilih Siswa</label>
                        <select class="form-control" name="nis" id="nis">
                            <option>--------</option>
                            @foreach($user as $data)
                            <option>{{ $data->nis }} - {{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="box-header with-border">
            <h3 class="box-title">List Siswa</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered" id="table_id">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $no = 1;
                ?>
                @foreach($siswa as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nis }}</td>
                    <th>{{ $data->name }}</th>
                    <td>{{ $data->kelas_user->Kelass->nm_kelas }}</td>
                    <td><a href="/admin/upt/{{ $data->id }}"><button class="btn btn-danger"> Disable </button></a></td>
                </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nis').select2();
            $('#table_id').DataTable();
        });
    </script>
@stop