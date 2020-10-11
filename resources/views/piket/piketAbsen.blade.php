@extends('/admin/layouts')
@section('breadcum')
  Absen Guru
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container col-md-6">
  <form class="form" action="/piket/simpnguru" method="post">
    <input type="hidden" name="ta" value="{{$ta->id}}">
    <input type="hidden" name="smt" value="{{$ta->semester}}">
    <input type="hidden" name="date" value="{{date('Ymd')}}">
    <input type="hidden" name="pengabsen" value="{{Auth::user()->name}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Guru</label>
        <select name="guru" class="form-control">
          @foreach ($gurus as $guru)
            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
        <label>Kelas</label>
        <select name="kelas" class="form-control">
          @foreach ($kelass as $kelas)
            <option value="{{ $kelas->id }}">{{ $kelas->nm_kelas }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
        <label>Mapel</label>
        <select name="mapel" class="form-control">
          @foreach ($mapels as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->mapel }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
        <label>Jam Ke</label>
        <select name="jam" class="form-control">
        @for ($i=1; $i <= 13; $i++)
          <option>{{ $i }}</option>
        @endfor
      </select>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <select name="ket" class="form-control">
          <option value="1">Mengajar</option>
          <option value="2">Mengajar ada Tugas</option>
          <option value="3">Dinas Luar</option>
          <option value="4">Tidak Masuk</option>
          <option value="5">Tidak Masuk Ada Tugas</option>
      </select>
    </div>

    <div class="form-group">
        <label>catatan</label>
          <div>
            <input type="text" name="catatan" class="form-control" placeholder="Keterangan">
          </div>
    </div>
    <input class="btn btn-primary" type="submit" name="sumbit" value="Simpan">
  </form>
  </div>
@endsection
