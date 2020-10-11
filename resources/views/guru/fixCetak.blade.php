<table class="table table-responsive">
    <tr><td><center>

                <table>
                    <tr>
                        <td><img src="{{ asset('images/jatim.png') }}" width="70" height="100"/></td>
                        <td>&nbsp;</td>
                        <td><div><center>PEMERINTAH PROVINSI JAWA TIMUR
                                    <br />DINAS PENDIDIKAN
                                    <br />SMA NEGERI 1 SUMENEP
                                    <br />Jl. Payudan Timur Telp.(0328) 662368 Fax.(0328) 665987 Sumenep  69411
                                    <br />E-Mail: sumenepsmansa@yahoo.com, Website: www.smansasumenep.sch.id</center></div>
                        </td>
                        <td>&nbsp;</td>
                        <td><img src="{{ asset('images/logoungu.png') }}" width="100" height="100"/></td>
                    </tr>
                </table>
                <!-- kop surat -->
                <div>
                    <h3><center>
                            PROFIL KOMPETENSI PESERTA DIDIK
                            <br />TAHUN PELAJARAN {{ $ta->tahun }}
                        </center>
                    </h3>
                </div>
                <table class="table table-stripped table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td width="300">{{ $bio->users->name }}</td>
                        <td width="150">&nbsp;</td>
                        <td>Kelas/Peminatan</td>
                        <td>:</td>
                        <td width="150">
                            {{ $bio->kelas->nm_kelas }}/
                            @if($bio->kelas->id >= 30)
                            -
                            @else
                            {{ $bio->kelas->jur->jurusan }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{ $bio->users->nis }}</td>
                        <td>&nbsp;</td>
                        <td>Semester</td>
                        <td>:</td>
                        <td>{{ $smt }}</td>
                    </tr>
                </table>

                <table border="1" rules="all" align="left" cellpadding="3" cellspacing="1" class="table table-striped table-bordered alert alert-info">
                    <tr>
                        <th width="1%" rowspan="3" align="center">No</th>
                        <th rowspan="3" align="center" width="50%">MATA PELAJARAN</th>
                        <th colspan="{{ $maxKd*2 }}" align="center">Nilai Kompetensi Dasar (KD) ke-</th>
                        <th rowspan="3">Rerata P</th>
                        <th rowspan="3">Rerata K</th>
                        <th rowspan="3" width="25%">Keterangan</th>
                    </tr>
                    <tr>
                        @for($x = 1; $x <= $maxKd; $x++)
                        <th colspan="2" align="center">{{ $x }}</th>
                        @endfor
                    </tr>
                    <tr>
                        @for($x = 1; $x <= $maxKd; $x++)
                        <th>P</th><th>K</th>
                        @endfor
                    </tr>
                    @php $no = 1 @endphp
                    @foreach($siswa as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->mapel->mapel }}</td>
                        @for($x = 1; $x <= $maxKd; $x++)
                            @php
                                $ta = \App\Models\ta::where('status', 1)->first();
                                $nilai_kd = \App\Models\ppd::where([
                                    ['nis', $bio->nis],
                                    ['kelas_id', $data->kelas_id],
                                    ['smt', $smt],
                                    ['mapel_id', $data->mapel_id],
                                    ['kd', $x],
                                    ['ta_id', $ta->id]
                                ])->first();
                            @endphp
                            <td>
                                @if($nilai_kd['nilaiP'] <= 74)
                                    <p style="color: red">{{ $nilai_kd['nilaiP'] }}</p>
                                    @else
                                {{ $nilai_kd['nilaiP'] }}
                                @endif
                            </td>
                            <td>
                                @if($nilai_kd['nilaiK'] <= 74)
                                    <p style="color: red">{{ $nilai_kd['nilaiK'] }}</p>
                                @else
                                    {{ $nilai_kd['nilaiK'] }}
                                @endif
                            </td>
                        @endfor
                        <td align="center">
                            @php
                                    $rerataP = $nilai_kd = \App\Models\ppd::where([
                                            ['nis', $bio->nis],
                                            ['kelas_id', $data->kelas_id],
                                            ['smt', $smt],
                                            ['mapel_id', $data->mapel_id],
                                            ['ta_id', $ta->id]
                                        ])->avg('nilaiP');
                            @endphp
                            {{ round($rerataP) }}
                        </td>
                        <td align="center">
                            @php
                                $rerataK = $nilai_kd = \App\Models\ppd::where([
                                        ['nis', $bio->nis],
                                        ['kelas_id', $data->kelas_id],
                                        ['smt', $smt],
                                        ['mapel_id', $data->mapel_id],
                                        ['ta_id', $ta->id]
                                    ])->avg('nilaiK');
                            @endphp
                            {{ round($rerataK) }}
                        </td>
                        <td align="center">
                            @php
                                $cepat = \App\Models\ppd::where('mapel_id', $data->mapel_id)
                                                        ->where('ta_id', $ta->id)
                                                        ->where('smt', $smt+1)
                                                        ->where('kelas_id', $data->kelas_id)
                                                        ->where('nis', $nis)
                                                        ->sum('nilaiP');
                            @endphp
                            @if($cepat == 0)
                                Normal
                            @else
                                Mapel Percepatan
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>

            </center>
            {{ $code }}
            <table class="table table-responsive table-stripped table-bordered" cellpadding="1" cellspacing="1">
                <tr>
                    <th>Keterangan</th>
                    <th colspan="6" align="left">:</th>
                </tr>
                <tr>
                    <th>Warna Merah</th>
                    <th>:</th>
                    <td align="left" colspan="2">Siswa Tidak Tuntas</td>
                    <th>&emsp;</th>
                    <th></th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>P</th>
                    <th>:</th>
                    <td align="left">Pengetahuan</td>
                    <th>&emsp13;</th>
                    <th>K</th>
                    <th>:</th>
                    <td align="left" >Keterampilan</td>
                    <th>&emsp13;&nbsp;</th>
                </tr>
                <tr>&nbsp;</tr>
                <tr>
                    <th colspan="7">&nbsp;</th>
                    <td align="right">Sumenep, 06 Oktober {{ date('Y') }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                    <td colspan="4" align="center">Mengetahui</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Orang Tua/Wali,</td>
                    <td colspan="4" align="center">Kepala SMA Negeri 1 Sumenep</td>
                    <td align="center">Wali Kelas,</td>
                </tr>
                    <td colspan="3" align="center"><br><br>-------------------</td>
                <td colspan="4" align="center"><br><br><br><strong><u>Drs. SUKARMAN</u></strong>
                        <br />NIP. 196505251992031014
                    </td>
                    <td align="center"></br></br><b><u>{{ Auth::user()->name}}</u></b></td>
                </td>
            </table>
        </td>
    </tr>
</table>


