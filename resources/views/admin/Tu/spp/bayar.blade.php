@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Pembayaran SPP</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body">
                    <form action="{{ url('tu/plhKls') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Pilih kelas</label>
                            <select name="kelas" id="" class="form-control" required>
                                <option value="">---</option>
                                @foreach ($kelas as $data)
                                <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Pilih</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($open_form))
<<<<<<< HEAD
    @if($open_form == 1)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            Siswa Kelas <h5><b>{{ $kelas_id->nm_kelas }}</b></h5>
                        </div>
                        <div class="box-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>ID</td>
                                    <td>Nis</td>
                                    <td>Nama</td>
                                    <td>Kelas</td>
                                    <td>Jumlah</td>
                                    <td>Bayar</td>
                                </tr>
                                @php $no = 1; @endphp
                                @foreach($siswa as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->nisn }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->Kelas->nm_kelas }}</td>
                                    <td>
                                        {{ $data->sisPot }}
                                        {{ $nominal->nominal }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Bayar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif
=======
@if($open_form == 1)
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    Siswa Kelas <h5><b>{{ $kelas_id->nm_kelas }}</b></h5>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <td>No</td>
                            <td>Nis</td>
                            <td>Nama</td>
                            <td>Kelas</td>
                            <td>Potongan</td>
                            <td>Jumlah</td>
                            <td>Bayar</td>
                        </thead>
                        @php $no = 1; @endphp
                        @foreach($siswa as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nisn }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->Kelas->nm_kelas }}</td>
                            <td>
                                @if($data->Spot)
                                <span class="badge bg-green">
                                    {{ $data->Spot->persens->persen }}%
                                </span>
                                @else
                                <span class="badge bg-blue">
                                    -
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($data->Spot)
                                <span class="badge bg-yellow">
                                    Rp.{{ (($data->Spot->persens->persen)/100) * $nominal->nominal }}
                                </span>
                                @else
                                <span class="badge bg-blue">
                                    Rp.{{ $nominal->nominal }}
                                </span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary">Bayar</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
>>>>>>> 50f0a01803f5aba31b47c1a4fd67bccc1c90eddf
@endsection
