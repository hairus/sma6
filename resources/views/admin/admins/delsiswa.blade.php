@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Hapus siswa atau siswa keluar</div>
@endsection
@section('content')
<div class="content">
    <div class="row">
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
        <div class="col-md-12">
            <div class="box box-primary col-md-6">
                <div class="box-body">
                    <form action="{{ route('delsiswa') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label>Nama</label>
                            <select name="nis" id="nis" class="form-control">
                                @foreach($siswa as $data)
                                <option value="{{ $data->nis }}">{{ $data->name }} - {{ $data->nis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" id="button" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nis').select2();
        $('#button').on('click', function() {
            if (confirm('apakah anda yakin')) {
                return true;
            }
            return false;
        })
    });
</script>
@stop
