@extends('/admin/layouts')
@section('breadcum')

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    02 Juli 2019
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                    <h3 class="timeline-header"><a href="#">Admin Smansa 2019</a> sent you an email</h3>

                    <div class="timeline-body">
                        <h3 class="alert-success text-center">Pengumuman</h3>
                        <ul>
                            <li>Bagi Seluru Peserta didik baru 2019 silakan mengunduh/mendownload File dibawah ini!</li>
                            <li>Cetak dan lengkapi kebutuhan tersebut dan silahkan di kumpulkan ke Osis smansa</li>
                            <li>Berita Acara silakan di isi bagi siswa yang <b>belum</b> menyetorkan ke sekolah</li>
                        </ul>
                    </div>
                    <div class="timeline-footer">
                        <ul>
                            <li>
                                <a href="{{ url('pengumuman/ba.docx') }}" class="btn btn-primary">File Berita Acara</a>
                                <a href="{{ url('pengumuman/peminatan.docx') }}" class="btn btn-primary">File Peminatan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
                <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>
    </div>
    <!-- /.col -->
</div>
@stop