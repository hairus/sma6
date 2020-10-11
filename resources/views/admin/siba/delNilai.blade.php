@extends('admin.layouts')
@section('breadcum')
Siswa Delete Nilai
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
@if (count($errors) > 0)
<div class="col-6">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-body">
                @foreach($siswa as $data)
                <ul>
                    <li>{{ $data->user->username }}</li>
                    <li>{{ $data->user->name }}</li>
                    <li>
                        @if(Auth::user()->nis == 17048)
                        <a href="{{ url('siswa/Dnilai/'.$data->user->id) }}">
                            @else
                            <a href="{{ url('admin/Dnilai/'.$data->user->id) }}">
                                @endif
                                <button class="btn btn-info">Hapus</button>
                            </a>
                    </li>
                </ul>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
