@extends('admin.layouts')
@section('breadcum')
    Input Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="row">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Input Siswa</h3>
            </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('saveAddSis') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Select</label>
                            <select class="form-control" name="nis" id="nis">
                                @foreach ($siswa as $user)
                                <option value="{{ $user->nisn }}">{{ $user->nisn }} -  {{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nis').select2();
    });
</script>
@stop