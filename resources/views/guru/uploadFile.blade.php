@extends('admin.layouts')
@section('breadcum')
Upload Nilai
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
        Maaf file ekstensi tidak Sesuai
    </div>
    @endif
    <div class="box box-danger">
        <div class="box-header">
            <div class="box-title">
                Upload File
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <div class="box-title">
                    Kelas {{ $kelas->kelas }}
                </div>
                <div class="pull-right">
                    <a href="{{ URL::previous() }}">
                        <button class=" btn btn-sm btn-danger">Kembali</button>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form action="{{ url('guru/upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Pilih Siswa</label>
                        <select name="siswa_id" id="" class="form-control" required>
                            <option value="">---</option>
                            @foreach ($users as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Dokumen siswa <code>**(File ber extensi PDF)</code></label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                    <button class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">
                Siswa yang belum di upload filenya
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover table-borderer">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaBelum as $gg)
                    <tr>
                        <td>{{ $gg->id }}</td>
                        <td>{{ $gg->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
