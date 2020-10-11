@extends('/admin/layouts')
@section('breadcum')
    Biodata
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <form action="{{ url('/sibA/bio') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Data Ayah</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Data Ibu</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Data Wali</a></li>
                                    <li><a href="#tab_5" data-toggle="tab">Data Kelengkapan</a></li>
                                    </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">* Wajib Diisi </label>
                                                </div>
                                            <div class="form-group">
                                                    {{-- <label for="exampleInputEmail1">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="" disabled> --}}
                                                    <input type="hidden" class="form-control" name="id" value="{{ $edit->ppdb->id }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir *</label>
                                                    <input type="text" class="form-control" name="tempat_lahir" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Lahir * ( ** Tanggal-Bulan-Tahun ** ---- Example : 12-12-2000)</label>
                                                    <input type="text" class="form-control" name="tanggal_lahir" value="" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin *</label>
                                                    
                                                    <select class="form-control" name="jk" required>
                                                                <option value=""></option>
                                                                <option value="Laki-Laki">Laki-Laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NISN *</label>
                                                    <input type="text" class="form-control" name="nisn" value="" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Agama *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="agama">
                                                        <option value="0">---------</option>
                                                                @foreach ($agama as $aga)
                                                                <option value="{{ $aga->id }}">{{ $aga->agama }}</option>
                                                                @endforeach       
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat *</label>
                                                    <input type="text" class="form-control" name="alamat" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RT</label>
                                                    <input type="text" class="form-control" name="rt" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RW</label>
                                                    <input type="text" class="form-control" name="rw" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Dusun</label>
                                                    <input type="text" class="form-control" name="dusun" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kelurahan</label>
                                                    <input type="text" class="form-control" name="kelurahan" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kecamatan *</label>
                                                    <input type="text" class="form-control" name="kec_kota"  required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kode Pos *</label>
                                                    <input type="text" class="form-control" name="kode_pos" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tinggal Dengan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="tinggal">
                                                        <option value="0">---------</option>
                                                                @foreach ($tinggal as $ting)
                                                                <option value="{{ $ting->id}}">{{ $ting->tinggal_bersama }}</option>
                                                                @endforeach
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alat Transportasi *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="transport">
                                                        <option value="0">---------</option>
                                                                @foreach ($transport as $trans)
                                                                        <option value="{{ $trans->id}}">{{ $trans->transportasi }}</option>
                                                                @endforeach
                                                     </select>
                                            </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ayah *</label>
                                                    <input type="text" class="form-control" name="namaa" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir *</label>
                                                    <input type="text" class="form-control" name="tahun_lahira" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="jenjangp_a">
                                                                @foreach ($pen_ayah as $pen_a)
                                                                        <option value="{{ $pen_a->id}}">{{ $pen_a->pendidikan}}</option>
                                                                @endforeach
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ayah *</label>
                                                    <select class="form-control" name="gaji_ayah">
                                                                @foreach ($gaji_ayah as $gaji_a)
                                                                        <option value="{{ $gaji_a->id}}">{{ $gaji_a->range}}</option>
                                                                @endforeach
                                                    </select>
                                            </div>   
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Pekerjaan Ayah *</label>
                                                    <select class="form-control" name="pk_ayah">
                                                                @foreach ($pk_ayah as $pk)    
                                                                <option value="{{ $pk->id}}">{{ $pk->pekerjaan_a}}</option>
                                                                @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Ayah *</label>
                                                    <input type="text" class="form-control" name="nika" required>
                                            </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ibu *</label>
                                                    <input type="text" class="form-control" name="namai" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir *</label>
                                                    <input type="text" class="form-control" name="tahun_lahiri" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                        <select class="form-control" name="jenjangp_i">
                                                                @foreach ($pen_ibu as $pen_i)
                                                                        <option value="{{ $pen_i->id}}">{{ $pen_i->pendidikan}}</option>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ibu *</label>
                                                        <select class="form-control" name="gaji_ibu">
                                                                @foreach ($gaji_ibu as $gaji_i)
                                                                        <option value="{{ $gaji_i->id}}">{{ $gaji_i->range}}</option>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pekerjaan Ibu *</label>
                                                        <select class="form-control" name="pk_ibu">
                                                                @foreach ($pk_ibu as $pk_i)
                                                                        <option value="{{ $pk_i->id}}">{{ $pk_i->pekerjaan_a}}</option>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Ibu *</label>
                                                    <input type="text" class="form-control" name="niki" required>
                                            </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Wali</label>
                                                    <input type="text" class="form-control" name="namaw" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir</label>
                                                    <input type="text" class="form-control" name="tahun_lahirw">
                                            </div>
                                            <div class="form-group">
                                                        <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                        <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                        <select class="form-control" name="jenjangp_w">
                                                                    @foreach ($pen_wali as $pen_w)
                                                                            <option value="{{ $pen_w->id}}">{{ $pen_w->pendidikan}}</option>
                                                                    @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Penghasilan Wali</label>
                                                        <select class="form-control" name="gaji_wali">
                                                                        @foreach ($gaji_wali as $gaji_w)
                                                                                <option value="{{ $gaji_w->id}}">{{ $gaji_w->range}}</option>
                                                                        @endforeach
                                                        </select>
                                                </div>
                                            
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Pekerjaan Wali</label>
                                                        <select class="form-control" name="pk_wali">
                                                                @foreach ($pk_wali as $pk_w)
                                                                        <option value="{{ $pk_w->id}}">{{ $pk_w->pekerjaan_a}}</option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Wali</label>
                                                    <input type="text" class="form-control" name="nikw">
                                            </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_5">
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Telepon Rumah</label>
                                                <input type="text" class="form-control" name="telepon">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. HP</label>
                                                <input type="text" class="form-control" name="hp">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Pilih Peminatan</label>
                                                <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                <select class="form-control" name="minat_id">
                                                    <option value="0">---------</option>
                                                            @foreach ($minat as $m)
                                                            <option value="{{ $m->id }}">{{ $m->minat}}</option>
                                                            @endforeach       
                                                 </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Pilih OSN</label>
                                                <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                <select class="form-control" name="osn_id">
                                                    <option value="0">---------</option>
                                                            @foreach ($osn as $o)
                                                            <option value="{{ $o->id }}">{{ $o->osn}}</option>
                                                            @endforeach       
                                                 </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. SKHUN *</label>
                                                <input type="text" class="form-control" name="skhun">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Ijazah *</label>
                                                <input type="text" class="form-control" name="no_ijazah">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Registrasi Akta *</label>
                                                <input type="text" class="form-control" name="no_reg_akta">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Asal Sekolah *</label>
                                                <input type="text" class="form-control" name="asal_sekolah" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Anak Ke *</label>
                                                <input type="text" class="form-control" name="anak_ke" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Penerima KPS</label>
                                                <select class="form-control" name="penerima_kps">
                                                        <option value="0">---------</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KPS</label>
                                                <input type="text" class="form-control" name="no_kps" >
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Penerima KIP</label>
                                                <select class="form-control" name="penerima_kip">
                                                        <option value="0">---------</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KIP</label>
                                                <input type="text" class="form-control" name="no_kip">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Nama KIP</label>
                                                <input type="text" class="form-control" name="nama_kip">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KKS</label>
                                                <input type="text" class="form-control" name="no_kks">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">BANK Penyalur Dana KIP</label>
                                                <input type="text" class="form-control" name="bank">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Rekening</label>
                                                <input type="text" class="form-control" name="no_rek">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Rekening Atas Nama</label>
                                                <input type="text" class="form-control" name="rek_atas_nama">
                                        </div>
                                        {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">INKLUSI</label>
                                                <select class="form-control" name="gaji_wali">
                                                        <option value="0">---------</option>
                                                        @foreach ($kebutuhan as $k)
                                                                <option value="{{ $k->id}}">{{ $k->inklusi}}</option>
                                                        @endforeach
                                                </select>
                                        </div> --}}
                                        <div class="box-footer">
                                                <button type="submit" class="btn btn-info">Simpan</button> 
                                        </div> 
                                    </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection