@extends('/admin/layouts')
@section('breadcum')
    Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Mutasi Siswa</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table_id" class="display">
            <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($siswa_kelas as $kelas)
                @foreach($kelas->siswas as $siswa)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $kelas->nm_kelas }}</td>
                <td>
                    <form action="/admin/mutasi" method="post">
                        {{ csrf_field() }}
                            <button class="btn btn-danger">Mutasi</button>
                        <input type="hidden" name="nis" value="{{ $siswa->nisn }}">
                    </form>
                </td>
            </tr>
                @endforeach
            @endforeach
            </tbody></table>
        </table>
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