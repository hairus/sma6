@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  @foreach ($jurnal as $data)
    <li>{{ $data->kelas }}</li>
  @endforeach
@endsection
