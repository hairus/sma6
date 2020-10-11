@extends('/admin/layouts')
@section('breadcum')
    KEY API
@endsection
@section('breadcumSub')
    Controller
@endsection
@section('content')
    <div class="box col-md-6">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@endsection