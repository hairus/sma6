@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Cek Profile Siswa</div>
@endsection
@section('content')
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Report <b>Semester {{ $smt }}</b> <br> Mapel <b>{{ $hit_kd->mapel->mapel }}</b> <br><br> -
            KKM
            75
            <br>
            - jika berwarna merah maka siswa mendapat nilai di bawah kkm</h3>
    </div>
    @if($hit_kd)
    <div class="box-body">
        <div class="box-title">

        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th colspan="{{ $hit_kd->jumkd * 2}}">Semester dan KD</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        @for ($i = 1; $i <= $hit_kd->jumkd; $i++)
                            <td colspan="2">kd {{ $i }}</td>
                            @endfor
                            <td></td>
                            <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        @for ($i = 1; $i <= $hit_kd->jumkd; $i++)
                            <td>p</td>
                            <td>k</td>
                            @endfor
                            <td></td>
                            <td></td>
                    </tr>
                    @php $no =1 @endphp
                    @foreach($siswa as $sis)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><span class="badge bg-purple">{{ $sis->nis }}</span></td>
                        <td>{{ strtoupper($sis->users->name) }}</td>
                        @for ($i = 1; $i <= $hit_kd->jumkd; $i++)
                            @foreach($sis->nilaiKd1->where('kd', $i) as $nilai)
                            @if($nilai->nilaiP >= 75 && $nilai->nilaiK >= 75)
                            <td><span class="badge bg-blue">{{ $nilai->nilaiP }}</span></td>
                            <td><span class="badge bg-blue">{{ $nilai->nilaiK }}</span></td>
                            @else
                            <td><span class="badge bg-red">{{ $nilai->nilaiP }} </span></td>
                            <td><span class="badge bg-red">{{ $nilai->nilaiK }} </span></td>
                            @endif
                            @endforeach
                            @endfor
                            <td><span class="badge bg-green">{{ $sis->kelas->nm_kelas }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
