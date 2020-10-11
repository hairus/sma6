@extends('/admin/layouts')
@section('breadcum')
  Kelas
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
<form action="/admin/update" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Reset Password Guru</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Nama Guru</label>
                    <select class="form-control" name="id">
                        @foreach($userGuru as $gg)
                            <option value="{{ $gg->user['id'] }}">{{ $gg->user['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Reset</button>
            </div>
        </div>
</form>
@endsection