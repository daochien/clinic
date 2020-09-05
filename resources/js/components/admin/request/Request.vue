<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="pr-5 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('request.info._page_title') }}</h3>
            </div>
            <div class="col-1 col-sm-8 text-right text-sm-left mb-4 mb-sm-0">
                <div class="mb-2 btn btn-sm mr-1" :class="status_label" v-html="getStatus(submission)"></div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card mb-5">
                        <div class="card-header">
                            <label class="font-weight-bold" v-html="$t('request.info.basic_info._subtitle')"></label>
                        </div>
                        <div class="card-body border-bottom">
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
                            <button class="btn btn-primary float-right mr-3" @click="approve()">{{ $t('request.info.others._btn_approve')}}</button>
                            <button type="button" class="btn btn-outline-danger mr-3 float-right" @click="reject()">{{ $t('request.info.others._btn_reject')}}</button>
                        </div>
                    </div>

                    <div class="card mb-5" v-if="submission.request_comments.length > 0"  id="request-discussion">
                        <div class="card-header border-bottom">
                            <label class="font-weight-bold" v-html="$t('request.discussion._title')"></label>
                        </div>
                        <div class="card-body p-0 pl-3 d-content">
                            <div class="blog-comments__item d-flex p-3 row" v-for="(comment, index) in submission.request_comments" :key="'comment_' + index">
                                <div class="col-10 d-user-name">
                                    {{ comment.user.name }}
                                </div>
                                <div class="col-2 text-right d-created_at">
                                    {{ comment.created_at | myDate }}
                                </div>
                                <div class="col-12 mt-3 d-message">
                                    {{ comment.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <b-form @submit="onSubmit" >
                                <b-form-textarea
                                    class="mb-3"
                                    id="textarea"
                                    required
                                    v-model="discussion.message"
                                    :placeholder="$t('request.discussion._comment_here')"
                                    rows="3"
                                    max-rows="6"
                                ></b-form-textarea>
                                <b-form-file
                                    class="mb-3"
                                    accept="image/*,.doc,.docx,.xls,xlsx,.mp4,.mpeg,.txt,.csv"
                                    v-model="discussion.file"
                                    :placeholder="$t('request.discussion._upload_placeholder') "
                                    :drop-placeholder="$t('request.discussion._upload_drop_placeholder')"
                                ></b-form-file>
                                <b-button type="submit" variant="primary" class="float-right">Submit</b-button>
                            </b-form>
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
                submission : {
                    form: {
                        approvers: {},
                        category: [
                            { name : '' },
                        ],
                    },
                    request_logs: {},
                    request_comments: [],
                },
                form_headers : {},
                status_label: '',
                discussion: new Form({
                    text: '',
                    file: null,
                })
            }
        },
        methods: {
            onSubmit(evt) {
                this.$Progress.start();
                evt.preventDefault();
                this.discussion.post("/api/request/" + this.submission.id + "/comment")
                    .then((response)=>{
                        if(response.data.success){
                            Toast.fire({
                                icon: "success",
                                title: this.$t('request').discussion._comment_success,
                            });
                            this.submission.request_comments = response.data.data;
                            this.discussion.reset();
                            this.$Progress.finish();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('common').messsages._system_err,
                            });
                            this.$Progress.finish();
                        }
                    })
                    // .catch(()=>{
                    //     Toast.fire({
                    //         icon: 'error',
                    //         title: this.$t('common').messsages._system_err,
                    //     });
                    //     this.$Progress.finish();
                    // })
            },
            approve() {
                axios.post("/api/request/" + this.submission.id, {
                    status: 1,
                })
                .then((data) => {
                    if (data.data.success) {
                        Toast.fire({
                            icon: "success",
                            title: this.$t('request').list.messages._approve_success,
                        });
                        this.$router.push("/admin/request/category/" + this.submission.form.category[0].id)
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('request').list.messages._approve_failed,
                        });
                        this.$Progress.failed();
                    }
                })
                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('request').list.messages._approve_failed,
                    });
                })
            },
            reject() {
                Swal.fire({
                    title: this.$t('request').others._reject_modal_title,
                    text: this.$t('request').others._reject_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('request').others._reject_modal_yes,
                    cancelButtonText: this.$t('request').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.post("/api/request/" + this.submission.id, {
                            status: 2,
                        })
                        .then((data) => {
                            if (data.data.success) {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t('request').list.messages._reject_success,
                                });
                                this.$router.push("/admin/request/category/" + this.submission.form.category[0].id)
                                this.$Progress.finish();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('request').list.messages._reject_failed,
                                });
                                this.$Progress.failed();
                            }
                        })
                        .catch(() => {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('request').list.messages._reject_failed,
                            });
                        })
                    }
                })
            },
            loadRequests(){
                this.$Progress.start();
                axios.get("/api/request/"  + this.$route.params.id).then((response ) => {
                    this.submission = response.data.data.submission;
                    this.form_headers = response.data.data.form_headers;
                });
                this.$Progress.finish();
            },
            loadComment(){
                this.$Progress.start();
                axios.get("/api/request/"  + this.$route.params.id + "/comment").then((response ) => {
                    this.submission.request_comments = response.data.data;
                });
                this.$Progress.finish();
            },
            getStatus(object) {
                self = this;
                if (object.request_logs.length === 0) {
                    this.status_label = 'btn-warning';
                    return this.$t('request').attr.status._open;
                }

                let approvedCount = 0;
                _.forEach(object.request_logs, function (log, logKey) {
                    if (log.status === 2) {
                        self.status_label = 'btn-secondary';
                        return self.$t('request').attr.status._rejected;
                    }
                    approvedCount++;
                });

                if (approvedCount === object.form.approvers.length) {
                    this.status_label = 'btn-info';
                    return this.$t('request').attr.status._approved;
                }

                this.status_label = 'btn-primary';
                return this.$t('request').attr.status._in_progress;
            }
        },
        mounted() {
        },
        created() {
            this.loadRequests();
        }
    }
</script>
