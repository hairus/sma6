@extends('/admin/layouts')
@section('breadcum')
    Quiz Penelaah
@endsection
@section('content')
<div class="container">
    <div class="box">
        <div class="box-header">
            <h3>Create Penelaah</h3>
        </div>
        <form action="{{ url('/admin/quiz/savePenelaah') }}" method="post">
            @csrf
             <div class="box-body">
                 <div class="form-group">
                     <label for="">User</label>
                     <select name="user" id="" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                         @foreach($users as $data)
                             <option value="{{ $data->id }}">{{ $data->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div class="form-group">
                     <label for="">Mapel</label>
                     <select class="js-example-basic-multiple form-control" name="mapels[]" multiple="multiple">
                         @foreach($mapel as $data)
                         <option value="{{ $data->id }}">{{ $data->mapel }} || {{ $data->ket }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
            <div class="box-footer">
            <button class="btn btn-info">Simpan</button>
            </div>
        </form>
    </div>

        <div class="box">
            <div class="box-header">
                <h3>Mapel Penelaah</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                    @foreach($penelaah as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->users->name }}</td>
                        <td>{{ $data->mapels->mapel }}</td>
                        <td>
                            <a href="{{ url('/admin/quiz/delPenelaah/'.$data->id) }}">
                            <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
@section('script')
    <script>
        $(function () {
            $('.js-example-basic-multiple').select2();
        })
    </script>
@endsection

