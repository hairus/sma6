@extends('admin/layouts')
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">Tahun Ajaran</div>
            <div class="box-body">
                <form action="{{ url('admin/saveTa') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="ta" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tapel</label>
                        <input type="text" class="form-control" name="tapel" required>
                    </div>
                    <div class="form-group">
                        <label for="">semester</label>
                        <select name="smt" id="" class="form-control" required>
                            <option value="">--------</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
        <br>
        <div class="box">
            <div class="box-header">List Tahun Ajaran</div>
                <div class="box-table">
                    <table class="table table-bordered">
                        <tr>
                            <td>id</td>
                            <td>Ta</td>
                            <td>Tapel</td>
                            <td>Semester</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @foreach($tas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->ta }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->semester }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                @if($data->status == 1)
                                    <a href="{{ url('admin/NonAktifTa/'.$data->id) }}">
                                <button class="btn btn-info">Aktif</button>
                                    </a>
                                @else
                                    <a href="{{ url('admin/aktifTa/'.$data->id) }}">
                                <button class="btn btn-warning">Non Aktif</button>
                                    </a>
                                @endif
                                ||
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
@endsection
