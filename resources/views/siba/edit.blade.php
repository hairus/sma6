@extends('/admin/layouts')
@section('breadcum')
    Biodata siswa Baru
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <form action="{{ url('/sibA/bio1/') }}" method="post">
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
                                                    <label for="exampleInputEmail1">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $edit->ppdb->nama }}" disabled>
                                                    <input type="hidden" class="form-control" name="id" value="{{ $edit->ppdb->id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No. Peserta UN</label>
                                                <input type="text" class="form-control" name="nun" value="{{ $edit->ppdb->nun }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir *</label>
                                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ $edit->ppdb->tl }}"required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Lahir * ( ** Tanggal-Bulan-Tahun ** ---- Example : 12-12-2000)</label>
                                                    <input type="text" class="form-control" name="tanggal_lahir" value="{{ $edit->ppdb->ttl }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin *</label>
                                                    
                                                    <select class="form-control" name="jk" required>
                                                                <option value="{{ $edit->ppdb->jk }}">{{ $edit->ppdb->jk }}</option>
                                                                <option value="Laki-Laki">Laki-Laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NISN *</label>
                                                    <input type="text" class="form-control" name="nisn" value="{{ $edit->ppdb->nisn }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Agama *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="agama">
                                                        <option value="0">---------</option>
                                                       {{-- <option value="{{ $edit->agama }}">{{ $edit->ppdb->agama }}</option> --}}
                                                                @foreach ($agama as $aga)
                                                                        <?php 
                                                                        if($edit->ppdb->agama == $aga->id)
                                                                        {
                                                                                echo '<option value="'.$aga->id.'" selected>';
                                                                                echo $aga->agama;
                                                                        }else {
                                                                                echo '<option value="'.$aga->id.'">';
                                                                                echo $aga->agama;
                                                                        }
                                                                        ?>
                                                                        </option>
                                                                @endforeach
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat *</label>
                                                    <input type="text" class="form-control" name="alamat" value="{{ $edit->ppdb->alamat }}"required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RT</label>
                                                    <input type="text" class="form-control" name="rt" value="{{ $edit->ppdb->rt }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">RW</label>
                                                    <input type="text" class="form-control" name="rw" value="{{ $edit->ppdb->rw }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Dusun</label>
                                                    <input type="text" class="form-control" name="dusun" value="{{ $edit->ppdb->dusun }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kelurahan</label>
                                                    <input type="text" class="form-control" name="kelurahan" value="{{ $edit->ppdb->kelurahan }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kecamatan *</label>
                                                    <input type="text" class="form-control" name="kec_kota" value="{{ $edit->ppdb->kec_kota }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Kode Pos *</label>
                                                    <input type="text" class="form-control" name="kode_pos" value="{{ $edit->ppdb->kode_pos }}">
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tinggal Dengan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="tinggal">
                                                        <option value="0">---------</option>
                                                                @foreach ($tinggal as $ting)
                                                                <?php 
                                                                if($edit->ppdb->jenis_tinggal == $ting->id)
                                                                {
                                                                        echo '<option value="'.$ting->id.'" selected>';
                                                                        echo $ting->tinggal_bersama;
                                                                }else {
                                                                        echo '<option value="'.$ting->id.'">';
                                                                        echo $ting->tinggal_bersama;
                                                                }
                                                                ?>
                                                                @endforeach
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Alat Transportasi *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="transport">
                                                        <option value="0">---------</option>
                                                                @foreach ($transport as $trans)
                                                                        {{-- <option value="{{ $trans->id}}">{{ $edit->ppdb->alat_transportasi }}</option> --}}
                                                                        <?php 
                                                                        if($edit->ppdb->alat_transportasi == $trans->id)
                                                                        {
                                                                                echo '<option value="'.$trans->id.'" selected>';
                                                                                echo $trans->transportasi;
                                                                        }else {
                                                                                echo '<option value="'.$trans->id.'">';
                                                                                echo $trans->transportasi;
                                                                        }
                                                                        ?>
                                                                @endforeach
                                                     </select>
                                            </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ayah *</label>
                                                    <input type="text" class="form-control" name="namaa" value="{{ $edit->ppdb->nama_ayah }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir *</label>
                                                    <input type="text" class="form-control" name="tahun_lahira" value="{{ $edit->ppdb->tahun_lahira }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                    <select class="form-control" name="jenjangp_a">
                                                                @foreach ($pen_ayah as $pen_a)
                                                                        {{-- <option value="{{ $pen_a->id}}">{{ $pen_a->pendidikan}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->jenjang_pendidikana == $pen_a->id)
                                                                {
                                                                        echo '<option value="'.$pen_a->id.'" selected>';
                                                                        echo $pen_a->pendidikan;
                                                                }else {
                                                                        echo '<option value="'.$pen_a->id.'">';
                                                                        echo $pen_a->pendidikan;
                                                                }
                                                                ?>
                                                                @endforeach
                                                     </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ayah *</label>
                                                    <select class="form-control" name="gaji_ayah">
                                                                @foreach ($gaji_ayah as $gaji_a)
                                                                        {{-- <option value="{{ $gaji_a->id}}">{{ $gaji_a->range}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->penghasilana == $gaji_a->id)
                                                                {
                                                                        echo '<option value="'.$gaji_a->id.'" selected>';
                                                                        echo $gaji_a->range;
                                                                }else {
                                                                        echo '<option value="'.$gaji_a->id.'">';
                                                                        echo $gaji_a->range;
                                                                }
                                                                ?>
                                                                @endforeach
                                                    </select>
                                            </div>   
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Pekerjaan Ayah *</label>
                                                    <select class="form-control" name="pk_ayah">
                                                                @foreach ($pk_ayah as $pk)
                                                                        
                                                                {{-- <option value="{{ $pk->id}}">{{ $pk->pekerjaan_a}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->pekerjaana == $pk->id)
                                                                {
                                                                        echo '<option value="'.$pk->id.'" selected>';
                                                                        echo $pk->pekerjaan_a;
                                                                }else {
                                                                        echo '<option value="'.$pk->id.'">';
                                                                        echo $pk->pekerjaan_a;
                                                                }
                                                                ?>
                                                                @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Ayah *</label>
                                                    <input type="text" class="form-control" name="nika" value="{{ $edit->ppdb->nika }}" required>
                                            </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Ibu *</label>
                                                    <input type="text" class="form-control" name="namai" value="{{ $edit->ppdb->nama_ibu }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir *</label>
                                                    <input type="text" class="form-control" name="tahun_lahiri" value="{{ $edit->ppdb->tahun_lahiri }}" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenjang Pendidikan *</label>
                                                    <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                        <select class="form-control" name="jenjangp_i">
                                                                @foreach ($pen_ibu as $pen_i)
                                                                        {{-- <option value="{{ $pen_i->id}}">{{ $pen_i->pendidikan}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->jenjang_pendidikani == $pen_i->id)
                                                                {
                                                                        echo '<option value="'.$pen_i->id.'" selected>';
                                                                        echo $pen_i->pendidikan;
                                                                }else {
                                                                        echo '<option value="'.$pen_i->id.'">';
                                                                        echo $pen_i->pendidikan;
                                                                }
                                                                ?>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Penghasilan Ibu *</label>
                                                        <select class="form-control" name="gaji_ibu">
                                                                @foreach ($gaji_ibu as $gaji_i)
                                                                        <option value="{{ $gaji_i->id}}">{{ $gaji_i->range}}</option>
                                                                <?php 
                                                                if($edit->ppdb->penghasilani == $gaji_i->id)
                                                                {
                                                                        echo '<option value="'.$gaji_i->id.'" selected>';
                                                                        echo $gaji_i->range;
                                                                }else {
                                                                        echo '<option value="'.$gaji_i->id.'">';
                                                                        echo $gaji_i->range;
                                                                }
                                                                ?>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pekerjaan Ibu *</label>
                                                        <select class="form-control" name="pk_ibu">
                                                                @foreach ($pk_ibu as $pk_i)
                                                                        {{-- <option value="{{ $pk_i->id}}">{{ $pk_i->pekerjaan_a}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->pekerjaani == $pk_i->id)
                                                                {
                                                                        echo '<option value="'.$pk_i->id.'" selected>';
                                                                        echo $pk_i->pekerjaan_a;
                                                                }else {
                                                                        echo '<option value="'.$pk_i->id.'">';
                                                                        echo $pk_i->pekerjaan_a;
                                                                }
                                                                ?>
                                                                @endforeach
                                                        </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Ibu *</label>
                                                    <input type="text" class="form-control" name="niki" value="{{ $edit->ppdb->niki }}" required>
                                            </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap Wali</label>
                                                    <input type="text" class="form-control" name="namaw" value="{{ $edit->ppdb->nama_wali }}" >
                                            </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Tahun Lahir</label>
                                                    <input type="text" class="form-control" name="tahun_lahirw" value="{{ $edit->ppdb->tahun_lahirw }}">
                                            </div>
                                            <div class="form-group">
                                                        <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                                        <p><span class="bg-danger"><small><i><b></b></i></small></span></p>
                                                        <select class="form-control" name="jenjangp_w">
                                                                    @foreach ($pen_wali as $pen_w)
                                                                            {{-- <option value="{{ $pen_w->id}}">{{ $pen_w->pendidikan}}</option> --}}
                                                                <?php 
                                                                if($edit->ppdb->jenjang_pendidikanw == $pen_w->id)
                                                                {
                                                                        echo '<option value="'.$pen_w->id.'" selected>';
                                                                        echo $pen_w->pendidikan;
                                                                }else {
                                                                        echo '<option value="'.$pen_w->id.'">';
                                                                        echo $pen_w->pendidikan;
                                                                }
                                                                ?>
                                                                    @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="exampleInputEmail1">Penghasilan Wali</label>
                                                        <select class="form-control" name="gaji_wali">
                                                                        @foreach ($gaji_wali as $gaji_w)
                                                                                {{-- <option value="{{ $gaji_w->id}}">{{ $gaji_w->range}}</option> --}}
                                                                        <?php 
                                                                        if($edit->ppdb->penghasilanw == $gaji_w->id)
                                                                        {
                                                                                echo '<option value="'.$gaji_w->id.'" selected>';
                                                                                echo $gaji_w->range;
                                                                        }else {
                                                                                echo '<option value="'.$gaji_w->id.'">';
                                                                                echo $gaji_w->range;
                                                                        }
                                                                        ?>
                                                                        @endforeach
                                                        </select>
                                                </div>
                                            
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Pekerjaan Wali</label>
                                                        <select class="form-control" name="pk_wali">
                                                                @foreach ($pk_wali as $pk_w)
                                                                        {{-- <option value="{{ $pk_w->id}}">{{ $pk_w->pekerjaan_a}}</option> --}}
                                                                        <?php 
                                                                        if($edit->ppdb->pekerjaanw == $pk_w->id)
                                                                        {
                                                                                echo '<option value="'.$pk_w->id.'" selected>';
                                                                                echo $pk_w->pekerjaan_a;
                                                                        }else {
                                                                                echo '<option value="'.$pk_w->id.'">';
                                                                                echo $pk_w->pekerjaan_a;
                                                                        }
                                                                        ?>
                                                                @endforeach
                                                        </select>
                                                </div>
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK Wali</label>
                                                    <input type="text" class="form-control" name="nikw" value="{{ $edit->ppdb->nikw}}">
                                            </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_5">
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Telepon Rumah</label>
                                                <input type="text" class="form-control" name="telepon" value="{{ $edit->ppdb->telepon}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. HP</label>
                                                <input type="text" class="form-control" name="hp" value="{{ $edit->ppdb->hp}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Pilih Minat</label>
                                                        <select class="form-control" name="minat_id">
                                                                @foreach ($minat as $m)
                                                                        {{-- <option value="{{ $pk_w->id}}">{{ $pk_w->pekerjaan_a}}</option> --}}
                                                                        <?php 
                                                                        if($edit->ppdb->minat_id == $m->id)
                                                                        {
                                                                                echo '<option value="'.$m->id.'" selected>';
                                                                                echo $m->minat;
                                                                        }else {
                                                                                echo '<option value="'.$m->id.'">';
                                                                                echo $m->minat;
                                                                        }
                                                                        ?>
                                                                @endforeach
                                                        </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Pilih OSN</label>
                                                        <select class="form-control" name="osn_id">
                                                                @foreach ($osn as $o)
                                                                        {{-- <option value="{{ $pk_w->id}}">{{ $pk_w->pekerjaan_a}}</option> --}}
                                                                        <?php 
                                                                        if($edit->ppdb->osn_id == $o->id)
                                                                        {
                                                                                echo '<option value="'.$o->id.'" selected>';
                                                                                echo $o->osn;
                                                                        }else {
                                                                                echo '<option value="'.$o->id.'">';
                                                                                echo $o->osn;
                                                                        }
                                                                        ?>
                                                                @endforeach
                                                        </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. SKHUN *</label>
                                                <input type="text" class="form-control" name="skhun" value="{{ $edit->ppdb->skhun}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Ijazah *</label>
                                                <input type="text" class="form-control" name="no_ijazah" value="{{ $edit->ppdb->no_ijazah}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Registrasi Akta *</label>
                                                <input type="text" class="form-control" name="no_reg_akta" value="{{ $edit->ppdb->no_reg_akta}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Asal Sekolah *</label>
                                                <input type="text" class="form-control" name="asal_sekolah" value="{{ $edit->ppdb->asal_sekolah}}" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Anak Ke *</label>
                                                <input type="text" class="form-control" name="anak_ke" value="{{ $edit->ppdb->anak_ke}}" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Penerima KPS</label>
                                                <select class="form-control" name="penerima_kps">
                                                        <option value="{{ $edit->ppdb->penerima_kps }}">{{ $edit->ppdb->penerima_kps }}</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KPS</label>
                                                <input type="text" class="form-control" name="no_kps" value="{{ $edit->ppdb->no_kps}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Penerima KIP</label>
                                                <select class="form-control" name="penerima_kip">
                                                        <option value="{{ $edit->ppdb->penerima_kip }}">{{ $edit->ppdb->penerima_kip }}</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KIP</label>
                                                <input type="text" class="form-control" name="no_kip" value="{{ $edit->ppdb->no_kip}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Nama KIP</label>
                                                <input type="text" class="form-control" name="nama_kip" value="{{ $edit->ppdb->nama_kip }}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. KKS</label>
                                                <input type="text" class="form-control" name="no_kks" value="{{ $edit->ppdb->no_kks}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">BANK Penyalur Dana KIP</label>
                                                <input type="text" class="form-control" name="bank" value="{{ $edit->ppdb->bank}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">No. Rekening</label>
                                                <input type="text" class="form-control" name="no_rek" value="{{ $edit->ppdb->no_rek}}">
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Rekening Atas Nama</label>
                                                <input type="text" class="form-control" name="rek_atas_nama" value="{{ $edit->ppdb->rek_atas_nama}}">
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