@extends('/admin/layouts')
@section('breadcum')

@endsection
@section('content')
    <div class="content">
        <div class="row col-md-12">
            <div class="box-body">
                <div class="class box-body">
                    <div class="row">
                        <div class="class cold-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Data Ayah</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Data Ibu</a></li>
                                <li><a href="#tab_4" data-toggle="tab">Data Wali</a></li>
                                <li><a href="#tab_5" data-toggle="tab">Data Kelengkapan</a></li>
                                </ul>
                                <div class="tab-content">
                                    {{-- ==============Tab 1 Data Diri============= --}}
                                    <div class="tab-pane active" id="tab_1">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $tampil->nama }}" disabled>
                                                    <input type="hidden" class="form-control" name="id" value="{{ $tampil->id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No. Peserta UN</label>
                                                <input type="text" class="form-control" name="nama" value="{{ $tampil->nun }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ $tampil->tl }}"disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" name="tanggal_lahir" value="{{ $tampil->ttl }}" disabled>
                                            </div>
                                            <div class="class from-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" name="tanggal_lahir" value="{{ $tampil->jk }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NISN</label>
                                                    <input type="text" class="form-control" name="nisn" value="{{ $tampil->nisn }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Agama</label>
                                                    <input type="text" class="form-control" name="nisn" value="{{ $tampil->agama1->agama }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat" value="{{ $tampil->alamat }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RT</label>
                                                    <input type="text" class="form-control" name="rt" value="{{ $tampil->rt }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RW</label>
                                                    <input type="text" class="form-control" name="rw" value="{{ $tampil->rw }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Dusun</label>
                                                    <input type="text" class="form-control" name="dusun" value="{{ $tampil->dusun }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kelurahan</label>
                                                    <input type="text" class="form-control" name="kelurahan" value="{{ $tampil->kelurahan }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kecamatan</label>
                                                    <input type="text" class="form-control" name="kec_kota" value="{{ $tampil->kec_kota }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kode Pos</label>
                                                    <input type="text" class="form-control" name="kode_pos" value="{{ $tampil->kode_pos }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tinggal Dengan</label>
                                                    <input type="text" class="form-control" name="tinggal" value="{{ $tampil->tinggal1->tinggal_bersama }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alat Transportasi *</label>
                                                    <input type="text" class="form-control" name="transport" value="{{ $tampil->transportasi->transportasi }}" disabled>
                                            </div>
                                            
                                    </div>

                                    <div class="tab-pane" id="tab_2">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ayah</label>
                                                    <input type="text" class="form-control" name="namaa" value="{{ $tampil->nama_ayah }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir</label>
                                                    <input type="text" class="form-control" name="tahun_lahira" value="{{ $tampil->tahun_lahira }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                    <input type="text" class="form-control" name="jenjangp_a" value="{{ $tampil->jenjanga->pendidikan }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ayah</label>
                                                    <input type="text" class="form-control" name="gaji_ayah" value="{{ $tampil->gajia->range }}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">Pekerjaan Ayah</label>
                                                    <input type="text" class="form-control" name="pk_ayah" value="{{ $tampil->pekerjaan_a->pekerjaan_a }}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">NIK Ayah</label>
                                                    <input type="text" class="form-control" name="nika" value="{{ $tampil->nika }}" disabled>
                                            </div>
                                    </div>

                                    <div class="tab-pane" id="tab_3">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ibu</label>
                                                    <input type="text" class="form-control" name="namai" value="{{ $tampil->nama_ibu }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir</label>
                                                    <input type="text" class="form-control" name="tahun_lahiri" value="{{ $tampil->tahun_lahiri }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                    <input type="text" class="form-control" name="jenjangp_i" value="{{ $tampil->jenjangb->pendidikan }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ibu</label>
                                                    <input type="text" class="form-control" name="gaji_ibu" value="{{ $tampil->gajib->range}}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">Pekerjaan Ibu</label>
                                                    <input type="text" class="form-control" name="pk_ibu" value="{{ $tampil->pekerjaan_i->pekerjaan_a }}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">NIK Ibu</label>
                                                    <input type="text" class="form-control" name="niki" value="{{ $tampil->niki }}" disabled>
                                            </div>
                                    </div>

                                    <div class="tab-pane" id="tab_4">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Wali</label>
                                                    <input type="text" class="form-control" name="namaw" value="{{ $tampil->nama_wali }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir</label>
                                                    <input type="text" class="form-control" name="tahun_lahirw" value="{{ $tampil->tahun_lahirw }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan Wali</label>
                                                    <input type="text" class="form-control" name="jenjangp_w" value="{{ $tampil->jenjangw->pendidikan}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Wali</label>
                                                    <input type="text" class="form-control" name="gaji_wali" value="{{ $tampil->gajiw->range}}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">Pekerjaan Wali</label>
                                                    <input type="text" class="form-control" name="pk_wali" value="{{ $tampil->pekerjaan_w1->pekerjaan_a }}" disabled>
                                            </div>
                                            <div class="class form-group">
                                                    <label for="exampleInputEmail1">NIK Wali</label>
                                                    <input type="text" class="form-control" name="nikw" value="{{ $tampil->nikw }}" disabled>
                                            </div>
                                    </div>

                                    <div class="tab-pane" id="tab_5">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Telepon Rumah</label>
                                                    <input type="text" class="form-control" name="telepon" value="{{ $tampil->telepon}}"disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. HP</label>
                                                    <input type="text" class="form-control" name="hp" value="{{ $tampil->hp}}" disabled>
                                            </div>
                                            <div class="class from-group">
                                                    <label for="exampleInputEmail1">Pilih Minat</label>
                                                    <input type="text" class="form-control" name="hp" value="{{ $tampil->minat1->minat }}" disabled>
                                            </div>
                                            <div class="class from-group">
                                                    <label for="exampleInputEmail1">Pilih OSN</label>
                                                    <input type="text" class="form-control" name="osn_id" value="{{ $tampil->osn1->osn }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. SKHUN</label>
                                                    <input type="text" class="form-control" name="skhun" value="{{ $tampil->skhun}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Ijazah</label>
                                                    <input type="text" class="form-control" name="no_ijazah" value="{{ $tampil->no_ijazah}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Registrasi Akta</label>
                                                    <input type="text" class="form-control" name="no_reg_akta" value="{{ $tampil->no_reg_akta}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Asal Sekolah</label>
                                                    <input type="text" class="form-control" name="asal_sekolah" value="{{ $tampil->asal_sekolah}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Anak Ke</label>
                                                    <input type="text" class="form-control" name="anak_ke" value="{{ $tampil->anak_ke}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penerima KPS</label>
                                                    <input type="text" class="form-control" name="penerima_kps" value="{{ $tampil->penerima_kps}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. KPS</label>
                                                    <input type="text" class="form-control" name="no_kps" value="{{ $tampil->no_kps}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penerima KIP</label>
                                                    <input type="text" class="form-control" name="no_kps" value="{{ $tampil->penerima_kip}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. KIP</label>
                                                    <input type="text" class="form-control" name="no_kip" value="{{ $tampil->no_kip}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama KIP</label>
                                                    <input type="text" class="form-control" name="nama_kip" value="{{ $tampil->nama_kip }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. KKS</label>
                                                    <input type="text" class="form-control" name="no_kks" value="{{ $tampil->no_kks}}"disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">BANK Penyalur Dana KIP</label>
                                                    <input type="text" class="form-control" name="bank" value="{{ $tampil->bank}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Rekening</label>
                                                    <input type="text" class="form-control" name="no_rek" value="{{ $tampil->no_rek}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Rekening Atas Nama</label>
                                                    <input type="text" class="form-control" name="rek_atas_nama" value="{{ $tampil->rek_atas_nama}}" disabled>
                                            </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
@endsection
