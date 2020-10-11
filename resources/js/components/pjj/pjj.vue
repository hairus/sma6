<template>
  <div>
    <div class="form-group">
      <label for>Pilih Kelas</label>
      <select name id class="form-control" v-model="id" @change="getReport()">
        <option>------</option>
        <option
          v-for="(materi, index) in materis1"
          :key="index"
          :value="materi.id"
        >{{ materi.kelas.nm_kelas }}</option>
      </select>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <th>No</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Mapel</th>
          <th>Waktu</th>
        </thead>
        <tbody>
          <tr v-for="(data, index) in dataReport" :key="index">
            <td>{{ index+1 }}</td>
            <td>{{ data.users.name }}</td>
            <td>{{ data.kelas.nm_kelas }}</td>
            <td>{{ data.mapels.mapel }}</td>
            <td>{{ data.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      id: "",
    };
  },
  methods: {
    materis() {
      this.$store.dispatch("guru/kelas"); //untuk menjalankan router contoh http://admin/data
    },
    getReport() {
      this.$store.dispatch("guru/report", this.id);
    },
    posang() {
      this.$store.dispatch("guru/login");
    },
    test() {
      this.$store.dispatch("guru/test");
    },
  },
  computed: {
    materis1() {
      return this.$store.state.guru.materisDay; // untuk mengambil data / hasil dari methods
    },
    dataReport() {
      return this.$store.state.guru.report;
    },
  },
  mounted() {
    return this.test(); //ini di buat agar mentriger si this.getMyMapel di load
  },
};
</script>
