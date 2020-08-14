<template>
    <section class="content" v-if="$gate.isAdmin()">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('app.clinic.header.create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button type="button" class="btn btn-primary pl-5 pr-5" @click="create()">{{ $t('app.btn.create')}}</button>
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
                                    <form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>{{ $t('app.form.keyword')}}</label>
                                                    <input
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
                                                    class="btn btn-outline-secondary pl-4 pr-4"
                                                >{{ $t('app.form.clear_form')}}</button>
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary pl-4 pr-4"
                                                >{{ $t('app.form.submit_form')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" class="custom-control-input" id="formsAgreeField"></th>
                                    <th scope="col">{{ $t('app.user.name')}}</th>
                                    <th scope="col">{{ $t('app.user.email')}}</th>
                                    <th scope="col">{{ $t('app.user.group')}}</th>
                                    <th scope="col">{{ $t('app.user.register_date')}}</th>
                                    <th scope="col">{{ $t('app.user.last_login_date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in users.data" :key="entity.id">
                                    <td>{{ index }}</td>
                                    <td>{{ entity.name }}</td>
                                    <td>{{ entity.email }}</td>
                                    <td>
                                        <div v-for="target in entity.groups" :key="target.id">
                                            <label>{{ target.group.name }}</label>
                                        </div>
                                    </td>
                                    <td>{{ entity.created_at }}</td>
                                    <td>{{ entity.created_at }}</td>
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
                keyword: "",
            };
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                console.log("get Results");
                axios
                    .get("/api/notification?keyword= " + keyword + "&page=" + page)
                    .then(({ data }) => (this.users = data.data));

                this.$Progress.finish();
            },
            loadUsers() {
                this.$Progress.start();
                    axios
                        .get("/api/clinic/" + this.$route.params.id + "/user")
                        .then(({ data }) => (this.users = data.data));
                this.$Progress.finish();
            },
            create(){
                this.$Progress.start();

                axios.post("/api/clinic/" + this.$route.params.id + "/user")
                    .then((data)=>{
                        if(data.data.success){
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
                    .catch(()=>{
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            },
        },
        mounted() {
            console.log("Notification Component mounted.");
        },
        created() {
            this.$Progress.start();
            this.loadUsers();
            this.$Progress.finish();
        },
    };
</script>
