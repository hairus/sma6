@extends('/admin/layouts')
@section('breadcum')
Angket PTM
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        @if (count($errors) > 0)
        <div class="col-6">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="box">
            <div class="box-header">
                <div class="box-title">
                    Angket Pertemuan Tatap Muka
                </div>
            </div>
            <div class="box-body">
                <form action="{{ url('siswa/saveAngketPtm') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radios" id="radio1" class="radio[]" value="1" required>
                                PTM (Pembeljaran Tatap Muka)
                            </label>
                        </div>
                        <div id="pilih"></div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radios" id="radio" class="radio[]" value="2">
                                PJJ (Pembelajaran Jarak Jauh)
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("input[name='radios']").change(function(){
            var radioValue = $("input[name='radios']:checked").val();
                if(radioValue == 1){
                    $('#pilih').append(`
                    <div class="form-group" id="form">
                        <a href="{{ asset('AngketPtm/srt.pdf') }}">
                            <button class="btn btn-success btn-sm" type="button">Download Edaran</button>
                        </a>
                        <a href="{{ asset('AngketPtm/juknis.pdf') }}">
                            <button class="btn btn-success btn-sm" type="button">Download Juknis</button>
                        </a>
                        <a href="{{ asset('AngketPtm/ptm.docx') }}">
                            <button class="btn btn-primary btn-sm" type="button">Download Angket</button>
                        </a>
                        </p>
                            <input type="file" name="upload" required class="form-control">
                            <p class="margin"><code>Silakan di upload dalam bentuk foto berkestensi *.jpg .jpeg</code></p>
                    </div>
                    `)
                }else{
                    $('#form').remove();
                }
        });

    })
</script>
@endsection
