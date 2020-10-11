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
    <form action="/{{$user}}/redir" method="post">
        {{ csrf_field() }}
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Siswa Pindah Kelas</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Kelas</label>
                    <select class="form-control" name="kls">
                        @foreach($kelas as $gg)
                            <option value="{{ $gg->kd_kelas }}">{{ $gg->nm_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Pilih</button>
            </div>
        </div>
    </form>
@endsection