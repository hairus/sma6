@extends('admin/layouts')
@section('breadcum')
    Edit Ulangan Harian
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
    <form action="/{{$user}}/sks/updateUH" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Penilaian Ulangan Harian</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Siswa</th>
                    <th>Nilai</th>
                </tr>
                <?php
                        $no =1;
                ?>
                @foreach($showDatas as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->siswa->nama }}</td>
                    <td>
                        <input type="text" class="form-control" name="nilai{{$data->nis}}" value="{{ $data->nilai }}">
                    </td>
                </tr>
                <input type="hidden" name="kd" value="{{ $data->kd }}">
                <input type="hidden" name="guru_id" value="{{ $data->guru_id }}">
                <input type="hidden" name="kelas_id" value="{{ $data->kelas_id }}">
                <input type="hidden" name="id{{$data->id}}" value="{{ $data->id }}">
                @endforeach
                </tbody></table>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
    </form>
@endsection