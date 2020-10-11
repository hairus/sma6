@extends('admin.layouts')
@section('breadcum')
    Siswa Baru Mipa
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    Siswa Memilih IPS
                </div>
                <div class="box-body">
                    <table class="table table-hover table-bordered" id="table_id">
                        <thead>
                            <td>No</td>
                            <td>No Un</td>
                            <td>Nama</td>
                            <td>Asal Sekolah</td>
                            <td>Minat</td>
                            <td>Rata Rata Matematika dan IPS</td>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;

                        @endphp
                        @foreach($siba as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nun }}</td>
                            <td>{{ strtoupper($data->user->name) }}</td>
                            <td>{{ strtoupper($data->asal_sekolah) }}</td>
                            <td>{{ $data->minat1->minat}}</td>
                            <td>
                                @php
                                //cari nilai matematika dan ipa dari smt 1 sampai smt 5 lalu di rata rata
                                $mat1 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt1')->first();
                                $mat2 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt2')->first();
                                $mat3 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt3')->first();
                                $mat4 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt4')->first();
                                $mat5 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt5')->first();
                                $rata_mat = ($mat1['mat'] + $mat2['mat'] + $mat3['mat'] + $mat4['mat'] + $mat5['mat']) / 5;

                                $mat1 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt1')->first();
                                $mat2 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt2')->first();
                                $mat3 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt3')->first();
                                $mat4 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt4')->first();
                                $mat5 = \App\Models\angket_nilai::where('nun_profile', $data->nun)->where('smt', 'smt5')->first();
                                $rata_ipa = ($mat1['ips'] + $mat2['ips'] + $mat3['ips'] + $mat4['ips'] + $mat5['ips']) / 5;
                                @endphp
                                {{ ($rata_mat + $rata_ipa)/2  }}
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
        $(function () {
            $('#table_id').DataTable()
        })
    </script>
@endsection
