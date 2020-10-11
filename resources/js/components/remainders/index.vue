<template>
  <div class="content">
    <div class="container">
      <div v-if="loading" class="loading">Loading...</div>
      <div class="box box-primary">
        <div class="box-header">
          <div class="box-title">Remainder/catatan</div>
        </div>
        <form v-on:submit.prevent="saveRemainders">
          <div class="box-body">
            <div class="form-group">
              <label for>Create Topik</label>
              <input v-model="form.topik" type="text" class="form-control" required />
            </div>
            <div class="form-group">
              <label for>Deskripsi</label>
              <input v-model="form.desk" type="text" class="form-control" required />
            </div>
            <button class="btn btn-info mt-5">
              <i class="fa fa-save"></i> Simpan
            </button>
          </div>
        </form>
      </div>
      <hr />
      <div class="box">
        <div class="box-header">
          <div class="box-title">Result</div>
          <div class="box-body">
            <table class="table">
              <thead>
                <th>No</th>
                <th>Topik</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>#</th>
              </thead>
              <tbody>
                <tr v-for="(topik, index) in Topiks" :key="index">
                  <td>{{ index+1 }}</td>
                  <td>
                    <a :href="'/public/guru/asistenReminder/page?id='+ topik.id">
                      <span class="badge bg-blue">{{ topik.topik }}</span>
                    </a>
                  </td>
                  <td>{{ topik.desk }}</td>
                  <td>{{ topik.created_at }}</td>
                  <td>
                    <button class="btn btn-info" @click="edit(topik.id)">Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
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
            <h5 class="modal-title" id="exampleModalLongTitle">Form Edit</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Topik</label>
              <input
                type="text"
                v-model="editRem.topik"
                class="form-control"
                placeholder="Enter Kategori"
              />
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <input
                type="text"
                v-model="editRem.desk"
                class="form-control"
                placeholder="Enter Kategori"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="update(editRem)">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loading: false,
      form: {
        topik: "",
        desk: ""
      }
    };
  },
  created() {
    this.getTopiks();
  },
  computed: {
    Topiks() {
      return this.$store.state.guru.catatan;
    },
    editRem() {
      return this.$store.state.guru.edit;
    }
  },
  methods: {
    saveRemainders() {
      this.$store.dispatch("guru/saveRem", this.form);
      this.form.topik = "";
      this.form.desk = "";
      Toast.fire({
        type: "success",
        title: "Berhasil Input Data"
      });
      this.getTopiks();
    },
    getTopiks() {
      this.$store.dispatch("guru/getTopiks");
    },
    edit(id) {
      $("#form-modal").modal("show");
      this.$store.dispatch("guru/editRem", id);
    },
    update(update) {
      this.loading = true;
      this.$store.dispatch("guru/updateRem", update);
      $("#form-modal").modal("hide");
      Toast.fire({
        type: "success",
        title: "Berhasil Update Data"
      });
      this.loading = false;
    }
  }
};
</script>
