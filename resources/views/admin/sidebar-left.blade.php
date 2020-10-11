<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
        @if(Auth::user()->role == 98)
        <a href="{{url('/ppdb2020/peng')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        @elseif( Auth::user()->role == 1)
        <a href="{{url('/admin')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        @endif
    </li>
    @if (Auth::user()->role == 1)
    <li class="treeview">
        <a href="#">
            <i class="fa fa-gear"></i> <span>Admin</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="#"><i class="fa fa-gear"></i> Setting Users
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/allUser')}}"><i class="fa fa-circle-o"></i>User</a></li>
                    <li><a href="{{ url('/admin/create_user')}}"><i class="fa fa-circle-o"></i>Create User</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-gear"></i> Mapping Siswa TA Baru
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/mapSis')}}"><i class="fa fa-circle-o"></i>Mapping Kelas Siswa</a></li>
                    <li><a href="{{ url('/admin/role99')}}"><i class="fa fa-circle-o"></i>Set role 99 -> X</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-gear"></i>Setting Admin
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/spa')}}"><i class="fa fa-circle-o"></i>admin SPA</a></li>
                    <li><a href="{{ url('/admin/Cuser')}}"><i class="fa fa-circle-o"></i>Create User & Role</a></li>
                    <li><a href="{{ url('/admin/kls')}}"><i class="fa fa-circle-o"></i>Kelas</a></li>
                    <li><a href="{{ url('/admin/gm')}}"><i class="fa fa-circle-o"></i>Guru Mapel</a></li>
                    <li><a href="{{ url('/admin/setinganPa')}}"><i class="fa fa-circle-o"></i>Set Wali/PA</a></li>
                    <li><a href="{{ url('/admin/setMapKel')}}"><i class="fa fa-circle-o"></i>Mapel Kelas</a></li>
                    <li><a href="{{ url('/admin/viewSetKd')}}"><i class="fa fa-circle-o"></i>View set Kd</a></li>
                </ul>
            </li>
        </ul>
    </li>
@elseif (Auth::user()->role == 2)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Guru</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('guru/jurnal')}}"><i class="fa fa-circle-o"></i> Jurnal</a></li>
        <li><a href="{{url('guru')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
        <li><a href="{{url('guru/absen')}}"><i class="fa fa-circle-o"></i> Riwayat Absen</a></li>
        <li><a href="{{url('guru/uploadG')}}"><i class="fa fa-circle-o"></i> Upload Perangkat</a></li>
        <li><a href="{{url('guru/dokumen') }}"><i class="fa fa-circle-o"></i> Dokumen Kurikulum</a></li>
        @if(Auth::user()->id == 31)
        <li>
            <a href="{{ url('/guru/koperasi')}}"><i class="fa fa-circle-o"></i>Data Upload Siswa Baru</a>
        </li>
        @endif
        @if(Auth::user()->id == 34)
        <li><a href="{{url('/admin/AdminAbsen/RGBulanan')}}"><i class="fa fa-circle-o"></i> Rekap Guru Bulanan</a></li>
        @endif
    </ul>
</li>
@if(Auth::user()->evaluasi)
<li class="treeview">
    <a href="#">
        <i class="fa fa-users"></i>
        <span>Evaluasi</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('/guru/kurikulum/cekSoal') }}"><i class="fa fa-circle-o"></i>Cek Soal</a></li>
        <li><a href="{{ url('/guru/evaluasi/soalnya') }}"><i class="fa fa-circle-o"></i>Soalnya</a></li>
        <li><a href="{{ url('/guru/evaluasi/uploadRapor') }}"><i class="fa fa-circle-o"></i>Upload Rapor</a></li>
        <li><a href="{{ url('/guru/evaluasi/HUR') }}"><i class="fa fa-circle-o"></i>Hasil Unggah Rapor</a></li>
    </ul>
