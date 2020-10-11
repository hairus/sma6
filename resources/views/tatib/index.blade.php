@extends('/admin/layouts')
@section('breadcum')
Tatib
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                Point Siswa
            </div>
            <div class="box-body">
                <form action="{{ url('guru/simTatib') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Siswa</label>
                            <select name="nis" class="form-control select2">
                                @foreach($siswa as $data)
                                <option value="{{ $data->nisn }}">{{ $data->nama }} -- ( {{ $data->Kelass->nm_kelas }} ) -- ( {{ $data->nisn }} )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Poin</label>
                            <input type="number" name="point" max="250" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket" class="form-control">
                        </div>
                        <button class="btn btn-info">Simpan</button>
                        <!-- /.form-group -->
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-danger">
            <div class="box-body">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <th>#</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Poin</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($point as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nis }}</td>
                            <td>{{ $data->nama->nama }}</td>
                            <td>{{ $data->kelas->nm_kelas }}</td>
                            <td>{{ $data->point }}</td>
                            <td>{{ $data->ket }}</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
