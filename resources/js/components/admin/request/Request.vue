<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="pr-5 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('request.info._page_title') }}</h3>
            </div>
            <div class="col-1 col-sm-8 text-right text-sm-left mb-4 mb-sm-0">
                <div class="mb-2 btn btn-sm btn-warning mr-1">{{ $t('template.request.pending') }}</div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <label class="font-weight-bold">{{ $t('request.info.basic_info._subtitle')}}</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('request.attr._title')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="submission.form.name"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('request.attr._category')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5" v-html="submission.form.category[0].name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('request.attr._approver')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div v-if="submission.form.approvers.length !== 0">
                                        <span class="badge badge-info ml-1" v-for="approver in submission.form.approvers" :key="'sc_' + approver.id">
                                            {{ approver.name}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            <label>{{ $t('request.attr._memo')}}</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group" v-html="submission.form.description"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <label class="font-weight-bold">{{ $t('request.info.form._subtitle')}}</label>
                        </div>
                        <div class="card-body">
                            <div class="row" v-for="(value, index) in form_headers" :key="'title_' + index">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ value.label}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="submission.content[value.name]"></div>
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
