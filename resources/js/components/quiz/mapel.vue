<template>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Setting Komptensi Dasar</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Mapel</label>
                    <div class="col-sm-10">
                        <select name="mapel" class="form-control">
                            <option :value="mapel.id">{{ mapel.mapel }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Rombel</label>
                    <div class="col-sm-10">
                        <select name="rombel" class="form-control" v-model="kat" @change="findKd()">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">KD</label>
                    <div class="col-sm-10">
                        <select name="kd" class="form-control" >
                            <option v-for="(kds, id) in kd" :key="id" :value="kds.id">{{ kds.kd }}</option>
                        </select>
                    </div>
                </div>
            <!-- /.box-footer -->
    </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                mapel:[],
                kd:[],
                kat:'',
            }
        },
        methods:{
            getMapel(){
                axios.get('/admin/pm')
                    .then(({ data }) => (this.mapel = data.mapel))
            },
            findKd(){
                axios.get('/admin/kd/'+this.kat)
                    .then(({data}) => (this.kd = data))
            }
        },
        mounted() {
            this.getMapel()
        }
    }
</script>
