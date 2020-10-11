@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>No</th>
                        <th>Nis</th>
                        @for($x = 1; $x <= $jumKat; $x++)
                        <th> Penilaian KD {{ $x }}</th>
                        @endfor
                        <th>Nilai</th>
                    </tr>
                    <?php
                        $no = 1;
                    ?>
                    @foreach($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $datas->siswa->nama }}</td>
                        @for($x = 1; $x <= $jumKat; $x++)
                        <td><span class="badge bg-red">90</span></td>
                        @endfor()
                    </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection