@extends('/admin/layouts')
@section('breadcum')
    Nis
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
   <div class="container">
       <form action="">
           <div class="container">
               <div class="box">
                   <div class="box-header">Nis anda</div>
                   <div class="box-body">
                       <div class="form-group">
                           <div>
                               <input type="text" value="{{ $nis->nis }}" disabled class="form-control">
                           </div>
                       </div>
                       <!-- @if($cek_edit == null)
                           <a href="{{ url('/siswa/eNis') }}">
                                <button class="btn btn-primary" type="button">Edit</button>
                           </a>
                       @endif -->
                   </div>
               </div>
           </div>
       </form>
   </div>
@stop
