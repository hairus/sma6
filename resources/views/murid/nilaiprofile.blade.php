@extends('/admin/layouts')
@section('breadcum')
    Profile Nilai
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    @foreach($mapel_kelas as $mapels)
        <li><b><span class="badge bg-green">{{ $mapels->mapel->mapel }}</span></b></li>
        @foreach($mapels->np as $call)
            <ul>
                <li>{{ $call->guru->name }}</li>
                <li>Semester - {{ $call->smt }}</li>
                <li>KD-{{$call->kd  }}</li>
                @if($call->nilaiP <= 70)
                <li><span class="badge bg-red">{{ $call->nilaiP }}</span></li>
                @else
                <li><span class="badge bg-blue">{{ $call->nilaiP }}</span></li>
                @endif
            </ul>
        @endforeach
    @endforeach
@endsection