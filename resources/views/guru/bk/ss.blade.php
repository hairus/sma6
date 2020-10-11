@extends('/admin/layouts')
@section('breadcum')
BK
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="box box-danger">
                <div class="box-header">
                    Sebaran Siswa
                </div>
                <div class="box-body">
                    <table class="table table-hover table-strip" id="table_id">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($kelas_siswa as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><a href="#">
                                        <span class="badge bg-red but">{{ strtoupper($data->users->name) }}</span>
                                    </a>
                                </td>
                                <td><span class="badge bg-blue">{{ $data->kelas->nm_kelas }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        $('#table_id').DataTable()
        $('.but').on('click', function() {
            if (confirm('apakah anda yakin')) {
                return true;
            }
            return false;
        })
    })
</script>
@endsection
