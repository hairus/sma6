@extends('/admin/layouts')
@section('breadcum')
    maping kelas
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        @if (session('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
        @endif
        <div class="box">
            <div class="box-body">
                <form action="{{ url('admin/mapkel') }}" method="post">
                    @csrf
                <div class="group-control">
                    <label for="">kelas</label>
                    <select name="kelas" id="" class="form-control">
                        <option value="">---</option>
                        @foreach ($kelas as $data)
                        <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                    <br>
                <div class="group-control">
                    <label for="">Mapel</label>
                    <p></p>
                    @foreach($mapels as $mapel)
                        <input type="checkbox" value="{{ $mapel->id }}" name="mapel[]">{{ $mapel->mapel }}
                        <p></p>
                    @endforeach
                </div>
                    <button class="btn btn-info">Simpan</button>
            </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <table class="table table-hover" id="table_id">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th>TA</th>
                    <th>#</th>
                </tr>
                <tbody>
                @php $no = 1; @endphp
                @foreach($mapkel as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->kelas->nm_kelas }}</td>
                    <td>{{ $data->mapel->mapel }}</td>
                    <td>{{ $data->tas_id }}</td>
                    <td>
                        <a href="{{ url('admin/del/MapKel/'.$data->id) }}">
                        <button class="btn btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection
