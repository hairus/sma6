@extends('admin.layouts')
@section('breadcum')
Jurnal
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
{!!
$role = '';
if(Auth::user()->role == 1)
{
$role = 'admin';
}
elseif (Auth::user()->role == 2)
{
$role ='guru';
}
elseif (Auth::user()->role == 3)
{
$role ='piket';
}
elseif (Auth::user()->role == 4)
{
$role ='bk';
}
elseif (Auth::user()->role == 5)
{
$role ='kepala';
}
elseif (Auth::user()->role == 6)
{
$role ='siswa';
}
elseif (Auth::user()->role == 7)
{
$role ='pengawas';
}
!!}
<hr>
<div class="container">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Pengisian Jurnal <strong>{{ $kelas->nm_kelas }} </strong></h3>
                <h3 class="box-title pull-right">{{date('d-F-Y')}}</h3><br>
                <div class="box-title">
                    <li>
                        TA {{$ta->tahun}}
                    </li>
                    <li>
                        Semester {{$ta->semester}}
                    </li>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="{{ url($role.'/jurnal') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="semester" value="{{$ta->semester}}">
                    <input type="hidden" name="ta" value="{{$ta->id}}">
                    <input type="hidden" name="user" value="{{Auth::user()->name}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->gurus->id}}">
                    <input type="hidden" name="kelas" value="{{$kelas->nm_kelas}}">
                    <input type="hidden" name="tgl" value="{{date('Ymd')}}">
                    <!-- text input -->
                    <div class="form-group">
                        <h3><label>KEGIATAN PEMBELAJARAN</label></h3>
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
                    <input type="hidden" name="kat" value="{{ $kelas->kat_kelas }}" id="kat">
                    <div class="form-group">
                        <label>Pilih Mapel</label>
                        <select name="mapel" class="form-control" id='mapel' required>
                            <option value="0">-- Pilih Mapel --</option>
                            @foreach ($Mapel as $mapel)
                            <option value="{{ $mapel->mapel_id }}">{{ $mapel->mapel}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--
            <div class="form-group">
              <label>Kompetensi Dasar</label>
              <select name="kd" class="form-control" id="kd">
                <option value="0">Pilih Kompetensi Dasar</option>
              </select>
            </div>
          -->
                    <div class="form-group">
                        <label>KI/KD</label>
                        <select name="kikd" id="kd" class="form-control">
                            <option value="">----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Materi Pokok</label>
                        <input type="text" name="materi" class="form-control" placeholder="isi materi">
                    </div>
                    <div class="form-group">
                        <label>Silakan Pilih Jam</label>
                        @for($jam = 1; $jam <= 13; $jam++) <div class="checkbox">
                            <label>
                                <input type="checkbox" name="jam{{$jam}}" value="{{$jam}}">
                                Jam {{ $jam }}
                            </label>
                    </div>
                    @endfor
            </div>
            <div class="form-group">
                <input name="bulan" type="hidden" class="form-control" placeholder="{{date('F')}}" disabled="">
            </div>

            <!-- textarea -->

            <div class="form-group">
                <h3><label>OBSERVASI SIKAP SPRITUAL & SOSIAL</label></h3>
            </div>
            <div class="form-group">
                <label>Siswa</label>
                <textarea name="siswa" class="form-control" rows="3" placeholder="ketik Nama siswa dan nis"></textarea>
            </div>
            <div class="form-group">
                <label>Catatan Kejadian/Prilaku/Perubahan yang Positif/Negatif </label>
                <textarea name="sikap" class="form-control" rows="3" placeholder="Enter..."></textarea>
            </div>
            <div class="form-group">
                <label>Tindak Lanjut</label>
                <textarea name="tindak" type="text" class="form-control" placeholder="Sikap Spiritual"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="sumbit" value="simpan">
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <div id="info"></div>
</div>
</div>

@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#mapel').change(function() {
        var mapel = $('#mapel').val();

        var rombel = $('#kat').val();
        $.ajax({
            url: `{{ url('/admin/pm')}}`,
            type: 'post',
            data: {
                rombel: rombel,
                mapel: mapel
            },
            success: function(result) {
                $('#kd').empty();
                $('#kd').append('<option value="Penilain sumatif">Penilaian Sumatif</option>')
                $.each(result, function(k, v) {
                    $('#kd').append('<option value="' + v.kd + '">' + v.kd + '</option>')
                });
            }
        })

    })
</script>
@endsection
