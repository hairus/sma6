@extends('/admin/layouts')
@section('breadcum')
Setting Pembimbing Akademik
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header">
                Input Wali
            </div>
            <div class="box-body">
                <form action="{{ url('admin/savePa') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Pilih Guru</label>
                        <select name="guru_id" id="guru" class="form-control">
                            @foreach ($user as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kelas</label>
                        <select name="kelas_id" id="" class="form-control">
                            @foreach ($kelas as $data)
                            <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header">
                List Wali
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($pa as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if($data->users)
                                {{ $data->users->name }}
                                @else
                                <span class="badge bg-blue">
                                    guru telah tidak ada
                                </span>
                                @endif
                            </td>
                            <td>{{ $data->kelas->nm_kelas }}</td>
                            <td>
                                <a href="{{ url('/admin/delPa/'.$data->id) }}">
                                    <button class="btn btn-danger" id="button"
                                        onclick="return confirm(' Anda Yakin Menghapus?');">Delete</button>
                                </a>
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
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#guru').select2();
        });
</script>
@stop
