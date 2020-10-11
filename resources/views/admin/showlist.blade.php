@extends('/admin/layouts')
@section('breadcum')
Kelas
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row">'
            <form action="{{ url('/admin/update') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reset Password Guru</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Pilih Guru</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="id">
                                <option selected="selected">Pilih guru</option>
                                @foreach($userGuru as $gg)
                                <option value="{{ $gg->user['id'] }}">{{ $gg->user['name'] }}  || {{ $gg->user['email'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $(function() {
        $('.select2').select2()
    })
</script>
@endsection
