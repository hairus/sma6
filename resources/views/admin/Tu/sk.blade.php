@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">Surat Keluar</div>
@endsection
@section('content')

    <div class="container">
        @if (session('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
        @endif
        <div class="box">
            <div class="box-body">
            <table class="table" id="table">
                <thead>
                    <th>No</th>
                    <th>Kat</th>
                    <th>Nomor Surat</th>
                    <th>Deskripsi</th>
                    <th>File</th>
                    <th>Tanggal</th>
                    <th>Created_at</th>
                    <th>#</th>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($sm as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->kategoris->kat }}</td>
                    <td>{{ $data->kategoris->kode }}{{ $data->ns }}</td>
                    <td>{{ $data->desk }}</td>
                    <td>
                        <a href="{{ url('tu/file/'.$data->id) }}" target="_blank">
                        <span class="badge bg-green">Lihat Scanner</span>
                        </a>
                    </td>
                    <td>{{ $data->tgl }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <a href="{{ url('tu/del/'.$data->id) }}">
                        <button class="btn btn-danger delete">Delete</button>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table').DataTable()
        })
        $('.delete').on('click', function () {
            if(confirm('apakah anda yakin')){
                return true;
            }
            return false;
        })
    </script>
@endsection
