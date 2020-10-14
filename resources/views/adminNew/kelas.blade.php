@extends('/admin/layouts')
@section('breadcum')
Management Kelas
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<br>
<br>
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Oppppss
    </div>
    @endif
    @if ($message = Session::get('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ $message }}
    </div>
    @endif
    <form action="{{ url('/admin/ck') }}" method="post">
        @csrf
        <div class="box box-warning">
            <div class="box-header">
                <div class="box-title">
                    Kelas
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Input Kelas</label>
                        <input type="text" name="kelas" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <div class="box box-warning">
        <div class="box-header">
            <div class="box-title">
                List Kelas
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach ($kelas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>
                            <form action="{{ url('/admin/del') }}" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="kelas_id" value="{{ $data->id }}">
                                <button class="btn btn-danger delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
