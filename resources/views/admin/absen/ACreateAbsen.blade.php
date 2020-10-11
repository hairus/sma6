@extends('/admin/layouts')
@section('breadcum')
Absen
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<?php
$user = '';
if (Auth::user()->role == 1) {
    $user = 'admin';
} elseif (Auth::user()->role == 2) {
    $user = 'guru';
} elseif (Auth::user()->role == 3) {
    $user = 'piket';
} elseif (Auth::user()->role == 4) {
    $user = 'bk';
} elseif (Auth::user()->role == 5) {
    $user = 'Kepala/wakasek';
} elseif (Auth::user()->role == 6) {
    $user = 'siswa';
} elseif (Auth::user()->role == 7) {
    $user = 'pengawas';
}
?>

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
@if (session('message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@endif
@if (session('pesan'))
<div class="alert alert-success">
    {{ session('pesan') }}
</div>
@endif


<!-- pembuatan absensi untuk kelas kbdr dan prestasi -->


<div class="container">
    @if($kls->id == 33 OR $kls->id == 32)
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3>Pengabsen : {{Auth::user()->name}}</h3>
                <h3>Kelas : {{ $kls->nm_kelas }}</h1>

                    <div class="form-group">
                        <a href="{{ url('guru/downloadSiswa/'.$kls->id)}}">
                            <button class="btn btn-info">Download Absen</button>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <p><b>MOHON PERHATIAN</b></p>
                            <br>
                            <p>Untuk Kelas <i>KBDR</i> dan <i>Prestasi</i></p>
                            <p>Pengabsenan di kelas ini siswa harus terpilih dengan menggunakan checkbox atau list <b><u><i>("centang")</i></u></b> yang berada di posisi sebelum <b>No</b> tabel di bawah</p>
                        </div>
                    </div>
                    <hr>
                    <form class="form" action="{{ url($user.'/AdminAbsen/kbdrOrPrestasi') }}" method="post">
                        @csrf
                        <div>
                            <div class="checkbox">
                                @for($x= 1; $x <= 13; $x++) <label>
                                    <input type="checkbox" name="jam[]" value="{{$x}}">
                                    Jam {{ $x }}
                                    </label>
                                    @endfor
                            </div>
                        </div>
                        <hr>
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="checboxAll" id="checboxAll"></th>
                                        <th>No</th>
                                        <th>Nis</th>
                                        <th>Nama siswa</th>
                                        <th>Keterangan</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach ($kelas as $list)
                                    <tr>
                                        <td><input type="checkbox" name="check[]" value="{{ $list->users->nis }}" id="" class="check"></td>
                                        <td>{{$no++}}</td>
                                        <td>{{$list->users->nis}}</td>
                                        <td>
                                            <input type="hidden" name="kelas" value="{{ $kelas_id }}">
                                            <input type="hidden" name="nisn[]" value="{{$list->users->nis}}">
                                            <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                            {{strtoupper($list->users->name)}}</td>
                                        <td>
                                            <div class="radio">
                                                <label><input value="masuk" type="radio" name="radio{{$list->users->nis}}" checked="checked">Masuk</label>
                                                <label><input value="sakit" type="radio" name="radio{{$list->users->nis}}">Sakit</label>
                                                <label><input value="ijin" type="radio" name="radio{{$list->users->nis}}">ijin</label>
                                                <label><input value="dispen" type="radio" name="radio{{$list->users->nis}}">Dispen</label>
                                                <label><input value="alpa" type="radio" name="radio{{$list->users->nis}}">Alpa</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ket[]" class="form-control" placeholder="Catatan...">
                                            <input type="hidden" name="date" class="form-control" placeholder="Catatan..." value="<?php echo date('Ymd') ?>">
                                            <input type="hidden" name="ta" class="form-control" placeholder="Catatan..." value="{{$ta->id}}">
                                            <input type="hidden" name="smt" class="form-control" placeholder="Catatan..." value="{{$ta->semester}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@else
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3>Pengabsen : {{Auth::user()->name}}</h3>
            <h3>Kelas : {{ $kls->nm_kelas }}</h1>
                <!-- <a href="{{ url('admin/downloadSiswa/'.$kls->id)}}"> -->
                <div class="form-group">
                    <a href="{{ url('guru/downloadSiswa/'.$kls->id)}}">
                        <button class="btn btn-info">Download Absen</button>
                    </a>
                </div>
                <!-- </a> -->
                <hr>
                <form class="form" action="{{ url($user.'/AdminAbsen') }}" method="post">
                    @csrf
                    <div class="checkbox">
                        @for($x= 1; $x <= 13; $x++) <label>
                            <input type="checkbox" name="jam[]" value="{{$x}}">
                            Jam {{ $x }}
                            </label>
                            @endfor
                    </div>
                    <hr>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama siswa</th>
                                    <th>Keterangan</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                @foreach ($kelas as $list)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$list->users->nis}}</td>
                                    <td>
                                        <input type="hidden" name="kelas" value="{{ $kelas_id }}">
                                        <input type="hidden" name="nisn[]" value="{{$list->users->nis}}">
                                        <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                        {{strtoupper($list->users->name)}}</td>
                                    <td>
                                        <div class="radio">
                                            <label><input value="masuk" type="radio" name="radio{{$list->users->nis}}" checked="checked">Masuk</label>
                                            <label><input value="sakit" type="radio" name="radio{{$list->users->nis}}">Sakit</label>
                                            <label><input value="ijin" type="radio" name="radio{{$list->users->nis}}">ijin</label>
                                            <label><input value="dispen" type="radio" name="radio{{$list->users->nis}}">Dispen</label>
                                            <label><input value="alpa" type="radio" name="radio{{$list->users->nis}}">Alpa</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="ket[]" class="form-control" placeholder="Catatan...">
                                        <input type="hidden" name="date" class="form-control" placeholder="Catatan..." value="<?php echo date('Ymd') ?>">
                                        <input type="hidden" name="ta" class="form-control" placeholder="Catatan..." value="{{$ta->id}}">
                                        <input type="hidden" name="smt" class="form-control" placeholder="Catatan..." value="{{$ta->semester}}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                </form>
        </div>
    </div>
</div>

@endif
</div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#checboxAll").click(function() {
            $('.check').not(this).prop('checked', this.checked);
        });
    })
</script>
@endsection
