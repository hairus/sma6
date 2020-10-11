@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">CEK PROFILE</div>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <form action="{{ route('admin.cekGP') }}" method="post">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="box box-primary col-md-6">
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control select2" name="smt">
                                <option value="0">------</option>
                                @for($x = 1; $x <= 6; $x++)
                                <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection