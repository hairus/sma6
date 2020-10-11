@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">CEK PROFILE SISWA</div>
@endsection
@section('content')
    @if(Auth::user()->role == 1)
    <form action="{{ route('admin.cekPro') }}" method="post">
        @elseif(Auth::user()->role == 2)
            <form action="{{ route('guru.cekPro') }}" method="post">
                @endif
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="box box-success">
                    <div class="box-header">
                        <h3>PENGECEKAN NILAI PER MAPEL</h3>
                        <hr>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">PILIH SEMESTER</label>
                            <select name="smt" id="smt" class="form-control">
                                <option value="0">------</option>
                                @for($x = 1; $x <= 8; $x++)
                                    <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="0">------</option>
                                @foreach($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nm_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary" id="proses" type="submit">Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection