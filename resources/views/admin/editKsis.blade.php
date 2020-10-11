@extends('/admin/layouts')
@section('breadcum')
Edit Siswa
@endsection
@section('content')
<div class="container">
    <div class="box">
        <div class="box-header">
            <div class="box-title">Edit Siswa</div>
        </div>
        <div class="box-body">
            <form action="{{ url('/admin/edit/Ksis') }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nis</label>
                    <input type="number" name="nis" value="{{ $user_id->nis }}" class="form-control">
                    <input type="hidden" name="id" value="{{ $user_id->id }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nama Siswa</label>
                    <input type="text" disabled value="{{ $user_id->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kelas</label>
                    <input type="text" disabled value="{{ $user_id->kelas_siswas->kelas->nm_kelas }}" class="form-control">
                </div>
                <button class="btn btn-success">Udpate</button>
                <a href="{{ url('/admin/mapSis') }}">
                <button class="btn btn-primary" type="button">Kembali</button>
                </a>
            </form>
        </div>
    </div>
</div>
@stop
