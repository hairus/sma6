@extends('/admin/layouts')
@section('content')
<div class="container">
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
    <div class="row">
        <div class="box">
            <div class="box-header">
                Upload File
            </div>
            <div class="box-body">
                <form action="{{ url('sibA/SimFile') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Input Foto</label>
                        <input type="file" name="foto" class="form-control">
                        <code>*Foto berwarna dengan menggunakan seragam SMP ( Resmi )</code>
                    </div>
                    <div class="form-group">
                        <label for="">Input PDF</label>
                        <input type="file" name="file" class="form-control">
                        <code>*Scanning KTP (Kartu Tanda Penduduk) berbentuk pdf dan tanda tangan orang tua, Bapak, Ibu atau Wali</code>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                Hasil Upload
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>File</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($file_saya as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td><a href="/siba/{{ $data->file }}">
                                    <button class="btn btn-primary">{{ $data->file }}</button>
                                </a>
                            </td>
                            <td><a href="/sibA/delfile/{{ $data->id }}">
                                    <button class="btn btn-danger">Delete</button>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
