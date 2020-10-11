@extends('admin.layouts')
@section('breadcum')
Jurnal
@endsection
@section('breadcumSub')
Controller
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="box box-primary">
            <div class="box-body">
                @foreach ($kelas as $list)
                <a href="{{ url('/guru/jurnal/kelas/'.$list->id) }}" class="btn btn-sm bg-green">
                    <option value="{{$list->id}}">{{$list->nm_kelas}}</option>
                </a>
                @endforeach
                <div class="box-footer margin">
                    {{$kelas->links()}}
                </div>
            </div>
        </div>

        <div class="box box-danger">
            <div class="box-header with-border">
                <h2 class="box-title"> Tanggal {{ date('d-m-Y') }} </h2>
                <br>
                <h3 class="box-title">History Jurnal {{Auth::user()->name}} </h3>
            </div>
            <!-- /.box-header -->
            <a href="{{ url('/guru/jurnal/cetak') }}"><button type="button" class="btn btn-sm bg-green btn-flat margin">Cetak Jurnal</button></a>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jam</th>
                            <th>Mapel</th>
                            <th>Kd</th>
                            <th>Materi</th>
                            <th>Siswa</th>
                            <th>Keterangan</th>
                            <th>Tindak Lanjut</th>
                            <th>Smt</th>
                            <th>Waktu</th>
                            <th>TA</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach ($jurnals as $jurnal)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$jurnal->gurus->nama}}</td>
                            <td>{{$jurnal->kelas}}</td>
                            <td>{{$jurnal->jam_ke}}</td>
                            <td>{{$jurnal->mapels->mapel}}</td>
                            <td>{{$jurnal->kikd_ke}}</td>
                            <td>{{$jurnal->materi}}</td>
                            <td>{{$jurnal->siswa}}</td>
                            <td>{{$jurnal->sikap}}</td>
                            <td>{{$jurnal->spi}}</td>
                            <td>{{$jurnal->semester}}</td>
                            <td>{{$jurnal->created_at}}</td>
                            <td>{{$jurnal->ta->tahun}}</td>
                            <td>
                                <a href="/guru/editJur/{{$jurnal->id}}"><button class="btn btn-danger">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ url('/guru/delete/'.$jurnal->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
