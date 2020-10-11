@extends('admin.layouts')
@section('breadcum')
    Rekap Jurnal
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <!--  -->

    <form action="/admin/rekapGuru" method="post">
        {{ csrf_field() }}
        <input type="text" id="datepicker" name="tgl">
        <input type="submit" id="pilih" value="pilih">
    </form>
@endsection