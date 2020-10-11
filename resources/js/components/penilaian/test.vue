<template>
    <div class="card">
        <div class="card-header">
            <h3>penilaian Utama</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Utama</th>
                <th>Remidi 1</th>
                <th>Remidi 2</th>
                <th>NR</th>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                siswa:''
            }
        },
        methods: {
            ambidata() {
                axios.post('/smansa/public/admin/api/dataSiswa', {
                    mapel_id: this.mapel_id,
                    kd_id: this.kd_id,
                    kelas_id: this.kelasnya
                })
                    .then(response => {
                        this.siswa = response.data
                        console.log(this.siswa)
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        mounted() {
            this.ambidata();
        }
    }
</script>
