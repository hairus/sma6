@extends('/admin/layouts')
@section('breadcum')
    Nilai
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Nilai Mapel</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>No</th>
                    <th>Mapel</th>
                    <th>Nilai</th>
                </tr>
                <?php
                   $no =1;
                ?>

                @foreach($myMapels as $myMapel)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $myMapel->mapel->mapel }}</td>
                        @foreach($myMapel->NA as $nilai)
                        @if($nilai->nilai >= 70)
                                <td><span class="badge bg-blue">{{ $nilai->nilai }}</span></td>
                            @else
                                <td><span class="badge bg-red">{{ $nilai->nilai }}</span></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection