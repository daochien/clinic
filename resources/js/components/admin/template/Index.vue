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
                                <router-link class="btn btn-sm btn-primary" to="/admin/template/create">
                                    <i class="fa fa-plus-square"></i>
                                    Create Template
                                </router-link>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="ten">Visibility</th>
                                    <th class="fifteen">Allows Edit?</th>
                                    <th class="ten">Submissions</th>
                                    <th class="twenty-five">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="form in templates.data" :key="form.id">
<!--

                                    <td>{{user.id}}</td>
                                    <td class="text-capitalize">{{user.type}}</td>
                                    <td class="text-capitalize">{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td :inner-html.prop="user.email_verified_at | yesno"></td>
                                    <td>{{user.created_at}}</td>

                                    <td>

                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
-->



                                    <td>{{ form.name }}</td>
                                    <td>{{ form.visibility }}</td>
                                    <td>{{ form.allowsEdit == 'false' ? 'NO' : 'YES' }}</td>
                                    <td>{{ form.submissions_count }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i> Data
                                        </a>
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-primary btn-sm" title="Edit form">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-primary btn-sm clipboard" data-message="" data-original="" title="Copy form URL to clipboard">
                                            <i class="fa fa-clipboard"></i>
                                        </button>

                                        <!--<form action="#" method="POST" id="deleteFormForm_{{ form.id }}" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ form.id }}" data-message="Delete form '{{ form.name }}'?" title="Delete form '{{ form.name }}'">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>-->
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="templates" @pagination-change-page="getResults"></pagination>
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
                templates : {},
                form: new Form({
                    // id : '',
                    // type : '',
                    // name: '',
                    // email: '',
                    // password: '',
                    // email_verified_at: '',
                })
            }
        },
        methods: {

            getResults(page = 1) {
            },
            newModal(){
            },
            loadTemplates(){
                this.$Progress.start();
                if(this.$gate.isAdmin()){
                    axios.get("/api/template").then(({ data }) => {
                        this.templates = data.data;
                    });
                }
                this.$Progress.finish();
            },

        },
        mounted() {
            console.log('User Component mounted.')
        },
        created() {
            // this.$Progress.start();
            console.log('created')
            this.loadTemplates();
            // this.$Progress.finish();
        }
    }
</script>
