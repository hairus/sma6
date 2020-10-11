@extends('/admin/layouts')
@section('breadcum')
    Pengumuman PPDB Tahun <?php echo date('Y')?>
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">Pengumuman</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                        @if($peng->peng->status == 1)
                            <div class="alert alert-success alert-dismissible">
                                <h4><i class="icon fa fa-check"></i> SELAMAT!</h4>
                                <p>SELAMAT!</p>
                                <p>SILAHKAN DAFTAR ULANG, ISILAH FORMAT BERIKUT!
                                    <a target="_blank" href="http://152431213404.ip-dynamic.com:8081/siba"> <button class="btn btn-warning">Klik Disini</button></a></p>
                                <p>CETAKLAH BERITA ACARA KESEDIAAN, SERAHKAN KE PANITIA BERSAMAAN DENGAN PERLENGKAPAN LAINNYA.</p>
                            </div>
                            <a href="/pengumuman/ba.docx"><button class="btn btn-primary">Download Berita Acara</button></a>
                        @else
                            <div class="alert alert-danger alert-dismissible">
                                <h4><i class="icon fa fa-ban"></i>Maaf!</h4>
                                <p>ANDA BERPELUANG DI JALUR REGULER! JIKA BERKENAN SILAHKAN PILIH DI ZONA SMAN 1 SUMENEP.</p>
                                <p>PANITIA MELAYANI PENGAMBILAN BERKAS DENGAN MENUNJUKKAN KARTU PESERTA UN (UJIAN NASIONAL).</p>
                            </div>
                        @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
