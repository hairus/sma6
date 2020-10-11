@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">SPP</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Nominal SPP
                </div>
                <div class="box-body">
                    <form action="{{ url('tu/saveNominal') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Biaya SPP</label>
                            <input type="number" class="form-control" name="nominal" placeholder="150">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    Setting SPP
                </div>
                <div class="box-body">
                    <form action="{{ url('tu/saveSet') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Input Potongan Persen</label>
                            <input type="number" class="form-control" name="persen" placeholder="70%">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        {{--        batas kiri dan kanan --}}
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    Result SPP
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nominal</td>
                                <td>#</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($no as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>Rp. {{ $data->nominal }}</td>
                                <td>
                                    <a href="{{ url('tu/del/nom/'.$data->id) }}">
                                        <button class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header with-border">
                    Result Nominal
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Potongan</td>
                                <td>#</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($persen as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->persen }} %</td>
                                <td>
                                    <a href="{{ url('tu/del/persen/'.$data->id) }}">
                                        <button class="btn btn-danger">Delete</button>
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    Pilih siswa yang mendapat Potongan
                </div>
                <div class="box-body">
                    <form action="{{ url('tu/siswaPotongan') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Pilih Potongan</label>
                            <select class="form-control" name="potongan" required>
                                <option value="">---</option>
                                @foreach($persen as $data)
                                <option value="{{ $data->id }}">{{ $data->persen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih siswa</label>
                            <select class="js-example-basic-multiple form-control" name="siswa[]" multiple="multiple">
                                @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama }} -- {{ $siswa->nisn }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        SIswa
                    </div>

                <div class="box-body">
                    <table class="table table-hover" id="table_id">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Potongan</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no =1; @endphp
                        @foreach($sisPot as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><span class="badge bg-black">{{ $data->siswas->nisn }}</span></td>
                            <td>{{ $data->siswas->nama }}</td>
                            <td>{{ $data->siswas->Kelass->nm_kelas }}</td>
                            <td><span class="badge bg-green">{{ $data->persens->persen }} %</span></td>
                            <td>
                                <a href="{{ url('tu/delpot/'.$data->id) }}">
                                    <button class="btn btn-sm btn-danger">Delete</button>
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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('#table_id').DataTable();
    });
</script>
@stop
