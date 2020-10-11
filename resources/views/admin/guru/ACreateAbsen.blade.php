@extends('/admin/layouts')
@section('breadcum')
Absen
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <h3>Hai {{Auth::user()->status .' - '. Auth::user()->name}}</h3>
    <h1>{{$kelas->nm_kelas}}</h1>

    <form class="form" action="/admin/AdminAbsen" method="post">
        <div class="form-group col-md-3">
            <label for="sel1">Pilih Jam:</label>
            <select name="jam" class="form-control" id="sel1">
                @for ($i=1; $i <= 13; $i++) <option value="{{$i}}">{{$i}}</option>
                    @endfor
            </select>
        </div>
        {{csrf_field()}}
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama siswa</th>
                    <th>Keterangan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                ?>
                @foreach ($kelas->siswas as $list)
                <tr>
                    <td>{{$no++}}</td>
                    <td>
                        <input type="hidden" name="kelas" value="{{$kelas->kd_kelas}}">
                        <input type="hidden" name="nisn{{$list->nisn}}" value="{{$list->nisn}}">
                        <input type="hidden" name="user" value="{{Auth::user()->name}}">
                        {{$list->nama}}</td>
                    <td>
                        <div class="radio">
                            <label><input value="masuk" type="radio" name="radio{{$list->nisn}}" checked="checked">Masuk</label>
                            <label><input value="sakit" type="radio" name="radio{{$list->nisn}}">Sakit</label>
                            <label><input value="ijin" type="radio" name="radio{{$list->nisn}}">ijin</label>
                            <label><input value="dispen" type="radio" name="radio{{$list->nisn}}">Dispen</label>
                            <label><input value="alpa" type="radio" name="radio{{$list->nisn}}">Alpa</label>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="ket{{$list->nisn}}" class="form-control" placeholder="Catatan...">
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
@endsection
