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
    <form action="/{{ $user }}/sks/savePen" method="post">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Penilaian UKBM :<b>{{ $ukbm->jdlKbm }}</b>    </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ csrf_field() }}
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
                    @if($cekData > 1)
                        @foreach($cekNilai as $cekNilais)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $cekNilais->siswa->nama }}</td>
                                <td>
                                    @if($cekNilais->nilai >= 70)
                                        <span class="badge bg-blue">{{ $cekNilais->nilai }}</span><a href="/{{$user}}/sks/update/{{ $cekNilais->kd }}/{{ $cekNilais->nis }}"><div class="badge bg-green">EDIT</div></a></td>
                                @else
                                    <span class="badge bg-red">{{ $cekNilais->nilai }}</span><a href="/{{$user}}/sks/update/{{ $cekNilais->kd }}/{{ $cekNilais->nis }}"><div class="badge bg-green">EDIT</div></a></td>
                            @endif
                        @endforeach
                    @elseif($adaData > 1)
                        @foreach($cekNiSiswa as $siswas)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $siswas->siswa->nama }}</td>
                                @if($siswas->nilai < 70)
                                    <td><input type="text" class="form-control" name="rpp{{ $siswas->nisn }}" disabled placeholder="Tidak Tuntas"></td>
                                @else
                                    <td><input type="text" class="form-control" name="rpp{{ $siswas->nis }}" value="0"></td>
                                @endif
                                <input type="hidden" class="form-control" name="nis{{ $siswas->nis }}" value="{{ $siswas->nis }}">
                                <input type="hidden" class="form-control" name="kat" value="{{ $ukbm->kat }}">
                            </tr>
                        @endforeach
                    @else
                        @foreach($siswa as $siswan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $siswan->nama }} </td>
                                <td><input type="text" class="form-control" name="rpp{{ $siswan->nisn }}" value="0"></td>
                                <input type="hidden" class="form-control" name="nis{{ $siswan->nisn }}" value="{{ $siswan->nisn }}">
                                <input type="hidden" class="form-control" name="kat" value="{{ $ukbm->kat }}">
                            </tr>
                        @endforeach
                    @endif
                    </tbody></table>
                <input type="hidden" name="mapel" value="{{ $_GET['mapel'] }}">
                <input type="hidden" name="guru_id" value="{{ $_GET['kdgr'] }}">
                <input type="hidden" name= "kelas_id"value="{{ $_GET['kls'] }}">
                <input type="hidden" name= "idUkbm"value="{{ $_GET['idUkbm'] }}">
                @if($cekData  == 0)
                <button class="btn btn-success">Simpan</button>
                @endif

            </div>
        </div>
    </form>
@endsection