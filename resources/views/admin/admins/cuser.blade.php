@extends('/admin/layouts')
@section('breadcum')
<div class="content-header">Create User</div>
@endsection
@section('content')
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
<div class="content">
    <div class="container">
        <div class="row col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Input Guru Baru
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('Suser') }}" method="post" class="form">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label>NIP</label>
                            <input type="number" name="nip" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label>Role</label>
                            <select name="role" id="" class="form-control">
                                @foreach($role as $roles)
                                <option value="{{ $roles->role_id }}">{{ $roles->ket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="box-header box-danger">
                    <div class="box-title">
                        All User
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>#</th>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge bg-green">{{ $user->name }}</span></td>
                                @if($user->role != 99)
                                <td><span class="badge bg-blue">
                                        {{ $user->roles['ket'] }}
                                    </span>
                                </td>
                                @else
                                <td>-</td>
                                @endif
                                <td>
                                    <form action="{{ '/admin/delusers' }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#table').DataTable();
    })
</script>
@endsection
