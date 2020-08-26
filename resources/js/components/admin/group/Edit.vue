<template>
    <section class="content">
        <div class="container-fluid">

            <div class="page-header row no-gutters py-4">
                <div class="col-6 text-center text-sm-left mb-0">
                    <h3 class="page-title">{{ $t('group.add_group')}}</h3>
                </div>
                <div class="col-6 text-center text-sm-right mb-0">
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" @click="updateGroup()">
                            {{ $t('group.registered_group')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-8 offset-2">

                    <div class="card" >
                        <div class="card-header border-bottom">
                            <h6 class="m-0">{{ $t('group.info_clinic')}}</h6>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-4">
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ $t('group.name')}} <span class="text-danger">*</span></label>
                                        <input v-model="form.name" type="text" name="name"
                                               :placeholder="$t('group.name')"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ $t('group.portal_code')}}</label>
                                        <input v-model="form.postal_code" type="text" name="name"
                                               :placeholder="$t('group.portal_code_placeholder')"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('postal_code') }">
                                        <has-error :form="form" field="postal_code"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ $t('group.address')}} <span class="text-danger">*</span></label>
                                    <input v-model="form.address" type="text" name="name"
                                           :placeholder="$t('group.address_placeholder')"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                                    <has-error :form="form" field="address"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ $t('group.Description')}}</label>
                                    <textarea v-model="form.description"
                                              :placeholder="$t('group.Description_placeholder')"
                                              name="description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" id="exampleFormControlTextarea1" rows="6"></textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                group: {},
                id: 0,
                // Create a new form instance
                form: new Form({
                    id:'',
                    name: '',
                    postal_code: '',
                    address: '',
                    description: '',
                    created_at:'',
                    updated_at:''
                })
            }
        },
        methods: {

            loadGroup(){
                this.$Progress.start();
                // if(this.$gate.isAdmin()){
                axios.get("/api/group/"+this.id).then(({ data }) =>
                {
                    console.log(data.data);
                    this.group = data.data;
                    let group = JSON.parse(JSON.stringify(this.group))
                    this.form.fill(group);
                }
                );
                // }
                this.$Progress.finish();
            },

            updateGroup(){
                this.$Progress.start();

                this.form.put('/api/group/'+this.id)
                    .then((data)=>{
                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();
                        this.$router.push({ path: '/admin/group' })
                    })
                    .catch(()=>{
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            }

        },
        mounted() {
        },
        created() {
            this.$Progress.start();
            if( this.$route.params.id){
                this.id = this.$route.params.id;
                this.loadGroup();
            }else{
                this.$router.push({ path: '/admin/group' });
            }
            this.$Progress.finish();
        }
    }
</script>
<style scoped>
    .table-hover th{font-weight: 200;font-size:13px}
    .dropdown-menu{border-radius: 0}
    .dropdown-item{font-weight: normal; font-size: 11px;line-height: 13px}
</style>>
