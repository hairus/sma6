<template>
  <div class="conten">
    <div class="container">
      <div class="box">
        <div class="box-header">Masukkan Catatan</div>
        <div class="box-body">
          <div class="form-group">
            <label for>Masukkan Catatan</label>
            <textarea v-model="form.isi" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <button class="btn btn-info" @click="saveTrx">Simpan</button>
        </div>
      </div>
      <hr />
      <div class="box">
        <div class="box-header">Hasil</div>
        <div class="box-body">
          <ul v-for="(item, index) in trx" :key="index">
            <li>
              {{ item.isi }} -
              <span class="badge bg-red">{{ item.persen }}%</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    //   ini cara untuk mengambil id dari url
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var id = urlParams.get("id");
    //================================================
    return {
      form: {
        myid: id,
        isi: ""
      }
    };
  },
  created() {
    this.getTrx();
  },
  computed: {
    trx() {
      return this.$store.state.guru.trx;
    }
  },
  methods: {
    saveTrx() {
      this.$store.dispatch("guru/saveTrx", this.form);
      this.form.isi = "";
    },
    getTrx() {
      this.$store.dispatch("guru/getTrx");
    }
  }
};
</script>
