<template>
    <section class="content">

      <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('role.title_page') }}</h3>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <div class="card-tools">
                            <router-link type="button" class="btn btn-sm btn-primary" :to="{path: 'role/create'}">
                                <i class="fa fa-plus-square"></i>
                                {{ $t('role.button_create') }}
                            </router-link>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Name</th>
                                <!-- <th>permissions</th> -->
                                <th>Created At</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(role, index) in roles.data" :key="role.id">

                                    <td>{{ index + 1 }}</td>
                                    <td class="text-capitalize">{{role.name}}</td>
                                    <!-- <td class="text-capitalize">
                                        <div v-if="role.permissions.length > 4">
                                            <span class="card-post__category badge badge-pill badge-info mr-2">
                                                {{ role.permissions.length }} permission
                                            </span>
                                        </div>
                                        <div v-else>
                                            <span class="card-post__category badge badge-pill badge-warning mr-2" v-for="(permission, idx) in role.permissions" :key="idx">
                                                {{ permission.name }}
                                            </span>
                                        </div>
                                    </td> -->
                                    <td class="text-capitalize">{{role.created_at}}</td>
                                    <td>
                                        <router-link :to="{path: `/admin/role/edit/${role.id}`}" >
                                            <i class="fa fa-edit blue"></i>
                                        </router-link>
                                        /
                                        <a href="#" @click="deleteRole(role.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="roles" @pagination-change-page="getResults"></pagination>
                        </div>
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
export default {
    data () {
        return {
            editmode: false,
            roles: {

            },
            role: new Form ({
                id: '',
                name: '',
                permissions: []
            }),
            permissions: []

        }
    },
    created () {
        this.getResults();
    },
    methods: {
        getResults(page = 1) {

            this.$Progress.start();
            console.log('get Results');
            axios.get('/api/role?page=' + page).then(({ data }) => (this.roles = data.data));

            this.$Progress.finish();
        },



        // updateRole () {
        //     this.$Progress.start();
        //     // console.log('Editing data');
        //     this.role.put('/api/role/'+this.role.id)
        //     .then((response) => {
        //         // success
        //         $('#addNew').modal('hide');
        //         Toast.fire({
        //             icon: 'success',
        //             title: response.data.message
        //         });
        //         this.$Progress.finish();
        //             //  Fire.$emit('AfterCreate');

        //         this.getResults(1);
        //     })
        //     .catch(() => {
        //         this.$Progress.fail();
        //     });
        // },
        deleteRole (id) {
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
                        this.role.delete('/api/role/'+id).then(()=>{
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
