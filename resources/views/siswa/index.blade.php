@extends('admin.layouts')
@section('breadcum')
Halaman Siswa
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<br>
<br>
<div class="container">
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">
                Halaman Siswa
            </div>
        </div>
        <div class="box-body">
            Selamat datang {{ auth()->user()->name }}
        </div>
    </div>
    @if($cek >= 1)
    <div class="box box-danger">
        <div class="box-header">
            <div class="box-title">
                View Rapor
            </div>
        </div>
        <div class="box-body">
            <a href="{{ url('siswa/download') }}">
                <button class="btn btn-success">View Rapor</button>
            </a>
        </div>
    </div>
    @else
    <div class="box box-danger">
        <div class="box-header">
            <div class="box-title">
                Maaf File Masih Belum di Unggah
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
