@extends('admin.layouts')
@section('breadcum')
Guru User
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<br>
<br>
<div class="container">
    <div class="box box-danger">
        <div class="box-header">
            <div class="box-title">
                Halaman Guru
            </div>
        </div>
        <div class="box-body">
            <h2>Selamat datang Bapak/Ibu Guru</h2>
            <h2>{{ strtoupper(auth()->user()->name) }}</h2>
        </div>
    </div>
</div>
@endsection
