<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Poin Siswa</title>
</head>
<style>
    table, th, td{
        border: 1px solid black;
    }
</style>
<body>
    <center>
    <h1>Rekapitulasi Point Siswa</h1>
    <p>Point Di cetak dari tgl {{ $start }} sampai {{ $end }}</p>

    <table>
        <tr>
            <td align="center">No</td>
            <td align="center">Nis</td>
            <td align="center">Nama</td>
            <td align="center">Kelas</td>
            <td align="center">Point</td>
{{--            <td align="center">Hari</td>--}}
            <td align="center">Keterangan</td>
            <td align="center">Created</td>
        </tr>
        @php $no = 1; @endphp
        @foreach($datas as $data)
        <tr>
            <td align="center">{{ $no++ }}</td>
            <td align="center">{{ $data->nis }}</td>
            <td>{{ $data->nama->nama }}</td>
            <td align="center">{{ $data->kelas->nm_kelas }}</td>
            <td align="center">{{ $data->point }}</td>
{{--            <td align="center">{{ Date::parse($data->created_at)->format('l') }}</td>--}}
            <td align="center">{{ $data->ket }}</td>
            <td align="center">{{ $data->created_at }}</td>
        </tr>
        @endforeach
    </table>
        <p>Cetakan Ini di cetak dengan menggunakan Aplikasi SIDEMIT</p>
        <p>{{ $token }}</p>
    </center>
</body>
<script>
    window.onload = function () {
        window.print();
    };
    window.onafterprint = function() {
        history.go(-1);
    };
</script>
</html>
