@extends('/admin/layouts')
@section('breadcumSub')
    Edit Quiz
    <hr>
@endsection
@section('content')
    <form action="{{ url('/guru/update/soal/'.$soalSaya->id) }}" method="post">
        @method('put')
        @csrf
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Setting Komptensi Dasar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mapel</label>
                        <div class="col-sm-10">
                            <select name="mapel" class="form-control" id="mapel">
                                <option value="{{ $soalSaya->mapel_id }}">{{ $soalSaya->mapels->mapel }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rombel Sebelumnya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $soalSaya->rombel }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rombel</label>
                        <div class="col-sm-10">
                            <select name="rombel" class="form-control" id="rombel">
                                <option value="">---</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">KD Sebelumnya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $soalSaya->kd->kd }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">KD</label>
                        <div class="col-sm-10">
                            <select name="kd" class="form-control" id="kd">
                                <option value="">---</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Input Soal</h3>
        </div>
        <div class="box-body">
            <table border="0" class="table" align="center">
                <tr>
                    <td><button class="btn btn-default">Soal</button></td>
                    <td><textarea name="soal" id="soal" cols="30" rows="10"> {{$soalSaya->soal}} </textarea></td>
                </tr>
                <tr>
                    <td><button class="btn btn-default">A</button></td>
                    <td><textarea name="a" id="a" cols="30" rows="10">{{ $soalSaya->a }}</textarea></td>
                </tr>
                <tr>
                    <td><button class="btn btn-default">B</button></td>
                    <td><textarea name="b" id="b" cols="30" rows="10">{{ $soalSaya->b }}</textarea></td>
                </tr>
                <tr>
                    <td><button class="btn btn-default">C</button></td>
                    <td><textarea name="c" id="c" cols="30" rows="10">{{ $soalSaya->c }}</textarea></td>
                </tr>
                <tr>
                    <td><button class="btn btn-default">D</button></td>
                    <td><textarea name="d" id="d" cols="30" rows="10">{{ $soalSaya->d }}</textarea></td>
                </tr>
                <tr>
                    <td><button class="btn btn-default">E</button></td>
                    <td><textarea name="e" id="e" cols="30" rows="10">{{ $soalSaya->e }}</textarea></td>
                </tr>
                <tr>
                    @if($soalSaya->jawab == 'a')
                    <td><button class="btn btn-default">Jawab</button></td>
                    <td>
                        <select name="jawab" id="" class="form-control">
                            <option value="">----</option>
                            <option value="a" selected>A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </td>
                    @elseif($soalSaya->jawab == 'b')
                        <td><button class="btn btn-default">Jawab</button></td>
                        <td>
                            <select name="jawab" id="" class="form-control">
                                <option value="">----</option>
                                <option value="a">A</option>
                                <option value="b" selected>B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                                <option value="e">E</option>
                            </select>
                        </td>
                    @elseif($soalSaya->jawab == 'c')
                        <td><button class="btn btn-default">Jawab</button></td>
                        <td>
                            <select name="jawab" id="" class="form-control">
                                <option value="">----</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c" selected>C</option>
                                <option value="d">D</option>
                                <option value="e">E</option>
                            </select>
                        </td>
                    @elseif($soalSaya->jawab == 'd')
                        <td><button class="btn btn-default">Jawab</button></td>
                        <td>
                            <select name="jawab" id="" class="form-control">
                                <option value="">----</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d" selected>D</option>
                                <option value="e">E</option>
                            </select>
                        </td>
                    @elseif($soalSaya->jawab == 'e')
                        <td><button class="btn btn-default">Jawab</button></td>
                        <td>
                            <select name="jawab" id="" class="form-control">
                                <option value="">----</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                                <option value="e" selected>E</option>
                            </select>
                        </td>
                    @endif
                </tr>
            </table>
            <br>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </div>
</form>

@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#rombel').change(function () {
        var mapel = $('#mapel').val();
        var rombel = $('#rombel').val();
            $.ajax({
                url:'{{ url('/admin/pm') }}',
                type: 'post',
                data:{rombel:rombel, mapel:mapel},
                success:function (result) {
                    $('#kd').empty();
                    $.each( result, function(k, v) {
                        $('#kd').append('<option value="'+v.id+'">'+v.kd+'</option>')
                    });
                }
            })

        })
    </script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.config.extraPlugins = "base64image,justify";
        CKEDITOR.config.filebrowserUploadMethod = 'form';
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
    </script>
    <script>
        CKEDITOR.replace('soal', options);
        CKEDITOR.replace('a', options);
        CKEDITOR.replace('b', options);
        CKEDITOR.replace('c', options);
        CKEDITOR.replace('d', options);
        CKEDITOR.replace('e', options);
    </script>
@endsection
