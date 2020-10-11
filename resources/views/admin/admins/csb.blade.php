@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">CSB</div>
@endsection
@section('content')
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
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                DB tabel siswa
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="">Cari siswa</label>
                    <select name="" id="nis" class="form-control">
                        @foreach ($siswa as $data)
                        <option value="">{{ $data->nama }} -- {{ $data->nisn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                DB tabel User
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="">Cari Userr</label>
                    <select name="" id="nis1" class="form-control">
                        @foreach ($users as $data)
                        <option value="">{{ $data->name }} -- {{ $data->nis }} -- {{ $data->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary col-md-6">
                <form action="{{ route('scsb') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nis</label>
                        <input type="number" name="nis" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" id="" class="form-control">
                            @foreach($kelas as $data)
                            <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nis').select2();
        $('#nis1').select2();
    });
</script>
@stop
