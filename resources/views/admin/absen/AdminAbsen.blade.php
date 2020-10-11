@extends('admin.layouts')
@section('breadcum')
Absen
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<?php
$user = '';
if (Auth::user()->role == 1) {
    $user = 'admin';
} elseif (Auth::user()->role == 2) {
    $user = 'guru';
}

?>
<div class="container">
    <div class="row">
        <div class="box box-success">
            <div class="box-header">
                Pemilihan Kelas
            </div>
            <div class="box-body">
                @foreach ($kelas as $list)
                <a href="{{ url($user.'/AdminAbsen/kelas/'.$list->id) }}" class="btn btn-success">
                    <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
                </a>
                @endforeach
            </div>
            <div class="box-footer">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
