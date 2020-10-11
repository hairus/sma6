@extends('/admin/layouts')
@section('breadcum')
    Evaluasi Unggahan Satu Rapor
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="content">
    <div class="row col-md-12">
    <div class="box">
        <div class="box-header">
            Upload File Rapor Satuan
        </div>
    <div class="box-body">
        <form action="{{ url('/guru/evaluasi/saveSatuFileRapor') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Pilih siswa</label>
                <select name="siswa_id" id="" class="form-control">
                    <option value="">----</option>
                    @foreach($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                    @endforeach
                </select>
                <input type="file" accept="application/pdf" name="rapor" required/>
            </div>
            <button class="btn btn-info">Simpan</button>
        </form>
    </div>
        </div>
    </div>
</div>
@endsection
