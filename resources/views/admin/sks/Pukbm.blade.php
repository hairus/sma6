@extends('/admin/layouts')
@section('breadcum')
    Penyusunan UKBM
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="col-md-12">
        <div class="form-group">
            <label>SEMESTER</label>
            <select class="form-control" id="smt">
                <option value="0">PILIH SEMESTER</option>
                @foreach($smt as $smta)
                <option value="{{ $smta->id }}">{{ $smta->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>PILIH MAPEL</label>
            <select class="form-control" id="kd">
                <option value="0">PILIH MAPEL</option>
                @foreach($mapel as $mapels)
                <option value="{{ $mapels->id }}">{{ $mapels->mapel }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#smt').on('change', function () {
                var id = $('#smt').val();
                window.location.assign('?smt='+id);
            });
        });
    </script>
@endsection