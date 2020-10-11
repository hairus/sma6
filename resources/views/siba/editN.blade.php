@extends('/admin/layouts')
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
                Edit Nilai
            </div>
            <div class="box-body">
                @if($lock->lock == 1)
                <form action="{{ url('sibA/UpNi') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Mapel</th>
                                <th>Semester1</th>
                                <th>Semester2</th>
                                <th>Semester3</th>
                                <th>Semester4</th>
                                <th>Semester5</th>
                                <th>SKTL</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Matematika</td>
                                    @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                        @endphp
                                        <td>
                                            <input type="number" min="0" maxlength="100" name="mat{{ $x }}"
                                                value="{{ $mat->mat }}" class="form-control">
                                        </td>
                                        @endfor
                                </tr>
                                <tr>
                                    <td>IPA</td>
                                    @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                        @endphp
                                        <td>
                                            <input type="number" min="0" maxlength="100" name="ipa{{ $x }}"
                                                value="{{ $mat->ipa }}" class="form-control">
                                        </td>
                                        @endfor
                                </tr>
                                <tr>
                                    <td>IPS</td>
                                    @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                        @endphp
                                        <td>
                                            <input type="number" min="0" maxlength="100" name="ips{{ $x }}"
                                                value="{{ $mat->ips }}" class="form-control">
                                        </td>
                                        @endfor
                                </tr>
                            </tbody>
                        </table>
                        <div class="callout callout-danger">
                            <h4>Perhatian</h4>
                            <p>* Pengeditan nilai hanya bisa di lakukan <b>1 x</b>, silakan di periksa sebelum melakukan
                                Update Nilai
                            </p>
                            <p>* Jika nilai sudah benar abaikan tombol update</p>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
                @else
                <table class="table table-hover">
                    <thead>
                        <th>Mapel</th>
                        <th>Semester1</th>
                        <th>Semester2</th>
                        <th>Semester3</th>
                        <th>Semester4</th>
                        <th>Semester5</th>
                        <th>SKTL</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Matematika</td>
                            @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                @endphp
                                <td>
                                    <input type="number" min="0" maxlength="100" name="mat{{ $x }}"
                                        value="{{ $mat->mat }}" class="form-control" disabled>
                                </td>
                                @endfor
                        </tr>
                        <tr>
                            <td>IPA</td>
                            @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                @endphp
                                <td>
                                    <input type="number" min="0" maxlength="100" name="ipa{{ $x }}"
                                        value="{{ $mat->ipa }}" class="form-control" disabled>
                                </td>
                                @endfor
                        </tr>
                        <tr>
                            <td>IPS</td>
                            @for ($x = 1; $x <= 6; $x++) @php $mat=$nilai_saya->where('smt', 'smt'.$x)->first()
                                @endphp
                                <td>
                                    <input type="number" min="0" maxlength="100" name="ips{{ $x }}"
                                        value="{{ $mat->ips }}" class="form-control" disabled>
                                </td>
                                @endfor
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="callout callout-danger">
                    <h4>Perhatian</h4>
                    <p>* Nilai anda sudah terkunci</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
