@extends('/admin/layouts')
@section('breadcum')
Profile Nilai
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <div class="box-title">
                    Pilih Semester
                </div>
            </div>
            <div class="box-body">
                <form action="{{ url('/murid/fixCetak') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Pilih semester</label>
                        <select name="smt" id="" class="form-control" required>
                            <option value="">----</option>
                            @for($x = 1; $x <= 6; $x++) <option>{{ $x }}</option>
                                @endfor
                        </select>
                    </div>
                    <button class="btn btn-primary">Pilih</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
