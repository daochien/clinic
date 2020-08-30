<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-2 col-sm-2 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('template.request.page_title') }}</h3>
            </div>
            <div class="col-1 col-sm-8 text-right text-sm-left mb-4 mb-sm-0">
                <button type="button" class="mb-2 btn btn-sm btn-warning mr-1">{{ $t('template.request.pending') }}</button>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">

                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <label class="font-weight-bold">{{ $t('template.basic_info')}}</label>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('template.title')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        {{ this.submission.form.name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('template.category')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        {{ this.submission.category[0].name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('template.approver')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div v-if="this.submission.approvers.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="approver in this.submission.approvers" :key="'sc_' + approver.id">
                                                {{ approver.name}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('template.multi_approve')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1 col-2">
                                            <input type="checkbox" id="multi_approve" disabled name="multi_approve" class="custom-control-input" :checked="this.submission.form.multi_approve == true">
                                            <label class="custom-control-label" for="multi_approve"></label>
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
        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                submission : {},
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
                    this.submission = response.data.data;
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
