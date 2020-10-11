@extends('admin.layouts')
@section('breadcum')
    Pilih kelas Rekap Jurnal
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')

    @foreach( $kelas as $data)
    <a href="/admin/rekapJur/{{ $data->nm_kelas }}"/> <button class="btn btn-primary">{{ $data->nm_kelas }}</button></a>
    @endforeach
    <p></p>
    {{ $kelas->links() }}
@endsection