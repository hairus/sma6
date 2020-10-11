@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table Penilaian</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Siswa</th>
                    @for($x = 1; $x <= $countKat; $x++)
                        <th>Kd {{ $x }}</th>
                    @endfor
                    <th>Semester</th>
                    <th>Nilai Akhir</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                ?>
                @foreach($siswa as $nilais)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $nilais->nama }}</td>
                        @for($y = 0; $y <= $countKat-1; $y++)
                            @foreach($tesss[$y]->where('nis',$nilais->nisn) as $s)
                                @if($s->nilai < 70)
                                    <td><span class="badge bg-red">{{ $s->nilai }}</span></td>
                                @else
                                    <td><span class="badge bg-blue">{{ $s->nilai }}</span></td>
                                @endif
                            @endforeach
                        @endfor
                        <td>{{ $nilais->nilaiKd->smt }}</td>
                        @foreach($udik[0]->where('nis',$nilais->nisn) as $x)
                            @if($x->nilai < 70)
                                <td><span class="badge bg-red">{{ $x->nilai }}</span></td>
                            @else
                                <td><span class="badge bg-blue">{{ $x->nilai }}</span></td>
                            @endif
                        @endforeach
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