@extends('/admin/layouts')
@section('breadcum')
    Evaluasi Upload Rapor
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
                <div class="box-header">
                    Pilih Kelas
                </div>
                <div class="box-body">
                    <form action="{{ url('/guru/evaluasi/kelas_id') }}" method="post">
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
    @if(isset($step))
    <div class="content">
        <div class="row col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ url('/guru/evaluasi/saveFileRapor') }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $kelas_terpilih->id }}">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Upload Rapor</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($siswas as $siswa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{$siswa->nama}}</td>
                                <td>
                                    <span class="badge">{{ $siswa->Kelass->nm_kelas }}</span>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="nis[]" value="{{ $siswa->id }}">
                                        <input type="file" accept="application/pdf" name="rapor[]" multiple required/>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
