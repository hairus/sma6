@extends('/admin/layouts')
@section('content')
<div class="container">
    <div class="box">
        <div class="box header">
            <h3>Penilaian Harian</h3>
        </div>
        <div class="box-body">
            <button class="badge bg-blue">Download Template</button>
            <a href="{{ url('/guru/sks/penH')}}">
                <button class="badge bg-green">Kembali</button>
            </a>
            <div class="box-title">
                <span class="badge bg-blue"> kelas : {{ $jum_kd->kls->kat_kelas }} </span>
                <span class="badge bg-green">Mapel : {{ $jum_kd->mapel->mapel }}</span>
                <span class="badge bg-orange">Semester : {{ $smt }}</span>
            </div>
            <br>
            <div class="table-responsive">
                <form action="" method="post">
                    @csrf
                    <table class="table table-hover table-bordered">
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        @for($x = 1; $x <= $jum_kd->jumkd; $x++)
                            <th colspan="3">kd {{$x}}</th>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                @for($x = 1; $x <= $jum_kd->jumkd; $x++)
                                    <td><button class="btn btn-primary btn-xs">Utama</button></td>
                                    <td><button class="btn btn-warning btn-xs">Rem 1</button></td>
                                    <td><button class="btn btn-warning btn-xs">Rem 2</button></td>
                                    @endfor
                            </tr>
                            @php $no = 1; @endphp
                            @foreach ($siswas as $siswa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ strtoUpper($siswa->nama) }}</td>
                                @for($x = 1; $x <= $jum_kd->jumkd; $x++)
                                    <td><input type="text" class="form-control" name="utama{{$x}}"></td>
                                    <td><input type="text" class="form-control" name="rem1{{$x}}"></td>
                                    <td><input type="text" class="form-control" name="rem2{{$x}}"></td>
                                    @endfor
                            </tr>
                            @endforeach
                    </table>
                    <button class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
