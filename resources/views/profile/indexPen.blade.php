@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">Penilaian KD</div>
@endsection
@section('content')
    @php
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
    @endphp
    <form action="{{ route('simppdg') }}" method="post">
        {{ csrf_field() }}
    <div class="content">
        <div class="row">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Penilain Form</h3>
                    <div class="box-body">
                        <input type="hidden" id="klsid" name="klsid" value="{{ $klsid }}">
                        <input type="hidden" id="mapel_id" name="mapel_id" value="{{ $mapel_saya->mapel_id }}">
                        <input type="hidden" id="guru_id" name="guru_id" value="{{ $mapel_saya->guru_id }}">
                        <input type="hidden" id="pkd_id" name="pkd_id" value="{{ $mapel_saya->id }}">
                </div>
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="smt" id="smt" class="form-control">
                            <option value="0">----</option>
                            @foreach($smt as $smt1)
                            <option value="{{ $smt1->smt }}">{{ $smt1->smt }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="">Penilain KD ke - </label>
                            <select name="kd" id="kd" class="form-control">
                                <option value="0">----</option>
                                @for($x = 1; $x <= $jumKdKelas->jumkd; $x++)
                                <option value="{{ $x }}">{{ $x }}</option>
                                @endfor
                            </select>
                        </div>
                        <table class="table table-responsive table-borderer">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nilai Pengetahuan</th>
                                <th>Nilai Keterampilan</th>
                            </tr>
                            </thead>
                            <tbody id="barisData">
                            </tbody>
                        </table>
                    </div>
                <div class="box-footer">
                    <button class="btn btn-info">Save Or Update</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#smt").on('change', function () {
                var smt = $('#smt').val();
                var klsid = $('#klsid').val();
                var opt = '';
                $.ajax({
                    url     : '{{ url('guru/sks/smt1') }}',
                    method  : 'post',
                    data    : {smt:smt, klsid:klsid},
                    success :function (msg) {
                        $.each(msg, function (k, v) {
                            for(var j = 0; j <= v.jumkd; j++){
                            opt += '<option value="'+j+'">'+ j +'</option>';
                            var hand = $('#kd');
                            hand.html(opt);
                            hand.append(hand);
                            }
                        })
                    }
                })
            })
            $("#kd").on('change', function(){
                var kd = $('#kd').val();
                var klsid = $('#klsid').val();
                var guru_id = $('#guru_id').val();
                var mapel_id = $('#mapel_id').val();
                var rem = $('#barisData').empty();
                var smt = $('#smt').val();
                if(kd === 0){

                }else{
                    $.ajax({
                        url: '{{ url('guru/sks/api')}}',
                        method: 'post',
                        data: {kd:kd, kls:klsid, guru_id:guru_id, mapel_id:mapel_id, smt:smt},
                        success: function (msg) {
                             //console.log('cek', msg);
                            var nomor = 1;
                            $.each(msg, function (key, value) {
                                if (value.nis >= 1) {
                                    //console.log('ada data', msg);
                                    var barisBaru = $('<tr>');
                                    barisBaru.html("<td>" + nomor + "</td><td>" + value.siswa.nama + "</td><td><input type='number' class='form-control' name='nis" + value.siswa.nisn + "' value='" + value.nilaiP + "'></td><td><input type='number' class='form-control' name='nisk" + value.nis +"' value='"+value.nilaiK+"'></td>");
                                    var handler = $('#barisData');
                                    handler.append(barisBaru);
                                    nomor++
                                } else {
                                    console.log('dari tidak ada data', value)
                                    var barisBaru = $('<tr>');
                                    barisBaru.html("<td>" + nomor + "</td><td>" + value.nama + "</td><td><input type='number' class='form-control' value='0' name='nis" + value.nisn + "'></td><td><input type='number' class='form-control' value='0' name='nisk" + value.nisn +"'></td>");
                                    var handler = $('#barisData');
                                    handler.append(barisBaru);
                                    nomor++
                                }
                            })
                        }
                    })
                }
            })
        })
    </script>
@stop