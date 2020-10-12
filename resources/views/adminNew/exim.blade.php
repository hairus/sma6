@extends('/admin/layouts')
@section('breadcum')
Management User
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<br>
<div class="container">
    @if($errors->any())
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Success alert preview. This alert is dismissable.
    </div>
    @endif

    <div class="box">
        <div class="box-header">
            <div class="box-title">
                Export Impor User
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/admin/ImportSiswa') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Import Siswa</label>
                    <input type="file" class="form-control" required name="siswa">
                </div>
                <a href="{{ url('/admin/exportSiswa') }}">
                    <button type="button" class="btn btn-success">Export Siswa(template)</button>
                </a>
                <button class="btn btn-success">Import</button>
            </form>
        </div>
        <div class="box-body">
            <form action="{{ url('admin/ImportGuru') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Import wali</label>
                    <input type="file" class="form-control" required name="guru">
                </div>
                <a href="{{ url('admin/exportGuru') }}">
                    <button type="button" class="btn btn-primary">Export Guru(template)</button>
                </a>
                <button class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
</div>
@endsection
