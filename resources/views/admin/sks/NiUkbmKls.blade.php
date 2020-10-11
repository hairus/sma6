@extends('admin.layouts')
@section('breadcum')
    Cek Penilaian UKBM
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    @foreach($mapel_kelas as $kelas)
        @foreach($nilai_ukbm->where('mapel_id', $kelas->mapel_id) as $data)
            @if($data->nilai < 70)
            <ul>
                <li><span class="badge bg-black">Mapel : {{ $data->mapels->mapel }}</span></li>
                <li>{{ $data->siswa->nama }}</li>
                    @if($data->nilai < 70)
                    <li> Nilai <span class="badge bg-red">  <b>{{ $data->nilai}}</b></span></li>
                    @else
                    <li> Nilai <span class="badge bg-blue"><b>{{ $data->nilai}}</b></span></li>
                    @endif
                <li>Guru Pengampu : {{ $data->user->name }}</li>
                @if(is_numeric($data->kd))
                <li>kd : {{ $data->Ukbm->jdlKbm }}</li>
                @else
                <li>kd : {{ $data->kd }}</li>
                @endif
            </ul>
            <hr>
            @endif
        @endforeach
    @endforeach
@endsection