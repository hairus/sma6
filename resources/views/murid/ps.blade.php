@extends('/admin/layouts')
@section('breadcum')
    Profile Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <button class="btn btn-info">{{ $kelas_saya->Kelass->nm_kelas }}</button>
@endsection
