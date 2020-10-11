@extends('admin/layouts')
@section('breadcum')
    SKS
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
    <form action="/{{$user}}/simUH" method="post">
        {{ csrf_field() }}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Penilaian UH ({{ $cariKat->kdRpp}})</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ csrf_field() }}
                <input type="hidden" name="kd" value="{{ $cariKat->kdRpp }}">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">NO</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                    <?php
                        $no = 1;
                    ?>
                    @foreach($siswa as $siswan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $siswan->nama }}</td>
                        <td>
                            <input type="text" class="form-control" name="nilai{{ $siswan->nisn }}" value="0">
                            <input type="hidden" class="form-control" name="kelas" value="{{ $siswan->kelas_id }}">
                        </td>
                        <input type="hidden" class="form-control" name="nis{{ $siswan->nisn }}" value="{{ $siswan->nisn }}">
                    </tr>
                    @endforeach
                </tbody></table>
                <button class="btn btn-success">Simpan</button>               
            </div>
        </div>
    </form>
@endsection
