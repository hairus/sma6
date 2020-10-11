@extends('admin.layouts')
@section('breadcum')
Upload
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <!-- disini memberikan space atau tempat untuk menampilkan notif -->
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
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Silakan Di download File dari kurikulum</h3>
        </div>
        <!-- /.box-header -->

        <!-- form start -->

    </div>
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Hasil Upload</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>Nama File</th>
                        <th>Keterangan</th>
                        <th>File</th>
                        <th>Semester</th>
                        <th>Tahun Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach ($files as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nGurus->nama }}</td>
                        <td>{{ $data->nama_file }}</td>
                        <td> {{ $data->ket }}</td>
                        <td> {{ $data->file }}</td>
                        <td> {{ $data->Tanya->semester }}</td>
                        <td> {{ $data->Tanya->tahun }} </td>
                        <td><a href="/upUm/{{$data->file}}"><button class="btn bg-maroon margin"><i class="fa fa-download" aria-hidden="true"></button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection
