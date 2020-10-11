@extends('/admin/layouts')
@section('breadcum')
Absen
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')

<div class="content">
    <div class="container">
        <div class="row">
            @if (count($errors) > 0)
            <div class="col">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="box box-success">
                <div class="box-header">
                    <div class="box-title">
                        Input Guru Pengajar
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ url('admin/gm')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Pilih Guru</label>
                            <select name="user_id" id="" required class="form-control">
                                <option value="">---</option>
                                @foreach($guru as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Mapel</label>
                            <select name="mapel_id" id="" class="form-control" required>
                                <option value="">----</option>
                                @foreach($mapels as $data)
                                <option value="{{ $data->id }}">{{$data->mapel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title">
                        List Guru Pengajar
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover" id="list">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Mapel</th>
                            <th>Email</th>
                            <th>#</th>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($gm as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->mapel }}</td>
                                <td>
                                    @if(isset($data->users->email))
                                    {{ $data->users->email }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td><a href="{{url('/admin/delgm/'.$data->id)}}">
                                        <button onclick="return confirm(' Anda Yakin Menghapus?');" class="btn btn-sm btn-danger del">Hapus</button>
                                    </a>
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
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control').select2();
        $("#list").DataTable();
    });
</script>
@stop
