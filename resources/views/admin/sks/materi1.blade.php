@extends('admin/layouts')
@section('breadcum')
    materi pertama
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
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
                    <th>Mapel</th>
                    <th>Kelas</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                ?>
                @foreach($myMapels as $mymapel)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $mymapel->mapel->mapel }}</td>
                        <td>{{ $mymapel->kelas->nm_kelas }}</td>
                        <?php
                            $jum = $mymapel->file()->where('mapel_id', $mymapel->mapel_id)->count();
                        ?>
                        <td>
                            @if($jum >= 1)
                            <a href="/UpPem/{{$mymapel->file['link']}}"><i class="fa fa-file"></i></a>
                            @else
                            <p>Guru Belum Upload UKBM</p>
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