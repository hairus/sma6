@extends('admin.layouts')
@section('breadcum')
Hasil Upload
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
                Hasil Upload {{ auth()->user()->name }}
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Nama File</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($result as $gg)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $gg->users->name }}</td>
                        <td>{{ $gg->kelas->kelas }}</td>
                        <td>{{ $gg->file }}</td>
                        <td>
                            <a href="{{ url('guru/delUpload/'.$gg->id) }}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
