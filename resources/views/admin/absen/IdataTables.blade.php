@extends('/admin/layouts')
@section('breadcum')
  Rekap Absen Siswa
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')

<div class="container">
        <table id="mahasiswa" class="table table-striped">
            <thead>
                <tr>
                    <th>Nim</th>
                    <th>Keterangan</th>
                    <th>kelas</th>
                    <th>User</th>
                </tr>
            </thead>
        </table>
    </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Datatable -->
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
        $(function() {
            var table = $("#mahasiswa").DataTable({
                processing: true,
				responsive: true,
                serverSide: true,
                ajax: "{{ url('/data') }}",
                columns: [
                  { data: 'nisn' },
                  { data: 'kondisi' },
                  { data: 'kelas_id' },
                  { data: 'user' },
               ]
            });
        });
  </script>

@endsection
