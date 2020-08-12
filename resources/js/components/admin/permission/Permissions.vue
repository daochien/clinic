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
                                    <th>Name</th>
                                    <th>Select All</th>
                                    <th>View List</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <item
                                    v-for="(route, index) in listRoutes"
                                    :key="index"
                                    :data-route="route"
                                    :idx="index"
                                    @select-permission="selectPermission" />

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- <div class="card-footer">
                            <pagination :data="permissions" @pagination-change-page="getResults"></pagination>
                        </div> -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>

        </div>
    </section>
</template>
<script>
import Item from './Item';
export default {
    components: {
        Item
    },
    data () {
        return {
            editMode: false,
            permissions: {},
            permission: new Form ({
                id: '',
                name: '',
                permissions: []
            }),
            listRoutes: [],
            routes: [],
            selectedGroup: [],
        }
    },
    created () {
        this.getResults();
        this.loadRoutes();
    },
    watch: {
        selectedGroup : {
            handler: function (val, oldVal) {
                console.log(val);
            },
            deep: true
        }
    },
    methods: {
        selectPermission (data) {
            if (this.permission.permissions.length > 0) {
                let idx = -1;
                this.permission.permissions.forEach((item, index) => {
                    if (item.type == data.type) {
                        idx = index;
                    }
                });
                if (idx > -1) {
                    this.permission.permissions[0] = data;
                } else {
                    this.permission.permissions.push(data);
                }
            } else {
                this.permission.permissions.push(data);
            }

        },

        loadRoutes () {
            this.$Progress.start();
            axios.get('/api/permission/routes').then(({ data }) => (this.listRoutes = data.data));
            this.$Progress.finish();
        },
        getResults(page = 1) {

            this.$Progress.start();
            console.log('get Results');
            axios.get('/api/permission?page=' + page).then(({ data }) => (this.permissions = data.data));

            this.$Progress.finish();
        },
        newModal () {
            // this.editMode = false;
            // this.permission.reset();
            // $('#addNew').modal('show');

            this.permission.post('/api/permission')
            .then((response)=>{
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
        editModal(permission){
            this.editMode = true;
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
