@extends('/admin/layouts')
@section('breadcum')
pengecekan siswa baru
@endsection
@section('content')
<div class="container">
    <div class="row col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="class box-body">
                    <table id="dataTable" class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Nama</th>
                                <th>Nomer Peserta UN</th>
                                <th>Asal Sekolah</th>
                                <td><strong> Aksi</strong></td>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($tampil as $tam )
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ strtoUpper($tam->user->name) }}</td>
                                <td>{{ $tam->nun }}</td>
                                <td>{{ $tam->asal_sekolah }}</td>
                                <td>
                                    <a target="_blank" href="{{ url('admin/tampil/'.$tam->id) }}"><button
                                            class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></button></a>
                                    <a target="_blank" href="{{ url('admin/selesai') }}"><button
                                            class="btn btn-warning"><i class="fa fa-fw fa-eye-slash"></i></button></a>
                                    <a href="{{ url('admin/dl/'.$tam->id) }}"><button class="btn btn-danger"><i
                                                class="fa fa-trash" aria-hidden="true"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
