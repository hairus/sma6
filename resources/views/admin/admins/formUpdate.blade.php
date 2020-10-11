@extends('/admin/layouts')
@section('breadcum')
    Absen
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<?php
    $user = '';
    if(Auth::user()->role == 1)
    {
        $user = 'admin';
    }
    elseif(Auth::user()->role == 2)
    {
        $user = 'guru';
    }
    elseif(Auth::user()->role == 3)
    {
        $user = 'piket';
    }
    elseif(Auth::user()->role == 4)
    {
        $user = 'bk';
    }
    elseif(Auth::user()->role == 5)
    {
        $user = 'Kepala/wakasek';
    }
    elseif(Auth::user()->role == 6)
    {
        $user = 'siswa';
    }
    elseif(Auth::user()->role == 7)
    {
        $user = 'pengawas';
    }
    ?>
<div class="row">
    <div class="col-md-6">
            <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">Biodata Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                    <li><p class="text-green">{{ $siswa->nisn }}</p></li>
                    <li><p class="text-green">{{ $siswa->nama }}</p></li>
                    <li><p class="text-red">{{ $siswa->Kelass->nm_kelas }}</p></li>
                </ul>
            </div>
            <form action="/{{$user}}/UpKlsSis" method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="PUT" name="_method" >
                <input type="hidden" name="nis" value="{{ $siswa->nisn}}">
                <input type="hidden" name="id" value="{{ $siswa->id}}">
                <div class="box-body">
                        <div class="form-group">
                            <label>Di Pindah Ke Kelas</label>
                            <select class="form-control" name="kls">
                                @foreach($kelas as $kls)
                                <option value="{{$kls->id}}">{{ $kls->nm_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Pindah</button>
                </div>
            </form>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
    </div>
</div>
@endsection
