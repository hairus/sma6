@extends('/admin/layouts')
@section('breadcum')
    Tatib
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <th>Nis</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>point</th>
                </thead>
                <tbody>
                @foreach($jum as $data)
                <tr>
                    <td>{{ $data->nis }}</td>
                    <td>
                        <a href="{{ url('guru/dPoint/'.$data->nis) }}">
                        <button class="btn btn-primary">
                        {{ $data->nama->nama }}
                        </button></a>
                    </td>
                    <td>{{ $data->kelas->nm_kelas }}</td>
                    <td>
                        @if($jumlah->where('nis', $data->nis)->sum('point') >= 50)
                            <span class="badge bg-red">{{ $jumlah->where('nis', $data->nis)->sum('point') }}</span>
                        @else
                            <span class="badge bg-blue">{{ $jumlah->where('nis', $data->nis)->sum('point') }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
