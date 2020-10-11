@extends('/admin/layouts')
@section('breadcum')
Mapping siswa Tahun Pelajaran Baru
@endsection
@section('content')
<div class="container">
    <div class="box">
        <div class="box-header">
            Settingan untuk memindahkan siswa ke kelas baru
        </div>
        <div class="box-body">
            <form class="form" method="post" action="{{  url('admin/upklsSiswa') }}">
                @csrf
                <div class="form-group">
                    <label for="">Kelas Lama</label>
                    <select name="kl" class="form-control select2" style="width: 100%" required>
                        <option value="">----</option>
                        @foreach($kelas as $data)
                        <option value=" {{ $data->id }}">{{ $data->nm_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Kelas Baru</label>
                    <select name="kl_br" id="kls2" class="form-control select2" required>
                        <option value="">----</option>
                        @foreach($kelas as $data)
                        <option value="{{ $data->id }}">{{ $data->nm_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
    <p></p>
    <div class="box">
        <div class="box-header">
            Semua Siswa
        </div>
        <div class="box-body">
            <table id="table_id" class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Ta</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach($siswas as $siswa)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $siswa->users->nis }}</td>
                        <td>{{ strtoupper($siswa->users->name) }}</td>
                        <td>{{ $siswa->kelas->nm_kelas }}</td>
                        <td>{{ $siswa->tas->tahun }}</td>
                        <td>
                            <a href="{{ url('admin/del/ksis/'.$siswa->id )}}">
                                <button class="btn btn-danger">Keluarkan Siswa dari kelas</button>
                            </a>
                            <a href="{{ url('admin/edit/ksis/'.$siswa->id )}}">
                                <button class="btn btn-primary">Edit Siswa</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        $('#table_id').DataTable()
    })
</script>
@endsection
