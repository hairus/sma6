@extends('admin.layouts')
@section('breadcum')
    Cetak absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <form action="/bk/Rsiswa" method="post">
        {{csrf_field()}}
	<input name="tgl1" type="text" class="form-control pull-right" id="datepicker">
        <label>Kelas</label>
        <select name='kelas' class="form-control">
        <option disabled>Pilih Kelas </option>
            @foreach($kelas as $kls)
            <option>{{ $kls->nm_kelas }}</option>
            @endforeach
            </select>
	<button type="submit" class="btn btn-facebook"> Pilih </button>
    </form>
@endsection