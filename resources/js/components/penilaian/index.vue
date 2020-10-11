<template>
    <div class="box">
        <div class="box-header">
            <h3>Penilaian Harian</h3>
        </div>
        <div class="box-body">
    <div class="form">

        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" id="kelas" class="form-control" v-model="kelasnya" @change="kelasChange()">
                <option v-for="kls in kelas" v-bind:value="kls.kelas_id">{{ kls.kls.nm_kelas }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mapel">Mapel</label>
            <select name="mapel" id="mapel" class="form-control" required @change="mapelChange()" v-model="mapel_id">
                <option value="0" selected>----</option>
                <option v-for="mapel in mapels" v-bind:value="mapel.mapel_id">{{ mapel.mapel }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Kd</label>
            <select name="kd" id="kd" class="form-control" v-model="kd_id">
                <option v-for="kd in kds" v-bind:value="kd.id">{{ kd.kd }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jenis Penilaian</label>
            <select name="penilaian" id="penilaian" class="form-control" v-model="pen">
                <option value="utama">Utama</option>
                <option value="r1">Remidi 1</option>
                <option value="r2">Remidi 2</option>
            </select>
        </div>
        <loading v-show="show"></loading>
        <button @click="pilih()" class="btn btn-info">Pilih</button>
        <button @click="reset()" class="btn btn-warning">Reset</button>
    </div>
    </div>
        <div v-if="utama">
            <utama1></utama1>
        </div>
        <div v-if="r1">
            <utama1></utama1>
        </div>
        <div v-if="r2">
            <utama1></utama1>
        </div>
    </div>

</template>
<script>
    export default {
        data(){
            return{
                mapels: '',
                kd_id:'',
                mapel_id:null,
                kds: '',
                kelas:[],
                kelasnya:null,
                utama:false,
                r1:false,
                r2:false,
                pen:'',
                show: false,
                siswa:''
            }
        },
        methods:{
            GetKelas(){
            axios.get('/smansa/public/admin/api/mapel')
                .then(response => {
                    this.kelas = response.data.pkd
                    // console.log(response)
                })
            },
            kelasChange(){
                this.mapels = null,
                axios.get('/smansa/public/admin/api/mapel')
                .then(response => {
                    this.mapels = response.data.data
                    // console.log(response)
                })
                .catch(function (error) {
                    console.log(error);
                });
                if(this.mapels != ''){
                    axios.post('/smansa/public/admin/api/kd',{
                        mapel_idnya : this.mapel_id,
                        kat_kelas: this.kelasnya
                    })
                        .then(response => {
                            this.kds = response.data
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            mapelChange(){
                axios.post('/smansa/public/admin/api/kd',{
                    mapel_idnya : this.mapel_id,
                    kat_kelas: this.kelasnya
                })
                .then(response => {
                    this.kds = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            pilih(){
                this.show = true;
                if(this.pen == 'utama'){
                    // setTimeout(function(){
                    //     this.utama = true;
                    //     this.show = false;
                    //     this.utama = true;
                    // }.bind(this), 5000);


                    this.show = false;
                }else if(this.pen == 'r1'){
                    this.r1 = true
                }else if(this.pen == 'r2'){
                    this.r2 = true
                }else{
                    this.utama = false
                    this.r1 = false
                    this.r2 = false
                    this.pen = ''
                }
                // this.show = false;
            },
            reset(){
                this.utama = false
                this.r1 = false
                this.r2 = false
                this.pen = ''
            }
        },
        mounted() {
            this.GetKelas()
        }
    }

</script>
