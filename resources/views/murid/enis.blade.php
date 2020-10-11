@extends('/admin/layouts')
@section('breadcum')
    Perubahan Nis Terahir
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                Update Nis
            </div>
            <div class="box-body">
                <form action=" {{ url('/siswa/UpNis') }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="">Nis Awal</label>
                        <input type="text" class="form-control" disabled value="{{ $nis->nis }}">
                    </div>
                    <div class="form-group">
                        <label for="">Perubahan NIS</label>
                        <input type="text" name="nisUp" class="form-control" placeholder="perubahan Nis hanya sekali" required>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
