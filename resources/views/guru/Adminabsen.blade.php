@extends('/admin/layouts')
@section('breadcum')
  Absen
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
  <div class="container">
      @foreach ($kelas as $list)
        <a href="{{ url('guru/kelas/'.$list->id) }}" class="btn btn-primary">
          <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
        </a>
      @endforeach
  </div>
  {{ $kelas->links() }}

@endsection
