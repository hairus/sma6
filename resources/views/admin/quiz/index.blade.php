@extends('/admin/layouts')
@section('breadcum')
    Quiz
@endsection
@section('content')
    <br>
    <div class="row">
        <div class="col-md-6">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Set Ujian</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                </ul>
                <form action="{{ route('admin.setQ') }}" method="post">
                    {{ csrf_field() }}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label>Tanggal:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="tgl" class="form-control pull-right" id="datepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Ujian</label>
                            <select class="form-control" name="ju" id="ju">
                                <option value="0">--------</option>
                                @foreach($ju as $jenis_ujian )
                                    <option value="{{ $jenis_ujian->id }}">{{ $jenis_ujian->ju }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="kelas">
                            <label for="">Kelas</label>
                            <select class="form-control" name="kelas" id="kls">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                                <label>Mapel</label>
                                <select class="form-control" name="mapel">
                                    @foreach($mapel as $mapels )
                                    <option value="{{ $mapels->id }}">{{ $mapels->mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="jurusan">
                                @foreach($jurusan as $jur )
                                <option value="{{ $jur->id }}">{{ $jur->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kat" class="form-control">
                                @foreach ($kelas as $kel)
                                <option value="{{ $kel->kat_kelas }}">{{ $kel->kat_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>
                    <li><a href="#tab_3-2" data-toggle="tab">Tab 3</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Dropdown <span class="caret"></span>
                        </a>

                    </li>
                    <li class="pull-left header"><i class="fa fa-th"></i>Data Quiz</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Jadwal Quiz</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tbody><tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Ujian</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Kat Kelas</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php
                                            $no = 1;
                                    ?>
                                    @foreach ($op as $ops)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ops->tgl_start }}</td>
                                        <td>{{ $ops->ju->ju }}</td>
                                        <td>{{ $ops->mapel->mapel }}</td>
                                        <td>{{ $ops->kelas['nm_kelas'] }}</td>
                                        <td>{{ $ops->jurusan->jurusan }}</td>
                                        <td><span class="badge bg-green">{{ $ops->kat }}</span></td>
                                        <td>
                                            @if($ops->status == 1)
                                            <a href="{{ url('admin/op/'.$ops->id) }}"><button class="btn btn-success">Aktif</button></a>
                                            @else
                                            <a href="{{ url('admin/opA/'.$ops->id) }}"><button class="btn btn-danger">Non Aktif</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody></table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2-2">
                            <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Jadwal Quiz</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <small class="bg-info">Pengecekan Set ujian</small>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                <th>#</th>
                                                <th>Jenis Ujian</th>
                                                <th>Mapel</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>Kat Kelas</th>
                                                <th>Creator</th>
                                                <th>Tgl input</th>
                                            </tr>
                                            <?php
                                                    $no = 1;
                                            ?>
                                            @foreach ($data as $ops)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $ops->ju->ju }}</td>
                                                <td>{{ $ops->mapel->mapel }}</td>
                                                <td>{{ $ops->kelas['nm_kelas'] }}</td>
                                                <td>{{ $ops->jurusan->jurusan }}</td>
                                                <td><span class="badge bg-green">{{ $ops->kat }}</span></td>
                                                <td><span class="bg-success">{{ $ops->user->name }}</span></td>
                                                <td>{{ $ops->created_at }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody></table>
                                    </div>
                                    <!-- /.box-body -->
        
                                </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@stop
@section('script')
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $('select').select2();
            $('#kelas').hide();
            $('#ju').change(function(){
            $('#kls').empty();
            var ju = $('#ju').val();
            if(ju == 1){
                $('#kelas').show();
                $.ajax({
                    url     : '{{ url('admin/api/ju') }}',
                    method  : 'post',
                    type    : 'json',
                    data    : { ju: ju },
                    success : function(msg){
                       $.map(msg, function(v, i){
                        console.log(v.nm_kelas)
                            $('#kls').append('<option value="'+v.id+'">'+v.nm_kelas+'</option>')
                        })
                    }
                })
            }else{
                $('#kelas').hide();
            }
            });
    });



</script>    
@endsection