<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('sidebar.staff') }}</h3>
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
                                    Add New
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ $t('app.user.name') }}</th>
                                    <th>{{ $t('app.user.email') }}</th>
                                    <th>{{ $t('app.user.group') }}</th>
                                    <th>{{ $t('app.user.clinic_name') }}</th>
                                    <th>{{ $t('app.user.last_login_date') }}</th>
                                    <th>{{ $t('app.label.operator') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in users.data" :key="user.id">
                                    <td>{{index + 1}}</td>
                                    <td class="text-capitalize">{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>
                                        <template v-if="user.groups.length !== 0">
                                             <span class="badge badge-info ml-1" v-for="target in user.groups" :key="target.id">
                                                {{ target.name}}
                                            </span>
                                        </template>
                                        <div v-else> -</div>
                                    </td>
                                    <td>
                                        <div v-if="user.clinics.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="clinic in user.clinics" :key="clinic.id">
                                                {{ clinic.name}}
                                            </span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>{{user.last_login|myDate}}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
                            <h5 class="modal-title" v-show="!editmode">Create New User</h5>
                            <h5 class="modal-title" v-show="editmode">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- <form @submit.prevent="createUser"> -->

                        <form @submit.prevent="editmode ? updateUser() : createUser()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input v-model="form.email" type="text" name="email"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-model="form.password" type="password" name="password"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                                           autocomplete="false">
                                    <has-error :form="form" field="password"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>User Role</label>
                                    <select name="type" v-model="form.type" id="type" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('type') }">
                                        <option value="">Select User Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">Standard User</option>
                                    </select>
                                    <has-error :form="form" field="type"></has-error>
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
        data() {
            return {
                editmode: false,
                users: {},
                paginator: {},
                form: new Form({
                    id: '',
                    type: '',
                    name: '',
                    email: '',
                    password: '',
                    email_verified_at: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                console.log('get Results');
                axios.get('/api/user?page=' + page).then((response) => {
                    this.users = response.data;
                    this.paginator = response.data.meta
                });
                this.$Progress.finish();
            },
            updateUser() {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('/api/user/' + this.form.id)
                    .then((response) => {
                        // success
                        $('#addNew').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                        this.loadUsers();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
            editModal(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id) {
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
                        this.form.delete('/api/user/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            this.loadUsers();
                        }).catch((data) => {
                            Swal.fire("Failed!", data.message, "warning");
                        });
                    }
                })
            },
            loadUsers() {
                this.$Progress.start();
                if (this.$gate.isAdmin()) {
                    axios.get("/api/user").then((response) => {
                        this.users = response.data;
                        this.paginator = response.data.meta
                    });
                }
                this.$Progress.finish();
            },
            createUser() {
                this.form.post('/api/user')
                    .then((response) => {
                        $('#addNew').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$Progress.finish();
                        this.loadUsers();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            }
        },
        mounted() {
            console.log('User Component mounted.!!')
        },
        created() {
            this.$Progress.start();
            console.log('created')
            this.loadUsers();
            this.$Progress.finish();
        }
    }
</script>
