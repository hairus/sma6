@extends('/admin/layouts')
@section('breadcum')
    <div class="content-header">CEK PENILAIAN</div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="box box-success">
                <div class="box-header">
                    <h3>PENGECEKAN NILAI PER MAPEL</h3>
                    <hr>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">PILIH SEMESTER</label>
                        <select name="smt" id="smt" class="form-control">
                            <option value="0">------</option>
                            @for($x = 1; $x <= 8; $x++)
                                <option value="{{ $x }}">{{ $x }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Mapel</label>
                        <select name="mapel" id="mapel" class="form-control">
                            <option value="0">------</option>
                            @foreach($mapel as $map)
                                <option value="{{ $map->id }}">{{ $map->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="0">------</option>
                            @foreach($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nm_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary" id="proses">Proses</button>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Table Nilai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead id="barisTh">
                        </thead>
                        <tbody id="barisData">
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

           $('#proses').click(function (e) {
               //e.preventDefault();
               var smt = $("#smt").val();
               var kelas = $('#kelas').val();
               var mapel = $('#mapel').val();
               var rem = $('#barisData').empty();
               $.ajax({
                   url      : '{{ url('admin/sks/npk') }}',
                   method   : 'post',
                   data     : {smt:smt, kelas:kelas, mapel:mapel},
                   success  : function (msg) {
                       //console.log(msg)
                       var count = msg[0].nilai_kd1.length;
                       //console.log(count);
                       var thnya ='';
                       thnya += "<tr>";
                       thnya +="<th>#</th>";
                       thnya +="<th>Nama</th>";
                       for (var j = 1; j <= count; j++){
                           thnya += "<th>P"+j+"</th>";
                           thnya += "<th>K"+j+"</th>";
                       }
                       thnya +="<th>Progres</th>";
                       thnya +="<th>Persen</th>";
                       thnya +="</tr>";
                       $('#barisTh').html(thnya);
                       var nomor=1;
                       $.each(msg, function (index, value) {
                           var td = '';
                           var barisBaru = $('<tr>');
                           td += '<td>'+nomor+'</td>';
                           td += '<td>'+value.nama+'</td>';
                           for(var i = 0; i<= count-1; i++){
                               if(value.nilai_kd1[i].nilaiP < 75)
                               {
                                   td +='<td> <div class="badge bg-red">'+value.nilai_kd1[i].nilaiP+'</div></td>';
                               }else{
                                   td +='<td>'+value.nilai_kd1[i].nilaiP+'</td>';
                               }
                               if(value.nilai_kd1[i].nilaiK < 75)
                               {
                                   td +='<td> <div class="badge bg-red">'+value.nilai_kd1[i].nilaiK+'</div></td>';
                               }else {
                                   td +='<td>'+value.nilai_kd1[i].nilaiK+'</td>';
                               }
                           }
                           td +='<td><div class="progress progress-xs"><div class="progress-bar progress-bar-danger" style="width:' +Math.round((count/count)*100)+'%"></div></div></td>';
                           td +='<td><span class="badge bg-red">'+ Math.round((count/count)*100) +'%</span></td>';
                           nomor++;
                           barisBaru.html(td);
                           var handler = $('#barisData');
                           handler.append(barisBaru);
                       })
                   }
               })

           })
        });
    </script>
@stop
