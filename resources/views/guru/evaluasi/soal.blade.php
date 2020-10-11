@extends('/admin/layouts')
@section('breadcum')
    Evaluasi Soal
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    @php $no = 1 @endphp
    <h3>Mapel {{ $mapels->mapel }}</h3>
    <hr>
    <ul>
        @foreach($soals as $soal)
            <li>
                <h4><button class="btn btn-info">KD : {{ $soal->kd->kd }}</button></h4>
                <br>
                <b><button class="btn btn-success">Soal Nomor {{$no++}} Kelas {{$soal->rombel}}</button></b>
                <br>
                {!! $soal->soal !!}
                <br>
                <b>PILGAN</b>
                <br>
                a. {!! $soal->a !!}
                b. {!! $soal->b !!}
                c. {!! $soal->c !!}
                d. {!! $soal->d !!}
                e. {!! $soal->e !!}
                jawaban <b>{!! $soal->jawab !!}</b>
            <hr>
            </li>
        @endforeach
    </ul>
@stop
