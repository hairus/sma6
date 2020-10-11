@extends('admin.layouts')
@section('breadcum')
  Denah
@endsection
@section('breadcumSub')
  Controller
@endsection
@section('content')
<center>
<h1>DENAH SMAN 1 SUMENEP</h1>
</center>

<center>
    <h1>{{ date('H:i')}}</h1>
</center>

<center>
<table class="table table-striped">
  <tr>
      <td align="center">X MIPA 1
        @if($k1 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k1->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k1->ket == 1) Mengajar
          @elseif($k1->ket == 2) Mengajar Ada Tugas
          @elseif($k1->ket == 3) Dinas Luar/ Rapat
          @elseif($k1->ket == 4) Tidak Masuk
          @else($k1->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k1->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k1->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 2
        @if($k2 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k2->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k2->ket == 1) Mengajar
          @elseif($k2->ket == 2) Mengajar Ada Tugas
          @elseif($k2->ket == 3) Dinas Luar/ Rapat
          @elseif($k2->ket == 4) Tidak Masuk
          @else($k2->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k2->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k2->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 3
        @if($k3 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k3->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k3->ket == 1) Mengajar
          @elseif($k3->ket == 2) Mengajar Ada Tugas
          @elseif($k3->ket == 3) Dinas Luar/ Rapat
          @elseif($k3->ket == 4) Tidak Masuk
          @else($k1->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k3->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k3->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 4
        @if($k4 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k4->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k4->ket == 1) Mengajar
          @elseif($k4->ket == 2) Mengajar Ada Tugas
          @elseif($k4->ket == 3) Dinas Luar/ Rapat
          @elseif($k4->ket == 4) Tidak Masuk
          @else($k2->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k4->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k4->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 5
        @if($k5 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k5->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k5->ket == 1) Mengajar
          @elseif($k5->ket == 2) Mengajar Ada Tugas
          @elseif($k5->ket == 3) Dinas Luar/ Rapat
          @elseif($k5->ket == 4) Tidak Masuk
          @else($k1->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k5->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k5->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 6
        @if($k6 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k6->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k6->ket == 1) Mengajar
          @elseif($k6->ket == 2) Mengajar Ada Tugas
          @elseif($k6->ket == 3) Dinas Luar/ Rapat
          @elseif($k6->ket == 4) Tidak Masuk
          @else($k2->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k6->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k6->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 7
        @if($k7 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k7->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k7->ket == 1) Mengajar
          @elseif($k7->ket == 2) Mengajar Ada Tugas
          @elseif($k7->ket == 3) Dinas Luar/ Rapat
          @elseif($k7->ket == 4) Tidak Masuk
          @else($k1->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k7->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k7->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X MIPA 8
        @if($k8 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k8->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k8->ket == 1) Mengajar
          @elseif($k8->ket == 2) Mengajar Ada Tugas
          @elseif($k8->ket == 3) Dinas Luar/ Rapat
          @elseif($k8->ket == 4) Tidak Masuk
          @else($k2->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k8->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k8->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X IPS 1
        @if($k9 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k9->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k9->ket == 1) Mengajar
          @elseif($k9->ket == 2) Mengajar Ada Tugas
          @elseif($k9->ket == 3) Dinas Luar/ Rapat
          @elseif($k9->ket == 4) Tidak Masuk
          @else($k1->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k9->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k9->mapels->mapel}}</b>
        @endif
      </td>

      <td align="center">X IPS 2
        @if($k10 == null)
          <br>BELUM ADA KBM
        @else
          <br>
          Pengajar
          <br>
          <b>{{$k10->gurus->nama}}</b>
          <br>
          keterangan
          <br>
          <b>
          @if($k10->ket == 1) Mengajar
          @elseif($k10->ket == 2) Mengajar Ada Tugas
          @elseif($k10->ket == 3) Dinas Luar/ Rapat
          @elseif($k10->ket == 4) Tidak Masuk
          @else($k2->ket == 5) Tidak Masuk Ada Tugas
          @endif
          </b>
          <br>
          Jam ke
          <br>
          <b>{{$k10->jam_ke}}</b>
          <br>
          Mapel
          <br>
          <b>{{$k10->mapels->mapel}}</b>
        @endif
      </td>
  </tr>
  <tr>
    <td align="center">XI MIPA 1
      @if($k11 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k11->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k11->ket == 1) Mengajar
        @elseif($k11->ket == 2) Mengajar Ada Tugas
        @elseif($k11->ket == 3) Dinas Luar/ Rapat
        @elseif($k11->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k11->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k11->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 2
      @if($k12 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k12->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k12->ket == 1) Mengajar
        @elseif($k12->ket == 2) Mengajar Ada Tugas
        @elseif($k12->ket == 3) Dinas Luar/ Rapat
        @elseif($k12->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k12->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k12->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 3
      @if($k13 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k13->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k13->ket == 1) Mengajar
        @elseif($k13->ket == 2) Mengajar Ada Tugas
        @elseif($k13->ket == 3) Dinas Luar/ Rapat
        @elseif($k13->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k13->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k13->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 4
      @if($k14 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k14->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k14->ket == 1) Mengajar
        @elseif($k14->ket == 2) Mengajar Ada Tugas
        @elseif($k14->ket == 3) Dinas Luar/ Rapat
        @elseif($k14->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k14->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k14->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 5
      @if($k15 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k15->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k15->ket == 1) Mengajar
        @elseif($k15->ket == 2) Mengajar Ada Tugas
        @elseif($k15->ket == 3) Dinas Luar/ Rapat
        @elseif($k15->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k15->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k15->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 6
      @if($k16 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k16->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k16->ket == 1) Mengajar
        @elseif($k16->ket == 2) Mengajar Ada Tugas
        @elseif($k16->ket == 3) Dinas Luar/ Rapat
        @elseif($k16->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k16->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k16->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 7
      @if($k17 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k17->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k17->ket == 1) Mengajar
        @elseif($k17->ket == 2) Mengajar Ada Tugas
        @elseif($k17->ket == 3) Dinas Luar/ Rapat
        @elseif($k17->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k17->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k17->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI MIPA 8
      @if($k18 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k18->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k18->ket == 1) Mengajar
        @elseif($k18->ket == 2) Mengajar Ada Tugas
        @elseif($k18->ket == 3) Dinas Luar/ Rapat
        @elseif($k18->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k18->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k18->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI IPS 1
      @if($k19 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k19->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k19->ket == 1) Mengajar
        @elseif($k19->ket == 2) Mengajar Ada Tugas
        @elseif($k19->ket == 3) Dinas Luar/ Rapat
        @elseif($k19->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k19->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k19->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XI IPS 2
      @if($k20 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k20->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k20->ket == 1) Mengajar
        @elseif($k20->ket == 2) Mengajar Ada Tugas
        @elseif($k20->ket == 3) Dinas Luar/ Rapat
        @elseif($k20->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k20->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k20->mapels->mapel}}</b>
      @endif
    </td>
</tr>
  <tr>
    <td align="center">XII MIPA 1
      @if($k21 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k21->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k21->ket == 1) Mengajar
        @elseif($k21->ket == 2) Mengajar Ada Tugas
        @elseif($k21->ket == 3) Dinas Luar/ Rapat
        @elseif($k21->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k21->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k21->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 2
      @if($k22 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k22->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k22->ket == 1) Mengajar
        @elseif($k22->ket == 2) Mengajar Ada Tugas
        @elseif($k22->ket == 3) Dinas Luar/ Rapat
        @elseif($k22->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k22->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k22->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 3
      @if($k23 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k23->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k23->ket == 1) Mengajar
        @elseif($k23->ket == 2) Mengajar Ada Tugas
        @elseif($k23->ket == 3) Dinas Luar/ Rapat
        @elseif($k23->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k23->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k23->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 4
      @if($k24 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k24->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k24->ket == 1) Mengajar
        @elseif($k24->ket == 2) Mengajar Ada Tugas
        @elseif($k24->ket == 3) Dinas Luar/ Rapat
        @elseif($k24->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k24->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k24->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 5
      @if($k25 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k25->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k25->ket == 1) Mengajar
        @elseif($k25->ket == 2) Mengajar Ada Tugas
        @elseif($k25->ket == 3) Dinas Luar/ Rapat
        @elseif($k25->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k25->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k25->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 6
      @if($k26 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k26->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k26->ket == 1) Mengajar
        @elseif($k26->ket == 2) Mengajar Ada Tugas
        @elseif($k26->ket == 3) Dinas Luar/ Rapat
        @elseif($k26->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k26->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k26->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 7
      @if($k27 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k27->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k27->ket == 1) Mengajar
        @elseif($k27->ket == 2) Mengajar Ada Tugas
        @elseif($k27->ket == 3) Dinas Luar/ Rapat
        @elseif($k27->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k27->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k27->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII MIPA 8
      @if($k28 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k28->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k28->ket == 1) Mengajar
        @elseif($k28->ket == 2) Mengajar Ada Tugas
        @elseif($k28->ket == 3) Dinas Luar/ Rapat
        @elseif($k28->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k28->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k28->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII IPS 1
      @if($k29 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k29->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k29->ket == 1) Mengajar
        @elseif($k29->ket == 2) Mengajar Ada Tugas
        @elseif($k29->ket == 3) Dinas Luar/ Rapat
        @elseif($k29->ket == 4) Tidak Masuk
        @else($k1->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k29->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k29->mapels->mapel}}</b>
      @endif
    </td>

    <td align="center">XII IPS 2
      @if($k30 == null)
        <br>BELUM ADA KBM
      @else
        <br>
        Pengajar
        <br>
        <b>{{$k30->gurus->nama}}</b>
        <br>
        keterangan
        <br>
        <b>
        @if($k30->ket == 1) Mengajar
        @elseif($k30->ket == 2) Mengajar Ada Tugas
        @elseif($k30->ket == 3) Dinas Luar/ Rapat
        @elseif($k30->ket == 4) Tidak Masuk
        @else($k2->ket == 5) Tidak Masuk Ada Tugas
        @endif
        </b>
        <br>
        Jam ke
        <br>
        <b>{{$k30->jam_ke}}</b>
        <br>
        Mapel
        <br>
        <b>{{$k30->mapels->mapel}}</b>
      @endif
    </td>
  </tr>
</table>
</center>
<meta http-equiv="refresh" content="30">
@endsection
