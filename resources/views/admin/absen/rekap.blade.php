@extends('admin.layouts')
@section('content')
  <div class="container">
      @foreach ($kelas as $list)
        <a href="/admin/AdminAbsen/cetak/kelas/{{$list->id}}" class="btn btn-primary">
          <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
        </a>
      @endforeach
  </div>
@endsection
