@extends('/admin/layouts')
@section('breadcum')
Angket PTM
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                Hasil Angket
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>Kelas</th>
                        <th>Memillih</th>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody>
                        @foreach ($ptm as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->users->name }}</td>
                            <td>{{ $data->kelas->Kelas->nm_kelas }}</td>
                            <td>
                                @if($data->pilih == 1)
                                Ya
                                @else
                                Tidak
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
