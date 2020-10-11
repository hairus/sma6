@extends('/admin/layouts')
@section('breadcum')
    Cetak Point
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Cetak Point</h3>
        </div>
        <div class="box-body">
                <form action="{{ url('guru/prosesCetak') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Range Tanggal</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="tgl" class="form-control pull-right" id="daterange">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <button class="btn btn-info">Cetak</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
@endsection
