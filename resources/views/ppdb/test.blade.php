@extends('/admin/layouts')
@section('breadcum')
PPDB Tahun <?php echo date('Y')?>
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
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Penjelasan umum</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                    <li>Sehubungan dengan di terbitkannya keputusan tentang Penerimaan Peserta Didik Baru (PPDB) Tahun
                        Ajaran 2020-2021 SMA Negeri 1 Sumenep, maka disampaikan sebagai berikut:</li>
                    <ol>
                        <li>Pemberkasan calon siswa baru (Mengisi formulir)</li>
                        <li>Pembayaran seragam dan kegiatan siswa pada Bank BPRS Bhakti Sumekar Sumenep</li>
                    </ol>
                    <li>Berkas <b>nomor 1 dan 2</b> diatas di unggah (upload) pada laman aplikasi SMA Negeri 1 Sumenep
                        dari <b>tanggal 29 sampai 30 Juni 2020</b></li>
                    <li>Pembayaran keuangan diatas di bayarkan melalui Bank BPRS Bhakti Sumekar Sumenep <b>NOMOR
                            REKENING 001580086036 Atas Nama "KPRI HARAPAN MEKAR"</b></li>
                    <li>SISWA BARU YANG DI TERIMA PADA TAHAP 3 DI HARAP HADIR KE SMAN 1 SUMENEP PADA HARI RABU 1 JULI
                        2020 DENGAN JADWAL SBB :
                    </li>
                    <ol>
                        <li>No. Urut 1 sd 30 (jam 07.00 - 08.00 di Kls XI S1)</li>
                        <li>No. Urut 31 sd 60 (jam 08.00 - 09.00 wib di Kls XI S2)</li>
                        <li>No. Urut 61 sd 87 (jam 09.00 - 10.00 wib di kelas XI S1)</li>
                    </ol>
                    <li>PAKAIAN SERAGAM SMP/MTs DAN DATANG TEPAT WAKTU</li>
                    <li>WAJIB HADIR TEPAT WAKTU</li>
                    <li>WAJIB MEMATUHI DAN MENAATI PROTOKOL
                        COVID-19 (WAJIB MENGGUNAKAN MASKER DAN MEMBAWA HAND SANITIZER)</li>
                    <li>Peserta didik tahap 3 Wajib bergabung <b>Grup WhatsApp</b> dengan meng klik link dibawah:
                        <p>Jangan Share !! Link Bukan Untuk Umum !!</p>
                        <a href="https://chat.whatsapp.com/Bl3ueqKZYX60kQg0Y3qOCh"><button class="btn btn-success">Link
                                Whats App Tahap 3</button> </a>
                    </li>

                </ul>
                Demikian Harap Maklum<br>
                Sumenep, 28 Juni 2020<br>
                <br>
                <br>
                <br>
                Panitia PPDB
                <br>
                <br>
                <a href="/pengumuman/rincian.pdf">
                    <button class="btn btn-warning">Download Rincian</button>
                </a>
                <a href="/pengumuman/koperasi.doc">
                    <button class="btn btn-warning">Download Formulir</button>
                </a>
                <br>
                <br>
                <form action="/ppdb2020/simpBerk" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Unggah Formulir</label>
                        <p>
                            <small>berekstensi *.jpg, jpeg (hasil scan)</small>
                        </p>
                        <input name="formulir" id="exampleInputFile" type="file" required>
                    </div>
                    <div class="form-group">
                        <label>Unggah Bukti Pembayaran</label>
                        <p>
                            <small>berekstensi *.jpg, jpeg (hasil scan)</small>
                        </p>
                        <input name="pembayaran" id="exampleInputFile" type="file" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        @if($berkas)
        <div class="box">
            <div class="box-header">
                Berkas yang sudah di upload
            </div>

            <div class="box-body">
                <table class="table table-hover">
                    <tr>
                        <td>Nama</td>
                        <td>File</td>
                        <td>Action</td>
                    </tr>
                    @foreach($berkas as $data)
                    <tr>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ $data->berkas }}</td>
                        <td>
                            <a href="/ppdb/{{$data->berkas}}">
                                <button class="btn btn-primary">Download</button>
                            </a>
                            <a href="{{ 'del/'.$data->id }}">
                                <button class="btn btn-danger">Hapus</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
        @endif
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@endsection
