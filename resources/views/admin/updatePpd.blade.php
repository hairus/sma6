@extends('/admin/layouts')
@section('breadcum')
    Update PPD
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">Mapel</div>
            <div class="box-body">
                <form action="{{ url('admin/saveMapelPpd') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Mapel Lama</label>
                        <select name="mapelLawas" id="ml" class="form-control" required>
                            <option value="">----</option>
                            @foreach($mapelLawas as $data)
                                <option value="{{ $data->id }}">{{ $data->mapel }} || {{ $data->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ke mapel baru</label>
                        <select name="mapelBaru" id="" class="form-control" required>
                            <option value="">----</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->mapel }} || {{ $mapel->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $('#ml').change(function () {
               var ml = $('#ml').val();
                $.ajax({
                    url:'{{ url('/admin/mapelPpd/') }}',
                    type: 'post',
                    data:{ml:ml},
                    success:function (result) {
                        alert(result)
                    }
                })
            });
        });
    </script>
@endsection
