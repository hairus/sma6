@extends('/admin/layouts')
@section('breadcum')
Input Nis
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="form">
            <form action="{{ url('siswa/nis') }}" method="post">
                {{ csrf_field() }}
                @method('put')
                <div class="card">
                    <div class="form-group">
                        <label for="">NIS</label>
                        <input type="number" name="nis" class="form-control" placeholder="isikan nis dengan benar contoh 19xxx dan pengisian HANYA 1X ISIAN" disabled>
                    </div>
                </div>
                <button class="btn btn-info">Simpan</button>
            </form>
        </div>
    </div>
</div>
@stop
