@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <form action="/admin/sks/savePen" method="post">
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
                            <td>{{ $cekNilais->siswa->nama.'----'. $cekNilais->siswa->nisn}}</td>
                            <td>
                                    @if($cekNilais->nilai >= 75)
                                        <span class="badge bg-blue">{{ $cekNilais->nilai }}</span><a href="/admin/sks/update/{{ $cekNilais->kd }}/{{ $cekNilais->nis }}"><div class="badge bg-green">EDIT</div></a></td>
                                    @else
                                        <span class="badge bg-red">{{ $cekNilais->nilai }}</span><a href="/admin/sks/update/{{ $cekNilais->kd }}/{{ $cekNilais->nis }}"><div class="badge bg-green">EDIT</div></a></td>
                                    @endif

                        @endforeach
                        <!-- cek ada data -->
                    @elseif($adaData > 1)
                        @foreach($cekNiSiswa as $siswas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $siswas->siswa->nama }}</td>
                            @if($siswas->nilai < 75)
                            <td><input type="text" class="form-control" name="rpp{{ $siswas->nisn }}" disabled placeholder="Tidak Tuntas"></td>
                            @else
                            <td><input type="text" class="form-control" name="rpp{{ $siswas->nis }}"></td>
                            @endif
                            <input type="hidden" class="form-control" name="nis{{ $siswas->nis }}" value="{{ $siswas->nis }}">
                            <input type="hidden" class="form-control" name="kat" value="{{ $ukbm->kat }}">
                        </tr>
                        @endforeach
                    @else
                        @foreach($siswa as $siswan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $siswan->nama }}</td>
                            <td><input type="text" class="form-control" name="rpp{{ $siswan->nisn }}"></td>
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

                <button class="btn btn-success">Simpan</button>

                
            </div>
        </div>
    </form>
@endsection