@extends('/admin/layouts')
@section('breadcum')
  Siswa
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reset Password Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="table_id">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        {{ $no = 1;}}
                        @endphp
                        @foreach($siswas as $siswa)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->kelas['nm_kelas']}}</td>
                        <td>
                            <form action="/smansa/public/admin/resetSiswa" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-primary"> Reset </button>
                                <input type="hidden" name="nis" value="{{ $siswa->nisn }}">
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    </table>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection
