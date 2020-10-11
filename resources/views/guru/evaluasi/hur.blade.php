@extends('/admin/layouts')
@section('breadcum')
    Evaluasi Hasil Unggahan Rapor
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
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
    <div class="content">
        <div class="row col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered" id="table_id">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($my_unggahan as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name->nama }}</td>
                            <td>{{ $data->name->Kelass->nm_kelas }}</td>
                            <td>{{ $data->rapor }}</td>
                            <td>
                                <a href="/smansa/public/guru/evaluasi/hur/del/{{$data->id}}">
                                <button class="btn btn-success">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="box">
                    <div class="box-header">
                        Upload file satuan disini
                    </div>
                    <div class="box-body">
                        <form action="{{ url('/guru/eva/upSatu') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Pilih kelas</label>
                                <select name="kelas_id" id="" class="form-control" required>
                                    <option value="">----</option>
                                    @foreach($kls as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nm_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-info">Pilih Kelas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable();
        })
    </script>
@endsection
