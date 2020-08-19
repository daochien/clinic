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
                            <div id="fb-editor" class="fb-editor"></div>
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