</li>
@endif
@if(Auth::user()->asistens)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Pengembang Kurikulum</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('/guru/kurikulum/cekSoal') }}"><i class="fa fa-circle-o"></i>Cek Soal</a></li>
        <li><a href="{{ url('/guru/kurikulum/cekKisi') }}"><i class="fa fa-circle-o"></i>Kisi Kisi Soal</a></li>
        <li><a href="{{ url('/guru/kurikulum/cekPerangkat') }}"><i class="fa fa-circle-o"></i>Perangkat Guru</a></li>
        <li><a href="{{ url('/guru/kurikulum/penelaah') }}"><i class="fa fa-circle-o"></i>Penelaah Soal</a></li>
        <li><a href="{{ url('/guru/kurikulum/remainders') }}"><i class="fa fa-circle-o"></i>Remainders</a></li>
        <li><a href="{{ url('/guru/kurikulum/ptm') }}"><i class="fa fa-circle-o"></i>Hasil Angket PTM</a></li>
    </ul>
</li>

@endif
<!-- untuk membuat role guru yg sks -->
@if(Auth::user()->subRole == 1)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>SKS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> PJJ
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ url('guru/pjj') }}"><i class="fa fa-circle-o"></i>Pemberian Materi</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-user"></i> PKPD
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('/guru/sks/setKd')}}"><i class="fa fa-circle-o"></i>Set KD</a></li>
                <!-- <li><a href="{{url('/guru/sks/penH')}}"><i class="fa fa-circle-o"></i>Penilaian Harian</a></li> -->
                <!-- <li><a href="{{url('/guru/sks/fmkls')}}"><i class="fa fa-circle-o"></i>PPD</a> -->
        </li>
        <li><a href="{{ url('guru/sks/eximp') }}"><i class="fa fa-circle-o"></i>Import Excel</a></li>
        <li><a href="{{url('/guru/sks/cekProf')}}"><i class="fa fa-circle-o"></i>Cek Profile</a></li>
        <!-- <li><a href="{{ url('/admin/sks/npk') }}"><i class="fa fa-circle-o"></i>Cek Nilai Mapel</a> -->
</li>
@if(Auth::user()->id == 19 || Auth::user()->id == 1)
<li><a href="{{url('/guru/sks/cekPro')}}"><i class="fa fa-circle-o"></i>Cek Profile Siswa Per Kelas</a>
</li>
@endif
</ul>
</li>
@if(isset(Auth::user()->pa))
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i> WALI
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li><a href="{{ url('guru/cetak/profile') }}"><i class="fa fa-circle-o"></i>Cetak Profil</a></li>
    </ul>
</li>
@endif

</ul>
<ul class="treeview-menu" style="display: none;">
    <li class="treeview">
        <a href="#"><i class="fa fa-user"></i> Wali Kelas
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ '/guru/cekNilai' }}"><i class="fa fa-circle-o"></i>Pengecekan Nilai UKBM</a></li>
        </ul>
    </li>
</ul>
{{-- <ul class="treeview-menu">--}}
{{-- <li><a href={{url("guru/sks")}}><i class="fa fa-circle-o"></i>Profil Peserta Didik</a>
</li>--}}
{{-- <li><a href={{url("guru/sks/up")}}><i class="fa fa-circle-o"></i>Upload Pembelajaran</a></li>--}}
{{-- <li><a href={{url("guru/sks/inKel")}}><i class="fa fa-circle-o"></i>Akses File UKBM</a></li>--}}
{{-- <li><a href="{{url("guru/sks/formuh")}}"><i class="fa fa-circle-o"></i>Penilaian Harian(PH)</a></li>--}}
{{-- <li><a href={{url("guru/sks/hasil")}}><i class="fa fa-circle-o"></i>Hasil Penilaian Guru</a></li>--}}
{{-- <li><a href={{url("guru/sks/lengkap")}}><i class="fa fa-circle-o"></i>Proses Nilai</a></li>--}}
{{-- <li><a href="{{ url('guru/sks/formKD') }}"><i class="fa fa-circle-o"></i>Pembuatan KD</a></li>--}}
{{-- <li><a href="{{ url('guru/sks/penilaian') }}"><i class="fa fa-circle-o"></i>Penilaian KD</a></li>--}}
{{-- </ul>--}}
@endif
<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i>
        <span>Quiz</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ '/guru/eva/upKisi' }}"><i class="fa fa-circle-o"></i>Upload Kisi kisi</a></li>
        <li><a href="{{'/guru/eva/test'}}"><i class="fa fa-circle-o"></i>Soal</a></li>
        <li><a href="{{'/guru/eva/view'}}"><i class="fa fa-circle-o"></i>Hasil Soal</a></li>
        <li><a href="{{'/guru/eva/inputKd'}}"><i class="fa fa-circle-o"></i>Input KD bahasa Daerah</a></li>
    </ul>
