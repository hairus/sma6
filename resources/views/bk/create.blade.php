@extends('admin.layouts')
@section('breadcum')
  Jurnal
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <hr>
  <div class="container">
    <div class="col-md-8">
    <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Pengisian Jurnal <strong>{{ $kelas->nm_kelas }} </strong></h3> <h3 class="box-title pull-right">{{date('d-F-Y')}}</h3><br>
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
            <form role="form" action="/bk/jurnal/save" method="post">
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
                <label>Pilih Mapel</label>
                <select name="mapel" class="form-control" id='mapel'>
                  <option value="">-- Pilih Mapel --</option>
                  @foreach ($Mapel as $mapel)
                  <option value="{{ $mapel->id }}">{{ $mapel->mapel}}</option>
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
              <label>Materi Pokok</label>
              <input type="text" name="materi" class="form-control">
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
          <!-- /.box-body -->
        </div>
        <div id="info"></div>
  </div>
  </div>

@endsection


<script src="{{asset ('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('change','#mapel', function(){

      var id_mapel = $(this).val();
      var op = '';
      console.log('ini dari id mapel ke', id_mapel, op);
      //console.log(id_mapel);
      $.ajax({
        type  :'get',
        url   :'{!!URL::to('/mapel')!!}',
        data  :{'id':id_mapel},
        success:function(data)
        {
          op += '<option value="0" disabled>Pilih Kompentensi Dasar</option>';

          for (i = 0; i < data.length; i++)
          {
              op += '<option value="'+data[i].isi_kd+'">'+data[i].isi_kd+'</option>';
          }

          document.getElementById('kd').innerHTML = op;

        },
          error:function(xhr,statusTeks,kesalahan) {
            $('#info').text("kesalahan :" +kesalahan);
        }
      });

    });


    //tambah tomboh
    $(document).on('click','#tbh' ,function(){
      var sel = '';
      sel +='<select name="siswa1" class="form-control">'
            @foreach ($siswas as $siswa)+
            '<option value="{{ $siswa->nisn }}">{{ $siswa->nama }}</option>'
            @endforeach+
            '</select>';
            document.getElementById('jadi').innerHTML = sel;
    });
  });
</script>
