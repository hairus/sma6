@extends('/admin/layouts')
@section('breadcum')
@section('content')
<div class="container">
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
    <div class="row">
        <div class="box">
            <div class="box-header">
                Input Nilai
            </div>
            <div class="box-body">
                <form action="{{ url('sibA/simNilai') }}" method="post">
                    @csrf
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Mapel</th>
                                <th>semester 1</th>
                                <th>semester 2</th>
                                <th>semester 3</th>
                                <th>semester 4</th>
                                <th>semester 5</th>
                                <th>SKTL</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Matematika</td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat1" class="form-control"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat2" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat3" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat4" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat5" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="mat6" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>IPA</td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa1" class="form-control"
                                            required>
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa2" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa3" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa4" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa5" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ipa6" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>IPS</td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips1" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips2" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips3" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips4" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips5" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="100" name="ips6" class="form-control" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="callout callout-danger">
                        <h4>Perhatian</h4>
                        <p>* Jika dengan sengaja menginput nilai dengan tidak benar maka sekolah akan menindak
                            lanjuti
                        </p>
                        <p>* Jika tidak ada SKTL maka nilai di isi 0
                        </p>
                    </div>
                    <button class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
