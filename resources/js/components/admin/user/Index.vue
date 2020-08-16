<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('app.user.title.index') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <router-link type="button" class="btn btn-primary pl-5 pr-5" to="/admin/user/create">{{ $t('app.btn.create')}}
                </router-link>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.group')}}</label>
                                                <select class="form-control" id="groups" v-model="groupSelected">
                                                    <option value="" selected>{{ $t('app.user.group_select_all') }}</option>
                                                    <option v-for="group in groups" :key="'group_' + group.id" :value="group.id" >{{ group.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.clinic_name')}}</label>
                                                <select class="form-control" id="clinics" v-model="clinicSelected">
                                                    <option value="" selected>{{ $t('app.user.clinic_select_all') }}</option>
                                                    <option v-for="clinic in clinics" :key="'clinic_' + clinic.id" :value="clinic.id">{{ clinic.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ $t('app.form.keyword')}}</label>
                                                <input
                                                    v-model="keyword"
                                                    type="text"
                                                    class="form-control"
                                                    :placeholder="$t('app.form.keyword_placeholder')"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6 text-right">
                                            <button
                                                type="reset"
                                                class="btn btn-outline-secondary pl-4 pr-4" @click="resetKeyword()"
                                            >{{ $t('app.form.clear_form')}}
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-outline-primary pl-4 pr-4" @click="getResults()">
                                                {{ $t('app.form.submit_form')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" v-if="$gate.isAdmin()">
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
                                <tr v-for="(user, index) in users" :key="'user_' + user.id">
                                    <td>{{index + 1}}</td>
                                    <td class="text-capitalize">{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>
                                        <template v-if="user.groups.length !== 0">
                                             <span class="badge badge-info ml-1" v-for="group in user.groups" :key="'sg_' + group.id">
                                                {{ group.name}}
                                            </span>
                                        </template>
                                        <div v-else> -</div>
                                    </td>
                                    <td>
                                        <div v-if="user.clinics.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="clinic in user.clinics" :key="'sc_' + clinic.id">
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
                            <pagination :data="paginator" @pagination-change-page="getResults"></pagination>
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
        data() {
            return {
                users: [],
                clinics: [],
                groups: [],
                paginator: {},
                keyword: "",
                clinicSelected: "",
                groupSelected: "",
            }
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                axios
                .get("/api/user/search?keyword= " + this.keyword + "&page=" + page + "&clinic_id=" + this.clinicSelected + "&group_id=" + this.groupSelected)
                    .then((response) => {
                    this.users = response.data.data;
                    this.paginator = response.data.meta
                });
                this.$Progress.finish();
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
                axios.get("/api/user").then((response) => {
                    this.users = response.data.data;
                    this.paginator = response.data.meta
                });
            },
            loadGroup() {
                axios.get("/api/group/all").then((response) => {
                    this.groups = response.data.data;
                });
            },
            loadClinic() {
                axios.get("/api/clinic/all").then((response) => {
                    this.clinics = response.data.data;
                });
            },
        },
        resetKeyword() {
            this.keyword = '';
        },
        mounted() {
            console.log('User Component mounted.!!')
        },
        created() {
            this.$Progress.start();
            this.loadUsers();
            this.loadGroup();
            this.loadClinic();
            this.$Progress.finish();
        }
    }
</script>
