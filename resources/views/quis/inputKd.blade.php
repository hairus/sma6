@extends('/admin/layouts')
@section('breadcum')
    Input Kd Bahasa Daerah
@endsection
@section('content')
    <div class="container">
        <div class="box">
            <idv class="box-body">
                <form action="{{ url('/guru/eva/saveKd') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Rombel</label>
                        <select name="rombel" id="" class="form-control">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">KD</label>
                        <input type="text" class="form-control" name="kd" placeholder="3.1 ini adalah kd dari bahasa daerah">
                    </div>

                    <div class="footer">
                        <button class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </idv>
            <table class="table table-bordered">
                <th>No</th>
                <th>Rombel</th>
                <th>Kd</th>
                <th>#</th>
                @php $no = 1; @endphp
                @foreach($kdBahsa as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->kat }}</td>
                    <td>{{ $data->kd }}</td>
                    <td>
                        <a href="{{ url('/guru/del/kd/'.$data->id) }}">
                        <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
