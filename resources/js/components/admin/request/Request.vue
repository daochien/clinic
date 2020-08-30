<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="pr-5 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('template.request.page_title') }}</h3>
            </div>
            <div class="col-1 col-sm-8 text-right text-sm-left mb-4 mb-sm-0">
                <button type="button" class="mb-2 btn btn-sm btn-warning mr-1">{{ $t('template.request.pending') }}</button>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <label class="font-weight-bold">{{ $t('template.basic_info')}}</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('template.title')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="this.submission.form.name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('template.category')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5" v-html="this.submission.form.category[0].name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('template.approver')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div v-if="this.submission.form.approvers.length !== 0">
                                        <span class="badge badge-info ml-1" v-for="approver in this.submission.form.approvers" :key="'sc_' + approver.id">
                                            {{ approver.name}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            <label>{{ $t('app.label.description')}}</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group">
                                        {{this.submission.form.description}}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                submission : {},
                form_headers : {},
            }
        },
        methods: {
            approve(id) {
                console.log(id);
            },
            reject(id) {
                console.log(id);
            },
            loadRequests(){
                this.$Progress.start();
                axios.get("/api/request/"  + this.$route.params.id).then((response ) => {
                    this.submission = response.data.data.submission;
                    this.form_headers = response.data.data.form_headers;
                });
                this.$Progress.finish();
            },

        },
        mounted() {
        },
        created() {
            // this.$Progress.start();
            this.loadRequests();
            // this.$Progress.finish();
        }
    }
</script>
