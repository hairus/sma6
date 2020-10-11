@extends('admin/layouts')
@section('breadcum')
    SKS
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <form action="/admin/sks/addUkbm" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>KD RPP</label>
                <select class="form-control" id="kd" name="kdRpp">
                    <option value="0">Pilih RPP</option>
                    @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}"
                        <?php
                                if(isset($_GET['idMap']))
                                    {
                                        if($_GET['idMap'] == $mapel->id)
                                            {
                                                echo 'selected="selected"';
                                            }
                                    }
                        ?>
                        >{{ $mapel->kdRpp }}</option>
                    @endforeach
                </select>
                @if(isset($_GET['idMap']))
                    @foreach($subRpp as $list)
                        <li>{{ $list->jdlKbm }} (<b>{{ $list->kdKbm }}</b>)<-- Kode Ukbmnya</li>
                    @endforeach
                @endif()
        </div>
        <div class="form-group">
            <label>Kode Ukbm</label>
            @if(isset($_GET['idMap']))
            <input type="hidden" name="kdKbm1" value="{{ $add->kdRpp }}">
            @endif
            <input type="text" name="kdKbm" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
            <label>Judul Ukbm</label>
                <input type="text" name="jdlKbm" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
            <label>Kat</label>
            <select class="form-control" name="kat">
              @for ($i=1; $i <= 10; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
        </div>
        <button class="btn btn-info"> Simpan</button>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#kd").on('change', function () {
                var val = $('#kd').val();
                var mapel =; {{ $_GET['mapel'] }}
                var kelas =; {{ $_GET['kelas'] }}
                var smt   = {{ $_GET['smt'] }}
                window.location.assign('formAdd?mapel='+mapel+'&kelas='+kelas+'&smt='+smt+'&idMap='+val);
            });

            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
                });
        });
    </script>
@endsection
