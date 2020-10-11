@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Profile Siswa</div>
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pilih Semester</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('guru/cetakProf') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Semester</label>
                        <select name="smt" class="form-control">
                            @for($x = 1; $x <= 6; $x++) <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
