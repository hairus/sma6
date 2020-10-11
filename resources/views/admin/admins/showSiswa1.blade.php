@extends('/admin/layouts')
@section('breadcum')
    Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<?php
    $user = '';
    if(Auth::user()->role == 1)
    {
        $user = 'admin';
    }
    elseif(Auth::user()->role == 2)
    {
        $user = 'guru';
    }
    elseif(Auth::user()->role == 3)
    {
        $user = 'piket';
    }
    elseif(Auth::user()->role == 4)
    {
        $user = 'bk';
    }
    elseif(Auth::user()->role == 5)
    {
        $user = 'Kepala/wakasek';
    }
    elseif(Auth::user()->role == 6)
    {
        $user = 'siswa';
    }
    elseif(Auth::user()->role == 7)
    {
        $user = 'pengawas';
    }
    ?>
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
                <th>Nis</th>
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
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $kelas->nm_kelas }}</td>
                <td><a href="/{{ $user}}/formUpsis/{{ $siswa->nisn }}"><button class="btn btn-danger">Pindah</button></a></td>
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