<template>
  <div>
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    ></loading>
    <div class="content">
      <h2 class="page-header">Only Admin to Use Menu</h2>
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="">
                <a href="#admin" data-toggle="tab" aria-expanded="true"
                  >Admin</a
                >
              </li>
              <li class="">
                <a href="#tab_2" data-toggle="tab" aria-expanded="false"
                  >Log</a
                >
              </li>
              <li class="">
                <a href="#tab_3" data-toggle="tab" aria-expanded="false"
                  >Tab 3</a
                >
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="admin">
                <div class="box box-primary">
                  <div class="box-header">
                    <div class="box-title">Helper Penghapusan KD</div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Pilih mapel</label>
                      <select
                        name="siswa"
                        id=""
                        class="form-control"
                        v-model="mapel_id"
                        @change="getSetKd"
                      >
                        <option value="">----</option>
                        <option
                          v-for="mapel in mapels"
                          :key="mapel.index"
                          :value="mapel.id"
                        >
                          {{ mapel.mapel }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div v-show="tampil">
                  <div class="box box-danger">
                    <div class="box-header">
                      <div class="box-title">Data Selected</div>
                    </div>
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <th>#</th>
                            <th>Guru</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Jumlah KD</th>
                            <th>#</th>
                          </thead>
                          <tbody>
                            <tr v-for="(result, index) in setKd" :key="index">
                              <td>{{ index + 1 }}</td>
                              <td>{{ result.guru.name }}</td>
                              <td>{{ result.mapel.mapel }}</td>
                              <td>{{ result.kls.nm_kelas }}</td>
                              <td>{{ result.jumkd }}</td>
                              <td>
                                <button
                                  class="btn btn-danger"
                                  @click="hapus(result.id)"
                                >
                                  Delete
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <div class="box-title">Set kd</div>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="">Pilih mapel</label>
                        <select
                          name="siswa"
                          id=""
                          class="form-control"
                          v-model="mapel_id1"
                        >
                          <option value="">----</option>
                          <option
                            v-for="mapel in mapels1"
                            :key="mapel.index"
                            :value="mapel.id"
                          >
                            {{ mapel.mapel }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Pilih Guru</label>
                        <select
                          name="smt"
                          id=""
                          class="form-control"
                          v-model="guru_id"
                        >
                          <option value="">----</option>
                          <option
                            v-for="guru in gurus"
                            :value="guru.id"
                            :key="guru.id"
                          >
                            {{ guru.name }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Pilih Semester</label>
                        <select
                          name="smt"
                          id=""
                          class="form-control"
                          v-model="smt"
                        >
                          <option value="">----</option>
                          <option v-for="n in 6" :value="n" :key="n">
                            {{ n }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Banyak KD</label>
                        <select
                          name="smt"
                          id=""
                          class="form-control"
                          v-model="kd"
                        >
                          <option value="">----</option>
                          <option v-for="kd in 20" :value="kd" :key="kd">
                            {{ kd }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                          <select name="" id="">
                              <option value="">1</option>
                              <option value="">1</option>
                              <option value="">1</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-Log -->
              <div class="tab-pane" id="tab_2">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="box-title">
                            Log View PKPD
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table responsive">
                            <table class="table table-hover table-borderer">
                                <thead>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Nis</th>
                                    <th>Kelas</th>
                                    <th>Code</th>
                                    <th>created_at</th>
                                    <th>#</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(log, index) in logPkpd" :key="index">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ log.users.name.toUpperCase() }}</td>
                                        <td>{{ log.users.nis }}</td>
                                        <td>{{ log.users.kelas_siswas.kelas.nm_kelas}}</td>
                                        <td>{{ log.code }}</td>
                                        <td><span class="badge bg-green">{{ log.created_at }}</span></td>
                                        <td v-if="log.created_at != log.updated_at"><span class="badge bg-red-gradient">update terahir {{ log.updated_at }}</span></td>
                                        <td v-else><span class="badge bg-aqua-gradient">{{ log.created_at }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged. It was
                popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum passages, and more recently with desktop
                publishing software like Aldus PageMaker including versions of
                Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      isLoading: false,
      fullPage: true,
      mapel_id: "",
      mapel_id1: "",
      tampil: false,
      smt: "",
      guru_id: "",
      kd:'',
        hasil:[]
    };
  },
  methods: {
    getMapel() {
      this.isLoading = true;
      this.$store.dispatch("admin/GetMapel");
    },
    getSetKd() {
      this.tampil = true;
      this.isLoading = true;
      this.$store.dispatch("admin/getSetKd", this.mapel_id);
    },
    getGuru() {
      this.$store.dispatch("admin/getGurus");
    },
    getLogPkpd(){
        this.isLoading = true;
        this.$store.dispatch('admin/logPkpd');
    },
    hapus(id) {
      Swal.fire({
        title: "Anda Yakin Akan Menghapus Setingan Kd",
        text: "Ini tidak bisa di kembalikan",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          this.isLoading = true;
          //   this.$store.dispatch('admin/DelSetKd', id)
        }
      });
    },
  },
  computed: {
    mapels() {
      this.isLoading = false;
      return this.$store.state.admin.mapels;
    },
    mapels1() {
      this.isLoading = false;
      return this.$store.state.admin.mapels;
    },
    setKd() {
      this.isLoading = false;
      return this.$store.state.admin.setKd;
    },
    gurus() {
      return this.$store.state.admin.gurus;
    },
    logPkpd(){
        this.isLoading = false;
        this.hasil = this.$store.state.admin.logpkpd;
        /* untuk membuat order by kelas_id di relation data*/
        return _.orderBy(this.hasil, "users.kelas_siswas.kelas_id");
    },
  },
    created() {
      this.orderHasil;
    },
    components: {
    Loading,
  },
  mounted() {
    this.getMapel();
    this.getGuru();
    this.getLogPkpd();
  },
};
</script>
