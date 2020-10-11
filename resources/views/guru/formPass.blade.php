@extends('/admin/layouts')
@section('breadcum')
Ganti Password
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="box">
        <div class="box-body">
            <form class="form" action="{{ url('/guru/update') }}" method="post">
                <div class="form-group col-md-3">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Masukkan Password Lama</label>
                        <input type="text" name="old" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Masukkan Password Baru</label>
                        <input type="text" name="newP" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
