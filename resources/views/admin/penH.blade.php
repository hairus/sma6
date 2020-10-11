@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Penilaian H</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Petunjuk</h4>
            <ul>
                <li>Jika kelas tidak ada dalam list silakan <b><u><i>set KD</i></u></b> terlebih dahulu</li>
                <li>Pemilihan Mapel Harus sesuai dengan yang di ampu oleh Pengajar</li>
            </ul>
        </div>
        <div class="box">
            <div class="box-header">
                Penilaian
            </div>
            <div class="box-body">
                <form action="{{ url('/guru/sks/penilaian') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Pilih Kelas</label>
                        <select name="kls" id="kls" class="form-control" required>
                            <option value="">---</option>
                            @foreach($kelas as $data)
                            <option value="{{ $data->kelas_id }}">{{  $data->kls->nm_kelas   }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="smt" id="smt" class="form-control">
                            <option value="">---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Mapel</label>
                        <select name="mapel_id" id="" class="form-control" required>
                            <option value="">----</option>
                            @foreach($guru_mapel as $data)
                            <option value="{{ $data->mapel_id }}"> {{ $data->mapels->mapel  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-info">Pilih</button>
                </form>
            </div>
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
        $('#kls').change(function () {
        var kls = $('#kls').val();
            $.ajax({
                url:'{{ url('/guru/klsSmt') }}',
                type: 'post',
                data:{kls:kls},
                success:function (result) {
                    $('#smt').empty();
                    $('#smt').append('<option value="">---</option>')
                    $.each( result, function(k, v) {
                        $('#smt').append('<option value="'+v.id+'">'+v.smt+'</option>')
                    });
                }
            })

        })
</script>
@endsection
