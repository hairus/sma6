@extends('/admin/layouts')
@section('breadcum')
    View Soal Quiz
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="dataTable">
                <thead>
                <th>No</th>
                <th>Mapel</th>
                <th>KD</th>
                <th>Soal</th>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>JAWAB</th>
                <th>Action</th>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($soal as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->mapels->mapel }}</td>
                        <td>{{ $data->kd->kd }}</td>
                        <td>{!! $data->soal !!}</td>
                        <td>{!! $data->a !!}</td>
                        <td>{!! $data->b !!}</td>
                        <td>{!! $data->c !!}</td>
                        <td>{!! $data->d !!}</td>
                        <td>{!! $data->e !!}</td>
                        <td>{!! $data->jawab !!}</td>
                        <td>
                            <form action="{{ url('/guru/edit/soal/'. $data->id) }}" method="post">
                                @method('put')
                                @csrf
                                <button class="btn btn-info">Edit</button>
                            </form>
                            <form action="{{ url('/guru/del/soal/'.$data->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

@endsection
