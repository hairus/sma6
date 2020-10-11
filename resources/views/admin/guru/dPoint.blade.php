@extends('/admin/layouts')
@section('breadcum')
    Tatib
@endsection
@section('content')
        <div class="box">
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Point</th>
                    <th>Keterangan</th>
                    <th>Created</th>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nis }}</td>sid
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
            <a href="{{ url('guru/jumpoin') }}">
                <button class="btn btn-info mb-5 mt-5">Kembali</button>
            </a>
@endsection
