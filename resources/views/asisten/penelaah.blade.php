@extends('/admin/layouts')
@section('breadcum')
    Penelaah soal
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3>Mapel Soal</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="">Mapel</label>
                    <select name="mapel" id="mapel" class="form-control">
                        <option value="">-----</option>
                        @foreach($penelaah as $data)
                        <option value="{{ $data->mapel_id }}">{{ $data->mapels->mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div>
                        <ul id="data">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#mapel').change(function(){
                $('#data').empty();
                var mapel_id = $('#mapel').val();
                $.ajax({
                    url: '{{ url("/admin/asisten/api/") }}',
                    type: 'post',
                    data: {mapel_id: mapel_id},
                    success:function (result) {
                        $.each( result, function(k, v) {
                            $('#data').append('<li value="'+v.guru_id+'"><a href="{{ url("/guru/asisten/penulis")}}/'+v.users.id+'" target="_blank"> <span class="badge bg-blue">'+v.users.name+'</span></a></li>')
                        });
                    }
                })
            })
        });
    </script>
@stop
