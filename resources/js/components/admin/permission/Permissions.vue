<template>
    <section class="content">

      <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('permission.title_page') }}</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                                <i class="fa fa-plus-square"></i>
                                {{ $t('permission.button_create') }}
                            </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>#</th>                                
                                <th>Name</th>
                                <th>Created At</th>                               
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(permission, index) in permissions.data" :key="permission.id">

                                    <td>{{ index + 1 }}</td>
                                    <td class="text-capitalize">{{permission.name}}</td>
                                    <td class="text-capitalize">{{permission.created_at}}</td>                                    
                                    <td>
                                        <a href="#" @click="editModal(permission)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deletePermission(permission.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="permissions" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode">Create New Permission</h5>
                        <h5 class="modal-title" v-show="editmode">Update Permission Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- <form @submit.prevent="createUser"> -->

                    <form @submit.prevent="editmode ? updatePermission() : createPermission()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="permission.name" type="text" name="name"
                                    class="form-control" :class="{ 'is-invalid': permission.errors.has('name') }">
                                <has-error :form="permission" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Route</label>
                                <select
                                v-model="permission.route_name" 
                                class="form-control" :class="{ 'is-invalid': permission.errors.has('route_name') }"
                                name="route" 
                                id="">
                                    <option value="">--Select route--</option>
                                    <option v-for="(route, index) in list_routes" :key="index" :value="route">{{ route }}</option>
                                </select>                                
                                <has-error :form="permission" field="route_name"></has-error>
                            </div>                                                                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data () {
        return {
            editmode: false,
            permissions: {},
            permission: new Form ({
                id: '',
                name: '',
                route_name: ''
            }),
            list_routes: []
        }
    },
    created () {
        this.getResults();
        this.loadRoutes();
    },
    methods: {
        loadRoutes () {
            this.$Progress.start();            
            axios.get('/api/permission/routes').then(({ data }) => (this.list_routes = data.data));
            this.$Progress.finish();
        },
        getResults(page = 1) {

            this.$Progress.start();
            console.log('get Results');
            axios.get('/api/permission?page=' + page).then(({ data }) => (this.permissions = data.data));

            this.$Progress.finish();
        },
        newModal () {
            this.editmode = false;
            this.permission.reset();
            $('#addNew').modal('show');
        },
        editModal(permission){
            this.editmode = true;
            this.permission.reset();
            $('#addNew').modal('show');
            this.permission.fill(permission);
        },
        createPermission () {
            console.log('xx');
            this.permission.post('/api/permission')
            .then((response)=>{
                $('#addNew').modal('hide');

                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                });

                this.$Progress.finish();
                this.getResults(1);
            })
            .catch(()=>{
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            })
        },
        updatePermission () {
            this.$Progress.start();
            // console.log('Editing data');
            this.permission.put('/api/permission/'+this.permission.id)
            .then((response) => {
                // success
                $('#addNew').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                });
                this.$Progress.finish();
                    //  Fire.$emit('AfterCreate');

                this.getResults(1);
            })
            .catch(() => {
                this.$Progress.fail();
            });
        },
        deletePermission (id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                    if (result.value) {
                        this.permission.delete('/api/permission/'+id).then(()=>{
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                );
                            // Fire.$emit('AfterCreate');
                            this.getResults(1);
                        }).catch((data)=> {
                            Swal.fire("Failed!", data.message, "warning");
                        });
                    }
                })
        }
    }
}
</script>
<style lang="scss" scoped>

</style>