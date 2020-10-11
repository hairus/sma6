@extends('/admin/layouts')
@section('breadcum')
    Absen BK
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    @foreach($kelas as $data)
    <a href="/bk/kelas/{{ $data->id }}"><button class="btn btn-primary">{{ $data->nm_kelas }}</button></a>
    @endforeach
@endsection