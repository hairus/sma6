@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="box-body">
    <form role="form" action="/guru/jurnal/save" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="semester" value="{{$kelas->tas->semester}}">
      <input type="hidden" name="ta" value="{{$kelas->tas->id}}">
      <input type="hidden" name="user" value="{{Auth::user()->name}}">
      <input type="hidden" name="user_id" value="{{Auth::user()->gurus->id}}">
      <input type="hidden" name="kelas" value="{{$kelas->nm_kelas}}">
      <input type="hidden" name="tgl" value="{{date('Ymd')}}">
      <!-- text input -->
      <div class="form-group">
        <h3><label>KEGIATAN PEMBELAJARAN</label></h3>
      </div>
      <div class="form-group">
        <label>Hari Terpilih</label>
        <input type="text" name="materi" class="form-control" value="{{ $kelas->hari }}" disabled>
      </div>
      <div class="form-group">
        <label>Pilih Hari</label>
        <select name="hari" class="form-control">
          <option>Senin</option>
          <option>Selasa</option>
          <option>Rabu</option>
          <option>Kamis</option>
          <option>Jum at</option>
          <option>Sabtu</option>
        </select>
      </div>
      <div class="form-group">
        <label>Mapel Awal</label>
        <input type="text" name="materi" class="form-control" value="{{ $kelas->mapels->mapel }}" disabled>
      </div>
      <div class="form-group">
        <label>Pilih Mapel</label>
        <select name="mapel" class="form-control" id='mapel'>
          <option value="">-- Pilih Mapel --</option>
          @foreach ($Mapel as $mapel)
          <option value="{{ $mapel->id }}">{{ $mapel->mapel}}</option>
          @endforeach
        </select>
      </div>
    <div class="form-group">
      <label>Materi Pokok</label>
      <input type="text" name="materi" class="form-control" value="{{ $kelas->materi }}">
    </div>
    <div class="form-group">
      <label>Jam Awal</label>
      <input type="text" name="materi" class="form-control" value="{{ $kelas->jam_ke }}" disabled>
    </div>
      <div class="form-group">
        <label>Jam-ke</label>
        <select name="jam" class="form-control">
          @for ($i=1; $i <= 13; $i++)
          <option value="{{$i}}">{{$i}}</option>
          @endfor
        </select>
      </div>
      <div class="form-group">
          <input name="bulan" type="hidden" class="form-control" placeholder="{{date('F')}}" disabled="">
      </div>

      <!-- textarea -->
      <div class="form-group">
        <label>KI/KD Awal</label>
        <input type="text" name="materi" class="form-control" value="{{ $kelas->kikd_ke }}" disabled>
      </div>
      <div class="form-group">
        <label>KI/KD</label>
        <textarea name="kikd" class="form-control" rows="3" placeholder="Contoh: 3.1 ini adalah KI/Kd saya"></textarea>
      </div>
      <div class="form-group">
        <h3><label>OBSERVASI SIKAP SPRITUAL & SOSIAL</label></h3>
      </div>
      <div class="form-group">
        <label>Siswa</label>
        <textarea name="siswa" class="form-control" rows="3" placeholder="ketik Nama siswa dan nis"></textarea>
      </div>
      <div class="form-group">
        <label>Catatan  Kejadian/Prilaku/Perubahan yang Positif/Negatif </label>
        <textarea name="sikap" class="form-control" rows="3" placeholder="Enter..."></textarea>
      </div>
      <div class="form-group">
        <label>Tindak Lanjut</label>
        <textarea name="tindak" type="text" class="form-control" placeholder="Sikap Spiritual"></textarea>
      </div>
      <input class="btn btn-primary" type="submit" name="sumbit" value="simpan">
    </form>
  </div>
@endsection
