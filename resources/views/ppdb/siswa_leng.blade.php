@extends('/admin/layouts')
@section('breadcum')
PPDB Tahun <?php echo date('Y')?>
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                Calon Siswa tahap III yang Sudah Upload Sebanyak : {{ count($siswa_leng) }} esoro pak agus sekretaris ppdb -> ngabes matana se <b>Poke</b>
            </div>
            <div class="box-body">
                <div class="table">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>NUS</td>
                        </tr>
                        @php $no = 1;@endphp
                        @foreach($siswa_leng as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama->name }}</td>
                            <td>{{ $data->nama->username }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    Calon Siswa tahap III yang Belum Upload Sebanyak : {{ count($siswa_nl) }}
                </div>
                <div class="box-body">
                    <div class="table">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>NUS</td>
                            </tr>
                            @php $no = 1;@endphp
                            @foreach($siswa_nl as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