</li>
@if(isset(Auth::user()->bk))
<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i>
        <span>BK</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ '/guru/bk' }}"><i class="fa fa-circle-o"></i>Sebaran Siswa</a></li>
    </ul>
</li>
@endif
{{-- menu untuk PPDB   --}}
@if(Auth::user()->id == 43 OR Auth::user()->id == 37 OR Auth::user()->id == 1 OR Auth::user()->id == 55)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>PPDB 2020</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('guru/casisLeng')}}"><i class="fa fa-circle-o"></i>Cek Siswa Tahap 3</a></li>
    </ul>
</li>
@endif
@if(Auth::user()->tatib == 1)
<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i>
        <span>Poin Siswa</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('guru/Cpoin') }}"><i class="fa fa-book"></i>Input Poin</a></li>
        <li><a href="{{ url('guru/jumpoin') }}"><i class="fa fa-book"></i>Jumlah Poin</a></li>
        <li><a href="{{ url('guru/Ppoint') }}"><i class="fa fa-print"></i>Cetak Point</a></li>
    </ul>
</li>
@endif
<li class="treeview">
    <a href="#">
        <i class="fa fa-arrows"></i>
        <span>Eksternal Link</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a target="_blank" href="{{url('http://erapor.sumenepsmansa.sch.id')}}"><i class="fa fa-circle-o"></i>E
                rapor SMAN 1 SUMENEP</a></li>
        <li><a target="_blank" href="{{url('http://sispena.bansm.or.id')}}"><i class="fa fa-circle-o"></i>Sispena</a>
        </li>
        <li><a target="_blank" href="{{url('http://gerbangkurikulum.psma.kemdikbud.go.id')}}"><i
                    class="fa fa-circle-o"></i>Gerbang Kurikulum</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="{{url('guru/form')}}">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
    </a>
</li>
@elseif (Auth::user()->role == 2)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Guru</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('guru/jurnal')}}"><i class="fa fa-circle-o"></i> Jurnal</a></li>
        <li><a href="{{url('guru')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
        <li><a href="{{url('guru/absen')}}"><i class="fa fa-circle-o"></i> Riwayat Absen</a></li>
        <li><a href="{{url('guru/uploadG')}}"><i class="fa fa-circle-o"></i> Upload Perangkat</a></li>
        <li><a href="{{url('guru/dokumen') }}"><i class="fa fa-circle-o"></i> Dokumen Kurikulum</a></li>
        @if(Auth::user()->id == 34)
        <li><a href="{{url('/admin/AdminAbsen/RGBulanan')}}"><i class="fa fa-circle-o"></i> Rekap Guru Bulanan</a>
        </li>
        @endif
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-arrows"></i>
        <span>Eksternal Link</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a target="_blank" href="{{url('http://erapor.sumenepsmansa.sch.id')}}"><i class="fa fa-circle-o"></i>E
                rapor SMAN 1 SUMENEP</a></li>
        <li><a target="_blank" href="{{url('http://sispena.bansm.or.id')}}"><i class="fa fa-circle-o"></i>Sispena</a>
        </li>
        <li><a target="_blank" href="{{url('http://gerbangkurikulum.psma.kemdikbud.go.id')}}"><i
                    class="fa fa-circle-o"></i>Gerbang Kurikulum</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="{{url('guru/form')}}">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
</li>
@elseif (Auth::user()->role == 3)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Guru</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('piket/jurnal')}}"><i class="fa fa-circle-o"></i> Jurnal</a></li>
        <li><a href="{{url('piket/Absenssiswa')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
        <li><a href="{{url('piket/absen')}}"><i class="fa fa-circle-o"></i> Riwayat Absen</a></li>
        <li><a href="{{url('piket/upload')}}"><i class="fa fa-circle-o"></i> Upload Kelengkapan</a></li>
    </ul>
    @if(Auth::user()->subRole == 1)
