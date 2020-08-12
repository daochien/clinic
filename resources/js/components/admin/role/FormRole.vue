<template>
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">

                <div class="card" >
                    <div class="card-header border-bottom">
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-primary float-right" @click="createRole()">
                                <i class="fa fa-plus-square"></i>
                                {{ $t('permission.button_create') }}
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                         <div class="form-group row">
                            <label for="feInputTitle" class="col-sm-2 col-form-label">Name <span style="color:#c4183c;">*</span></label>
                            <div class="col-sm-6">
                                <input
                                :class="['form-control', {'is-invalid': role.errors.has('name')}]"
                                type="text"
                                v-model.trim="role.name"
                                >
                                <has-error :form="role" field="name"></has-error>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Select All</th>
                                <th>View List</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <permission
                                v-for="(route, index) in listRoutes"
                                :key="index"
                                :data-route="route"
                                :idx="index"
                                :has-pers="role.permissions"
                                @select-permission="selectPermission" />

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>
<script>
import permission from '../role/Permission';
export default {
    components: {
        permission
    },
    props: {
        isEdit: Boolean
    },
    data () {
        return {
            role: new Form ({
                id: '',
                name: '',
                permissions: []
            }),
            listRoutes: [],
        }
    },
     created () {
        this.loadRoutes();
    },
    methods: {
        selectPermission (data) {
            if (this.role.permissions.length > 0) {
                let idx = -1;
                this.role.permissions.forEach((item, index) => {
                    if (item.type == data.type) {
                        idx = index;
                    }
                });
                if (idx > -1) {
                    this.role.permissions[0] = data;
                } else {
                    this.role.permissions.push(data);
                }
            } else {
                this.role.permissions.push(data);
            }

        },
        loadRoutes () {
            this.$Progress.start();
            axios.get('/api/permission/routes').then(({ data }) => {
                this.listRoutes = data.data;
                // this.infoRole();
            });
            this.$Progress.finish();
        },
        createRole () {

            this.role.post('/api/role')
            .then((response) => {
                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                });

                this.$Progress.finish();
                this.$router.push({path: '/admin/roles'});
            })
            .catch(()=>{
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            })
        },

        infoRole () {
            if (this.isEdit) {
                this.$Progress.start();
                axios.get("/api/role/"+this.$route.params.id)
                .then(({ data }) => {
                    if (data.data) {
                        this.syncRespone(data.data);
                        // this.isEdit = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
                this.$Progress.finish();
            }
        },
        syncRespone (data) {
            this.role.id = data.id;
            this.role.name = data.name;
            if (data.permissions.length > 0) {

                this.role.permissions = data.permissions.map((item) => {
                    return item.name.replace(".", ".groups.");
                });
            }
        }
    }
}
</script>
<style lang="scss" scoped>

</style>
