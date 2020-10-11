@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">Add / Remove Asisten Kurikulum</div>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ url('/guru/asisten/add') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nama</label>
                    <select name="name" id="" class="form-control">
                        <option value="">---</option>
                        @foreach($user as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="footer">
                    <button class="btn btn-info" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<div class="box">
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
            <th>No</th>
            <th>Nama</th>
            <th>#</th>
            </thead>
            <tbody>
            @php $no = 1; @endphp
            @foreach($asisten as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->users->name }}</td>
                <td>
                    <a href="{{ url('/admin/asisten/del/'.$data->id) }}">
                    <button class="btn btn-danger">Delete</button>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