<li class="treeview">
    <a href="#">
        <i class="fa fa-arrows"></i>
        <span>SKS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href={{url("piket/sks")}}><i class="fa fa-circle-o"></i>Profil Peserta Didik</a></li>
        <li><a href={{url("piket/sks/up")}}><i class="fa fa-circle-o"></i>Upload Pembelajaran</a></li>
        <li><a href={{url("piket/sks/inKel")}}><i class="fa fa-circle-o"></i>Akses File UKBM</a></li>
        <li><a href="{{url("piket/sks/formuh")}}"><i class="fa fa-circle-o"></i>Penilaian Harian/Ulangan</a></li>
        <li><a href={{url("piket/sks/hasil")}}><i class="fa fa-circle-o"></i>Hasil Penilaian Guru</a></li>
        <li><a href={{url("piket/sks/lengkap")}}><i class="fa fa-circle-o"></i>Proses Nilai</a></li>
    </ul>
    @endif
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Piket</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('piket')}}"><i class="fa fa-circle-o"></i> Absen Guru</a></li>
        <li><a href="{{url('piket/show')}}"><i class="fa fa-circle-o"></i> Cek Guru</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="{{url('piket/form')}}">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
</li>
@elseif (Auth::user()->role == 4)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Guru</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('bk/jurnal')}}"><i class="fa fa-circle-o"></i> Jurnal</a></li>
        <li><a href="{{url('bk')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
        <li><a href="{{url('bk/absen')}}"><i class="fa fa-circle-o"></i> Riwayat Absen</a></li>
        <li><a href="{{url('bk/upload')}}"><i class="fa fa-circle-o"></i> Upload Perangkat</a></li>
    </ul>
</li>
@if(Auth::user()->subRole == 1)
<li class="treeview">
    <a href="#">
        <i class="fa fa-arrows"></i>
        <span>SKS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href={{url("bk/sks")}}><i class="fa fa-circle-o"></i>Profil Peserta Didik</a></li>
        <li><a href="{{url("bk/sks/formuh")}}"><i class="fa fa-circle-o"></i>Penilaian Harian/Ulangan</a></li>
        <li><a href={{url("bk/sks/hasil")}}><i class="fa fa-circle-o"></i>Hasil Penilaian Guru</a></li>
        <li><a href={{url("bk/sks/lengkap")}}><i class="fa fa-circle-o"></i>Proses Nilai</a></li>
    </ul>
    @endif
<li class="treeview">
    <a href="#">
        <i class="fa fa-street-view" aria-hidden="true"></i>
        <span>Bimbingan Konseling</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="/bk/edit"><i class="fa fa-circle-o"></i> Edit Absen</a></li>
        <li><a href="/bk/cetak"><i class="fa fa-circle-o"></i> Cetak Absen</a></li>
        <li><a href="{{ '/bk/indexKelas' }}"><i class="fa fa-circle-o"></i> Pindah Kelas</a></li>
    </ul>
</li>
@if(Auth::user()->ket == 'bk')
<li class="treeview">
    <a href="#">
        <i class="fa fa-street-view" aria-hidden="true"></i>
        <span>SKS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ '/bk/cekNilai' }}"><i class="fa fa-circle-o"></i>Pengecekan Nilai</a></li>
    </ul>
</li>
@endif
@if(Auth::user()->status == 'Piket')
<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Piket</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('bk/piket')}}"><i class="fa fa-circle-o"></i> Absen Guru</a></li>
        <li><a href="{{url('bk/show')}}"><i class="fa fa-circle-o"></i> Cek Guru</a></li>
    </ul>
</li>
@endif
<li class="treeview">
    <a href="{{url('guru/form')}}">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
</li>
@elseif (Auth::user()->role == 7)
@elseif (Auth::user()->role == 6)

