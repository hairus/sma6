<template>
  <section class="content">
    <loading :active.sync="isLoading" :can-cancel="false" :is-full-page="fullPage"></loading>
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pembuatan Kategori Surat</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">
            <div v-if="(errors.length > 0)" class="alert alert-danger" role="alert">
              <ul>
                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
              </ul>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Kategori Surat</label>
              <input
                v-model="kode.katS"
                type="text"
                name="kat"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="Enter Kategori"
                required
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Kode Surat</label>
              <input
                v-model="kode.kodS"
                type="text"
                name="kode"
                class="form-control"
                id="exampleInputPassword1"
                placeholder="Enter Kode"
                required
              />
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button @click.stop.prevent="simpan()" class="btn btn-primary">Simpan</button>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Kode Persuratan</h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input
                  type="text"
                  name="table_search"
                  class="form-control pull-right"
                  placeholder="Search"
                  v-model="search"
                />
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Kode</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for="(kd, index) in filterKat" :key="index">
                  <td>{{ index + 1}}</td>
                  <td>{{ kd.kode }}</td>
                  <td>{{ kd.kat }}</td>
                  <td>
                    <button @click="edit(kd)" class="btn btn-primary">Edit</button>
                    <button @click="hapus(kd)" class="btn btn-danger">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li v-bind:class="[{disabled: !pagination.prev_page_url}]">
                <span @click="getKode(pagination.prev_page_url)">«</span>
              </li>
              <li class="disabled">
                <a href="#">{{ pagination.current_page }} dari {{ pagination.last_page }}</a>
              </li>
              <li v-bind:class="[{disabled: !pagination.next_page_url}]">
                <span @click="getKode(pagination.next_page_url)">»</span>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.box -->
        <!-- general form elements disabled -->
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
      <!-- table responsive -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Surat Keluar Masuk</h3>
            </div>
            <div v-if="(gagal.length > 0)" class="alert alert-danger" role="alert">
              <ul>
                <li v-for="(error, index) in gagal" :key="index">{{ error }}</li>
              </ul>
            </div>
            <!-- /.box-header -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Pilih Katergori Surat</label>
                  <select
                    name="kategori"
                    class="form-control"
                    v-model="surat.list"
                    style="width:100%;"
                  >
                    <option
                      v-for="(kat, index) in kategori"
                      :key="index"
                      v-bind:value="kat.id"
                    >{{ kat.kat }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <b>Keterangan Surat</b>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" value="1" v-model="surat.ket" />
                      Surat Masuk
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" value="2" v-model="surat.ket" />
                      Surat Keluar
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Surat</label>
                  <input
                    type="text"
                    v-model="surat.ns"
                    class="form-control"
                    placeholder="Nomor Surat"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Deskripsi</label>
                  <input
                    v-model="surat.desk"
                    type="text"
                    class="form-control"
                    placeholder="Deskripsi..."
                    required
                  />
                </div>
                <div class="form-group">
                  <label>Scan Surat</label>
                  <input type="file" name="file" class="form-control" v-on:change="onImageChange" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <datetime format="DD-MM-YYYY" v-model="surat.tgl" required></datetime>
                </div>
              </div>
              <div class="box-footer">
                <button
                  @click.stop.prevent="saveSurat()"
                  type="submit"
                  class="btn btn-primary"
                >Simpan</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- data table --->
    </div>
    <!-- /.row -->
    <div>
      <div
        class="modal fade"
        id="form-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            </div>
            <div class="modal-body">
              <div v-if="(errors.length > 0)" class="alert alert-danger" role="alert">
                <ul>
                  <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
              </div>
              <div class="form-group">
                <label>Kategori Surat</label>
                <input
                  type="text"
                  class="form-control"
                  name="kat"
                  placeholder="Enter Kategori"
                  v-model="kode.katS"
                />
              </div>
              <div class="form-group">
                <label>Kategori Surat</label>
                <input
                  type="text"
                  class="form-control"
                  name="kode"
                  placeholder="Enter Kategori"
                  v-model="kode.kodS"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                @click="clear()"
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Close</button>
              <button @click="update()" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      kode: {
        id: "",
        katS: "",
        kodS: ""
      },
      surat: {
        list: "",
        ns: "",
        desk: "",
        tgl: "",
        image: "",
        ket: ""
      },
      kodes: [],
      kategori: [],
      errors: [],
      search: "",
      pagination: {},
      surats: [],
      gagal: [],
      isLoading: false,
      fullPage: true
    };
  },
  methods: {
    showmodal() {
      $("#form-modal").modal("show");
    },
    GetKat() {
      axios.get("api/kat").then(response => {
        this.kategori = response.data.data;
      });
    },
    getKode(page_url) {
      let url = page_url || "api/kode";
      axios
        .get(url)
        .then(response => {
          this.kodes = response.data.data;
          this.createPagination(response.data.meta, response.data.links);
        })
        .catch(error => {
          console.log(error);
        });
    },
    simpan() {
      axios
        .post("api/save", {
          kat: this.kode.katS,
          kode: this.kode.kodS
        })
        .then(response => {
          this.getKode();
          this.clear();
          this.GetKat();
          Toast.fire({
            type: "success",
            title: "Berhasil Input Data"
          });
          this.errors.clear();
        })
        .catch(error => {
          this.errors = [];
          if (error.response.data.errors.kat) {
            this.errors.push(error.response.data.errors.kat[0]);
          }
          if (error.response.data.errors.kode) {
            this.errors.push(error.response.data.errors.kode[0]);
          }
        });
    },
    clear() {
      this.kode.kodS = "";
      this.kode.katS = "";
      this.surat.list = "";
      this.surat.ns = "";
      this.surat.desk = "";
    },
    hapus(kd) {
      Swal.fire({
        title: "Anda Yakin Akan Menghapus kode Surat = " + kd.kat,
        text: "Ini tidak bisa di kembalikan",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("/api/delete/" + kd.id)
            .then(response => {
              this.getKode();
              this.GetKat();
              Swal.fire("DIHAPUS!", "Berhasil Menghapus Data", "success");
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
    },
    edit(kd) {
      this.kode.id = kd.id;
      this.kode.katS = kd.kat;
      this.kode.kodS = kd.kode;
      this.showmodal();
    },
    update() {
      axios
        .put("api/update/" + this.kode.id, {
          kat: this.kode.katS,
          kode: this.kode.kodS
        })
        .then(response => {
          this.clear();
          $("#form-modal").modal("hide");
          this.getKode();
        })
        .catch(error => {
          console.log(error);
        });
    },
    createPagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    onChange() {
      alert("trigger");
    },
    onImageChange(e) {
      let files = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(files);
      reader.onload = e => {
        this.surat.image = e.target.result;
      };
    },
    saveSurat() {
      this.isLoading = true;
      axios
        .post("api/saveSurat", {
          list: this.surat.list,
          ns: this.surat.ns,
          tgl: this.surat.tgl,
          desk: this.surat.desk,
          image: this.surat.image,
          ket: this.surat.ket
        })
        .then(response => {
          Toast.fire({
            type: "success",
            title: "Berhasil Input Data"
          });
          this.getKode();
          this.GetKat();
          this.clear();
          this.GetSurat();
          this.isLoading = false;
          this.errors.clear();
        })
        .catch(error => {
          this.isLoading = false;
          this.gagal = [];
          // console.log(error.response.data)
          if (error.response.data.errors.ns) {
            this.gagal.push(error.response.data.errors.ns[0]);
          }
          if (error.response.data.errors.desk) {
            this.gagal.push(error.response.data.errors.desk[0]);
          }
          if (error.response.data.errors.image) {
            this.gagal.push(error.response.data.errors.image[0]);
          }
        });
    },
    GetSurat() {
      axios.get("api/shi").then(response => {
        this.surats = response.data.data;
      });
    },
    del(srt) {
      Swal.fire({
        title: "Anda Yakin Akan Menghapus Kode Surat = (" + srt.ns + ")",
        text: "Ini tidak bisa di kembalikan",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("api/delete/" + srt.id)
            .then(response => {
              this.GetSurat();
              Swal.fire("DIHAPUS!", "Berhasil Menghapus Data", "success");
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
    }
  },
  components: {
    datetime,
    Loading
  },
  computed: {
    filterKat: function() {
      return this.kodes.filter(kode => {
        return kode.kat.match(this.search);
      });
    }
  },
  mounted() {
    this.getKode();
    this.GetKat();
    this.GetSurat();
  }
};
</script>
