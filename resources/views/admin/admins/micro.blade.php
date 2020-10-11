@extends('/admin/layouts')
@section('breadcum')
    MICRO
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    @if (count($errors) > 0)
        <div class="col-6">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>No RFID</th>
            <th>Nis</th>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($micro as $m)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $m->rfid }}</td>
            @if($m->name == null || $m->name ==  '')
            <td>
                Belum di set
                <form action="{{ url('admin/save/micro/') }}" method="post">
                <input type="text" name="rfnya" value="{{ $m->rfid }}">
                <select name="rfid" id="nis">
                    @foreach($data as $d)
                    <option value="{{ $d->nisn }}">{{ $d->nama }}</option>
                    @endforeach
                </select>

                    {{ csrf_field() }}
                <button class="btn btn-info" type="submit">Simpan</button></a>
                </form>
            </td>
            @else
            <td>{{ $m->name->nama }}</td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('script')
    <script>
        $('#nis').select2();
    </script>
@endsection
