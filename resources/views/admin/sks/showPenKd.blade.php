@extends('admin/layouts')
@section('breadcum')
    SKS
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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table Penilaian Per UKBM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Siswa</th>
                    <th>Mapel</th>
                    <th>Semester</th>
                    <th>Judul Ukbm</th>
                    <th>KD</th>
                    <th>Nilai</th>
                    <th>File Lock</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                ?>
                @foreach($penKd as $nilai)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $nilai->siswa->nama }}</td>
                        <td>{{ $nilai->mapels->mapel }}</td>
                        <td>{{ $nilai->smt }}</td>
                        <td>{{ $nilai->Ukbm->jdlKbm}}</td>
                        <td>{{ $nilai->kat }}</td>
                        @if($nilai->nilai > 69)
                            <td><span class="badge bg-blue">{{ $nilai->nilai}}</td>
                        @else
                            <td><span class="badge bg-red">{{ $nilai->nilai}}</td>
                        @endif
                        <td>
                            @if($nilai->Pfile()->where('kd_id', $nilai->kd+1)->count() == 0)
                            @if($nilai->nilai > 69)
                                <form action="/{{$user}}/sks/inFile/" method="post">
                                    {{csrf_field() }}
                                    <input type="hidden" name="kd" value="{{ $nilai->kd }}">
                                    <input type="hidden" name="nis" value="{{ $nilai->nis }}">
                                    <input type="hidden" name="mapel" value="{{ $nilai->mapel_id }}">
                                    <button class="btn bg-maroon margin" type="submit" name="button"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                </form>
                            @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody></table>
            </table>
            <!-- /.box-body -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection