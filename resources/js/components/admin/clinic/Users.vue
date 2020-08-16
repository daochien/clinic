<template>
    <section class="content" v-if="$gate.isAdmin()">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('app.clinic.header.list-user') }}</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" class="custom-control-input"
                                                           id="formsAgreeField"></th>
                                    <th scope="col">{{ $t('app.user.name')}}</th>
                                    <th scope="col">{{ $t('app.user.email')}}</th>
                                    <th scope="col">{{ $t('app.user.group')}}</th>
                                    <th scope="col">{{ $t('app.user.register_date')}}</th>
                                    <th scope="col">{{ $t('app.user.last_login_date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in users.data" :key="entity.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ entity.name }}</td>
                                    <td>{{ entity.email }}</td>
                                    <td>
                                        <template v-if="entity.groups.length !== 0">
                                             <span class="badge badge-info ml-1" v-for="target in entity.groups" :key="target.id">
                                                {{ target.name}}
                                             </span>
                                        </template>
                                        <div v-else> - </div>
                                    </td>
                                    <td>{{ new Date(entity.created_at).convert() }}</td>
                                    <td>{{ new Date(entity.last_login).convert() }}</td>
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
        </div>
    </section>
    <div v-else>
        <not-found></not-found>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                paginator: {},
                keyword: "",
            };
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                console.log("get Results");
                axios
                    .get("/api/clinic?keyword= " + keyword + "&page=" + page)
                    .then((response) => {
                        this.users = response.data;
                        this.paginator = response.data.meta
                    });

                this.$Progress.finish();
            },
            loadUsers() {
                this.$Progress.start();
                axios
                    .get("/api/clinic/" + this.$route.params.id + "/user")
                    .then((response) => {
                        this.users = response.data;
                        this.paginator = response.data.meta
                    });
                this.$Progress.finish();
            },
            create() {
                this.$Progress.start();

                axios.post("/api/clinic/" + this.$route.params.id + "/user")
                    .then((data) => {
                        if (data.data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: data.data.message
                            });
                            this.$Progress.finish();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Some error occured! Please try again'
                            });

                            this.$Progress.failed();
                        }
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            },
        },
        created() {
            this.$Progress.start();
            this.loadUsers();
            this.$Progress.finish();
        },
    };
</script>