@if(Auth::user()->ket == "A")
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Siswa</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('siswa/absen')}}"><i class="fa fa-circle-o"></i> Absen Guru</a></li>
        {{--<li><a href="{{url('murid/show')}}"><i class="fa fa-circle-o"></i> Cek Guru</a>
</li>--}}
{{--<li><a href="{{url('murid/denah')}}"><i class="fa fa-circle-o"></i> Laporan</a></li>--}}
<li><a target="_blank" href="{{url('denah')}}"><i class="fa fa-circle-o"></i> Denah</a></li>
</ul>
</li>
@endif
{{-- <li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Angket</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('siswa/angketPtm') }}"><i class="fa fa-circle-o"></i>PTM (PERTEMUAN TATAP MUKA)</a></li>
</ul>
</li> --}}
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Profile Siswa</span>

        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        {{-- <li>
            <a href="{{url('/siswa/ps')}}"><i class="fa fa-circle-o"></i>Profile</a>
</li> --}}
<li><a href="{{url('/siswa/nis')}}"><i class="fa fa-circle-o"></i>NIS</a></li>
<li><a href="{{url('/siswa/rombel')}}"><i class="fa fa-circle-o"></i>Siswa Kelas</a></li>
</ul>
</li>

@if(Auth::user()->nis != 0)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Absensi</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/siswa/hi')}}"><i class="fa fa-circle-o"></i>Absensi Hari ini</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>SKS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/murid/nilaiProfile')}}"><i class="fa fa-circle-o"></i>PKPD</a>
        </li>
        {{-- <li><a href="{{url('murid/ukbm')}}"><i class="fa fa-circle-o"></i> File Pertama UKBM </a>
</li>--}}
{{-- <li><a href="{{url('murid/ukbm1')}}"><i class="fa fa-circle-o"></i> File Lanjutan </a></li>--}}
{{-- <li><a href="{{url('murid')}}"><i class="fa fa-circle-o"></i> KHS </a></li>--}}
{{-- <li><a href="{{url('murid')}}"><i class="fa fa-circle-o"></i> KHS </a></li>--}}
</ul>
</li>
{{-- <li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Rapor</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/murid/downloadRapor')}}"><i class="fa fa-circle-o"></i>Download Rapor</a></li>
</ul>
</li> --}}
<li class="treeview">
    <a href="#">
        <i class="fa fa-amazon"></i>
        <span>DKNR</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i>Setting DKNR</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="{{url('siswa/form')}}">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
    </a>
</li>
@endif
@elseif (Auth::user()->role == 9)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>TU</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/tu/RAbsen')}}"><i class="fa fa-circle-o"></i>Absen Guru</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-envelope"></i>
        <span>E-Surat</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/tu/index')}}"><i class="fa fa-circle-o"></i>Input Surat</a></li>
        <li><a href="{{url('/tu/sm')}}"><i class="fa fa-circle-o"></i>Surat Masuk</a></li>
        <li><a href="{{url('/tu/sk')}}"><i class="fa fa-circle-o"></i>Surat Keluar</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-envelope"></i>
        <span>SPP</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/tu/setSpp')}}"><i class="fa fa-circle-o"></i>Setting SPP</a></li>
        <li><a href="{{url('/tu/bayar')}}"><i class="fa fa-circle-o"></i>Pembayaran SPP</a></li>
    </ul>
</li>
{{-- untuk siswa baru yang baru masuk smansa --}}
@elseif (Auth::user()->role == 99)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Entri Bidodata</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('sibA/index') }}"><i class="fa fa-circle-o"></i>Biodata</a></li>
    </ul>
</li>
{{-- <li class="treeview">
    <a href="#">
        <i class="fa fa-gear"></i>
        <span>Kelengkapan berkas</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('sibA/fw') }}"><i class="fa fa-circle-o"></i>File Wajib</a></li>
</ul>
</li> --}}
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Angket</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('sibA/angket') }}"><i class="fa fa-circle-o"></i>Input Nilai</a></li>
        <li><a href="{{ url('sibA/editN') }}"><i class="fa fa-circle-o"></i>Edit Nilai</a></li>
        <li><a href="{{ url('sibA/InFile') }}"><i class="fa fa-circle-o"></i>Input File</a></li>
    </ul>
</li>
@elseif (Auth::user()->role == 98)
<li class="treeview">
    <a href="{{ url('/ppdb2020/peng') }}">
        <i class="fa fa-bullhorn"></i>
        <span>Pengumuman</span>
    </a>
    <a href="{{ url('/logout') }}">
        <i class="fa fa-sign-out"></i>
        <span>Keluar</span>
    </a>
</li>
@endif
</ul>
