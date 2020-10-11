@extends('/admin/layouts')
@section('breadcum')
    Upload Kisi kisi soal
@endsection
@section('content')
    <div class="container">
        <div class="box">
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
            <div class="box-body">
                <form action="{{ url('/guru/eva/uploadKisi') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-gruop">
                        <label for="">Nama File</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama mapel">
                    </div>
                    @if($jum == 1)
                    <div class="form-gruop">
                        <label for="">Mapel</label>
                        <select name="mapel_id" class="form-control">
                            <option value="{{ $mapel->mapel_id }}">{{ $mapel->mapels->mapel }}</option>
                        </select>
                    </div>
                    @else
                        <div class="form-gruop">
                            <label for="">Mapel</label>
                            <select name="mapel_id" class="form-control">
                                @foreach ($mapel as $data)
                                <option value="{{ $data->mapel_id }}">{{ $data->mapels->mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Upload File</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="footer">
                        <button class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Mapel</th>
                    <th>#</th>
                    @php $no = 1; @endphp
                    @foreach($uploadKisi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>Kisi kisi {{ $data->mapels->mapel }}</td>
                        <td>
                            <a href="{{ url('/guru/eva/kisi/'.$data->id) }}">
                                <button class="btn btn-info">Download</button>
                            </a>
                            <a href="{{ url('/guru/eva/delKisi/'.$data->id) }}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
