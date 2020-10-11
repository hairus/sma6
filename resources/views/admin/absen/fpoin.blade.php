@extends('/admin/layouts')
@section('breadcum')
    Poin Siswa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Poin Siswa</h3>
            <p>
            <small> masukkan Nis dan berikan anggka Poin</small>
            </p>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form">
                <!-- select -->
                <div class="form-group">
                    <label>Pilih Siswa</label>
                    <select class="form-control" id="nis" name="nis">
                        <option value="0" disabled>Masukkan Nis</option>
                        @foreach($siswa as $data)
                        <option value="{{ $data->nis }}">{{ $data->nisn }} - {{ $data->nama }} - {{ $data->Kelass->kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nis').select2();
        });
    </script>
@stop