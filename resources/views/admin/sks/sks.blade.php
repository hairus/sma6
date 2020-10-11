@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
<?php
  $user = '';
    if(Auth::user()->role == 1)
      {
           $user = 'admin';
      }
      elseif(Auth::user()->role == 2)
      {
          $user = 'guru';
      }
      elseif(Auth::user()->role == 3)
      {
          $user = 'piket';
      }
      elseif(Auth::user()->role == 4)
      {
          $user = 'bk';
      }
      elseif(Auth::user()->role == 5)
      {
          $user = 'Kepala/wakasek';
      }
      elseif(Auth::user()->role == 6)
      {
          $user = 'siswa';
      }
      elseif(Auth::user()->role == 7)
      {
          $user = 'pengawas';
      }
  ?>
<div id="kosong"></div>
    <div class="col-md-12">
            <div class="form-group">
                <label>Pilih Kelas</label>
                <select class="form-control" id="kls_sks">
                    <option value="0">Pilih kelas</option>
                    @foreach ($kelas as $list)
                        <option value="{{ $list->kd_kelas }}"
                        <?php
                            if(isset($_GET['kelas']))
                            {
                                if($_GET['kelas'] == $list->kd_kelas)
                                    {
                                        echo 'selected="selected"';
                                    }
                            }
                         ?>>{{ $list->nm_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

        @if(isset($_GET['kelas']))

            <div class="form-group">
                <label>Pilih Semester</label>
                <select class="form-control" id="smt">
                    <option value="0" >Semester</option>
                    @foreach ($smt as $smtl)
                        <option value="{{ $smtl->id }}"
                            <?php if(isset($_GET['smt'])){
                                if($_GET['smt'] == $smtl->id)
                                    {
                                        echo 'selected="selected"';
                                    }
                            }?> > {{ $smtl->smt }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Pilih Mapel</label>
                <select class="form-control" id="mapel">
                    <option value="0" >Mapel</option>
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->mapel_id }}"
                        <?php if(isset($_GET['mapel'])){
                            if($_GET['mapel'] == $mapel->mapel_id)
                            {
                                echo 'selected="selected"';
                            }
                        }?> > {{ $mapel->mapSks->mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    @if(isset($_GET['mapel']))
                       @if($_GET['mapel'])
                            <a href="/admin/sks/formAdd?mapel={{ $_GET['mapel'] }}&kelas={{ $_GET['kelas'] }}&smt={{ $_GET['smt'] }}" /><button class="btn btn-info">Tambah UKbm</button></a>
                       @endif
                    @endif
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th style="width: 10px">#</th>
                            <th>Kode</th>
                            <th>Mapel</th>
                            <th>Pasangan KD/RPP ke..</th>
                            <th>Kode UKBM</th>
                            <th>Judul UKBM</th>
                           </tr>
                        <?php
                            $no = 1;
                        ?>
                        @foreach($mapelSks as $kikd)
                        <tr>

                            <td><?php echo $no++; ?></td>
                            <td>{{ $kikd->kode }}</td>
                            <td>{{ $kikd->mapSks->mapel }}</td>
                            <td>{{ $kikd->kdRpp }}</td>
                            <td>{{ $kikd->kdKbm }}</td>
                            <td class="btn-default">
                                <a href="{{URL::to($user.'/sks/tempSks/'.$kikd->id.'?kls='.$_GET['kelas'].'&kdgr='.Auth::user()->id).'&mapel='.$_GET['mapel'].'&idUkbm='.$kikd->id}}"/>{{ $kikd->jdlKbm }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div id="tampil"></div>
</div>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function(){
       /*========membuat form tambahan untuk ukbm ==========*/
       var i = 1;
       $('#tam').click(function(){
           i++;
          $('#isi').append('<input class="form-control" id="form" placeholder="UKBM '+i+'" name="'+i+'" type="email">')
       });

       $('#rem').click(function(){
           $('#form:first').remove()
       });

       /*========== select kelas onchange ==================*/
      $('#kls_sks').on('change', function(){
          var sks = document.getElementById("kls_sks").value;

          window.location.assign("sks?kelas="+sks);
      });

       $('#smt').on('change', function(){
           var smt = document.getElementById("smt").value;

           window.location.assign("sks?kelas="+document.getElementById("kls_sks").value+"&smt="+smt);
       });

       $('#mapel').on('change',function(){
           var kelas = $('#kelas').val();
           var smt = $('#smt').val();
           var mapel = $('#mapel').val();

           window.location.assign("sks?kelas="+document.getElementById("kls_sks").value+"&smt="+smt+"&mapel="+mapel);
       });

   });
</script>
@endsection
