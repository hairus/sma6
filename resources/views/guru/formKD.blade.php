@extends('/admin/layouts')
@section('breadcum')
    Pembuatan Form KD per semester
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="body">
        <div class="box box-primary">
            <div class="box-header with-border">
                <form action="{{ route('saveSkd') }}" method="post">
                    {{ csrf_field() }}
                <div class="form-froup">
                    <label for="">Mapel</label>
                    <select class="form-control" name="mapel">
                        @foreach ($mapel as $mapels)
                        <option value="{{ $mapels->id }}">{{ $mapels->mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-froup">
                    <label for="">Semester</label>
                    <select class="form-control" name="smt">
                        @for($x = 1; $x <= 6; $x++)
                        <option value="{{$x}}">{{ $x }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah KD</label>
                    <select class="form-control" name="kd">
                        @for ($i = 1; $i <= 20; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                    <button class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="body">
        <div class="box box-primary">
            <h3><div class="box-header">Hasil</div></h3>
            <div class="box-header with-border">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Semester</th>
                        <th>KD</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    <?php
                            $no =1 ;
                    ?>
                        @foreach($hasils as $hasil)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $hasil->smt }}</td>
                            <td>{{ $hasil->kd }}</td>
                            <td><i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection