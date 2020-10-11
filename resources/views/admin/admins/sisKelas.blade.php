@extends('/admin/layouts')
@section('breadcum')
Set role 99 ke 6
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                Masukkan siswa role 99 ke 6 dan sekeligus masukkan kelas
            </div>
            <div class="box-body">
                <form action=" {{ url('admin/sibaRole')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Pilih siswa</label>
                        <select name="siba[]" id="" multiple="multiple" class="form-control select2">
                            @foreach($users as $data)
                            <option value="{{ $data->id }}">{{ $data->name }} {{ $data->ppdb['minat_id'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih kelas</label>
                        <select name="kelas_id" id="" class="form-control select2">
                            @foreach($kelas as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nm_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="box-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th>#</th>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody>
                        @foreach($kelas as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><span class="badge bg-green">{{ $data->nm_kelas }}</span></td>
                            <td><span class="badge bg-red"> {{ count($data->ksis)  }}</span></td>
                            <td>
                                <a href="{{ url('admin/dKsis/'.$data->id) }}">
                                    <button class="btn btn-sm btn-primary">Detail</button>
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
@endsection
