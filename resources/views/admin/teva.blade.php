@extends('admin/layouts')
@section('breadcum')
    Evaluasi
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <form action="{{ url('admin/saveEva') }}" class="form" method="post">
            @csrf
            <div class="form-group">
                <label for="">Input Nama evaluasi</label>
                <select name="user_id" id="" class="form-control">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Input Mapel</label>
                <select name="mapel_id" id="" class="form-control">
                    @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->mapel }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-info">Simpan</button>
        </form>
        <hr>
        <ul>
            @foreach($evas as $eva)
                <li>
                    {{ $eva->users->name }} <b>mapel</b> -> {{ $eva->mapels->mapel }}
                    <form action="{{ url('/admin/DelEva') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $eva->id }}" name="user_id">
                        <input type="submit" class="btn btn-danger" value="delete">
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
