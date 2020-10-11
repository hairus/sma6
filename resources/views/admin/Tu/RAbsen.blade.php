@extends('/admin/layouts')
@section('breadcum')

    <div class="content-header">percobaan absen</div>
@endsection
@section('content')
<div class="box">
    <div class="box-body">
        <div class="box-title">Absen Bulan {{$bulan}} 2019</div>
<table class="table table-bordered">
    <thead>
        <th>No</th>
        <th>Nama</th>
        @for($x = 1; $x <= $tanggal; $x++)
        <th>{{ $x }}</th>
        @endfor
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($user as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->name }}</td>
            @for($x = 1; $x <= $tanggal; $x++)
            <td>
            <?php
             $ada = $data->absens()->where('user', $data->name)->whereDay('created_at', $x)->whereYear('created_at', 2019)->whereMonth('created_at', $bulan)->get();
             ?>
            @foreach ($ada as $da)
            @if($da->user == TRUE) v @else <td>Tidak ada</td> @endif
            @endforeach
            </td>
            @endfor
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@stop
