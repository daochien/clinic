<template>
    <div class="container-fluid">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('role.title_page') }}</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <button v-if="!isEdit" type="button" class="btn btn-sm btn-primary float-right" @click="createRole()">
                    <i class="fa fa-plus-square"></i>
                    {{ $t('role.button_create') }}
                </button>
                <button v-else type="button" class="btn btn-sm btn-primary float-right" @click="updateRole()">
                    <i class="fa fa-plus-square"></i>
                    {{ $t('role.button_edit') }}
                </button>
            </div>   
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" v-if="$gate.isRoot()">                                        
                    <div class="card-body">
                         <div class="form-group row">
                            <label for="feInputTitle" class="col-sm-2 col-form-label">{{ $t('role.input_name') }} <span style="color:#c4183c;">*</span></label>
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
                                <th>{{ $t('role.table.name') }}</th>
                                <th>{{ $t('role.table.select_all') }}</th>
                                <th>{{ $t('role.table.permission_view_list') }}</th>
                                <th>{{ $t('role.table.permission_create') }}</th>
                                <th>{{ $t('role.table.permission_update') }}</th>
                                <th>{{ $t('role.table.permission_delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <permission
                                v-for="(route, index) in listRoutes"
                                :key="index"
                                :data-route="route"
                                :idx="index"
                                :has-pers="roleHasPermissions"
                                @select-permission="selectPermission" />

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
        <div v-if="!$gate.isRoot()">
            <not-found></not-found>
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
            roleHasPermissions: [],
            listRoutes: [],
        }
    },
     created () {
        this.loadRoutes();
    },
    methods: {
        selectPermission (data) {
            //console.log(data);
            if (this.role.permissions.length > 0) {
                let idx = -1;
                this.role.permissions.forEach((item, index) => {
                    if (item.type == data.type) {
                        idx = index;
                    }
                });
                if (idx > -1) {
                    this.role.permissions[idx] = data;
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
                this.infoRole();
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
                this.$router.push({path: '/admin/manager/roles'});
            })
            .catch(()=>{
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            })
        },
        updateRole () {
            this.$Progress.start();
            // console.log('Editing data');
            this.role.put('/api/role/'+this.role.id)
            .then((response) => {
                // success
                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                });
                this.$Progress.finish();
            })
            .catch(() => {
                this.$Progress.fail();
            });
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
                this.roleHasPermissions = data.permissions.map((item) => {
                    //return item.name.replace(".", ".groups.");
                    return item.name;
                });
            }
        }
    }
}
</script>
<style lang="scss" scoped>

</style>
