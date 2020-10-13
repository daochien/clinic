<template>
    <section class="content" v-if="submission">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="pr-5 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('request.info._page_title') }}</h3>
            </div>
            <div class="col-1 col-sm-8 text-right text-sm-left mb-4 mb-sm-0" >
                <div class="mb-2 btn btn-sm mr-1" :class="status_label" v-html="status_text"></div>
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
                        <div class="card-body border-bottom pt-0 pb-0">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('request.attr._title')}}
                                        </label>
                                    </div>
                                </div>
                                <div v-if="submission.template" class="col-10" v-html="submission.template.name"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('request.attr._category')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5" v-if="submission.template" v-html="submission.template.category[0].name">
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
                                    <div v-if="submission.template && submission.template.approvers.length !== 0">
                                        <span class="badge badge-info ml-1" v-for="approver in submission.template.approvers" :key="'sc_' + approver.id">
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
                                    <div class="form-group" v-if="submission.template" v-html="submission.template.description"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <label class="font-weight-bold">{{ $t('request.info.form._subtitle')}}</label>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row" v-for="(value, index) in form_headers" :key="'title_' + index">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ value.label}}
                                        </label>
                                    </div>
                                </div>
                                <ul id="demo" v-if="isArray((submission.content[value.name]))">
                                    <li v-for="(attachment, index) in submission.content[value.name]"  :key="'att_' + index" style="list-style:none">
                                        <a :href="base_url + '/request/download/' + attachment">
                                            {{attachment | formatAttachFile}} <i class="fas fa-cloud-download-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div v-else-if="value.type === 'date'" class="col-10" >{{submission.content[value.name]|myDate}}</div>
                                <div v-else class="col-10" v-html="submission.content[value.name]"></div>
                            </div>
                            <button v-if="can_update" class="btn btn-primary float-right mr-3" @click="approve()" :disabled="!can_change">{{ $t('request.info.others._btn_approve')}}</button>
                            <button v-if="can_update" type="button" class="btn btn-danger mr-3 float-right" @click="reject()" :disabled="!can_change">{{ $t('request.info.others._btn_reject')}}</button>
                        </div>
                    </div>

                    <div class="card mb-5" v-if="submission.request_comments.length > 0"  id="request-discussion">
                        <div class="card-header border-bottom pt-0">
                            <label class="font-weight-bold" v-html="$t('request.discussion._title')"></label>
                        </div>
                        <div class="card-body p-0 pl-3 d-content">
                            <div class="blog-comments__item d-flex p-3 row" v-for="(comment, index) in submission.request_comments" :key="'comment_' + index">
                                <div class="col-10 d-user-name">
                                    {{ comment.user.name }}
                                </div>
                                <div class="col-2 text-right d-created_at">
                                    {{ comment.created_at|myDate }}
                                </div>
                                <div class="col-12 mt-3 d-message" v-html="comment.message"></div>
                                <div class="col-12 mt-3" v-for="(attachment, index) in comment.attachments" :key="'att_' + index">
                                    <a :href="base_url + '/request/download/attachment/' + attachment.title">
                                        {{attachment.title | formatAttachFile}} <i class="fas fa-cloud-download-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5" v-if="can_change & can_update">
                        <div class="card-body">
                            <b-form @submit="onSubmit" >
                                <b-form-textarea
                                    class="mb-3"
                                    id="textarea"
                                    required
                                    v-model="discussion.message"
                                    :placeholder="$t('request.discussion.form._input_comment_pl')"
                                    rows="3"
                                    max-rows="6"
                                ></b-form-textarea>
                                <b-form-file
                                    @change="preUploadFile($event)"
                                    ref="fileInput"
                                    class="mb-3"
                                    accept="image/*,.doc,.docx,.xls,xlsx,.mp4,.mpeg,.txt,.csv"
                                    :placeholder="$t('request.discussion.form._input_select_file_pl') "
                                    :drop-placeholder="$t('request.discussion.form._input_drop_file_pl')"
                                ></b-form-file>
                                <b-button type="submit" variant="primary" class="float-right">{{$t('request.discussion.others._btn_comment')}}</b-button>
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
                status_text: '',
                can_change: false,
                can_update: false,
                discussion: {
                    message: '',
                    file: null
                },
                base_url: base_url,
                status : '',
            }
        },
        methods: {
            preUploadFile(event){
                this.discussion.file = event.target.files[0]
            },
            canUpdateRequest(request) {
                this.can_update = _.findIndex(request.template.approvers, ['id', window.user.id]) >= 0;
            },
            onSubmit(evt) {
                this.$Progress.start();
                let formData = new FormData();
                formData.append('file', this.discussion.file);
                formData.append('message', this.discussion.message);

                evt.preventDefault();
                axios.post("/api/request/" + this.submission.id + "/comment", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response)=>{
                    if(response.data.status){
                        Toast.fire({
                            icon: "success",
                            title: this.$t('request').discussion.messages._comment_success,
                        });
                        this.submission.request_comments = response.data.data;
                        this.resetChat();
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('request').discussion.messages._comment_failed,
                        });
                        this.$Progress.finish();
                    }
                })
            },
            resetChat() {
                this.$refs.fileInput.reset();
                this.discussion = {
                    message: '',
                    file: null
                };
            },
            approve() {
                Swal.fire({
                    title: this.$t('request').others._approve_modal_title,
                    text: this.$t('request').others._approve_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('request').others._modal_yes,
                    cancelButtonText: this.$t('request').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.post("/api/request/" + this.submission.id + "/status", {
                            status: 1,
                        })
                        .then((data) => {
                            if (data.data.status) {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t('request').list.messages._approve_success,
                                });
                                this.$router.push("/admin/request/category/" + this.submission.template.category[0].id)
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
                    }
                })
            },
            reject() {
                Swal.fire({
                    title: this.$t('request').others._reject_modal_title,
                    text: this.$t('request').others._reject_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('request').others._modal_yes,
                    cancelButtonText: this.$t('request').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.post("/api/request/" + this.submission.id + "/status", {
                            status: 2,
                        })
                        .then((data) => {
                            if (data.data.status) {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t('request').list.messages._reject_success,
                                });
                                this.$router.push("/admin/request/category/" + this.submission.template.category[0].id)
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
                    this.status = this.getStatus();
                    this.canUpdateRequest(this.submission);
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
            getStatus() {
                self = this;
                if (this.submission.request_logs.length === 0) {
                    this.status_label = 'btn-warning';
                    this.status_text = this.$t('request').attr.status._open;
                    this.can_change = true;
                    return;
                }

                let approvedCount = 0;
                let reject = false;
                _.forEach(this.submission.request_logs, function (log, logKey) {

                    let valid_approver = _.findIndex(self.submission.template.approvers, ['id', log.approver_id]) >= 0;
                    if (valid_approver){
                        if (log.status === 2) {
                            self.status_label = 'btn-secondary';
                            self.status_text = self.$t('request').attr.status._rejected;
                            reject = true;
                            this.can_change = false;
                            return false;
                        }
                        approvedCount++;
                    }
                });
                if (reject) {
                    return ;
                }
                if (approvedCount === this.submission.template.approvers.length) {
                    this.status_label = 'btn-info'
                    this.status_text = this.$t('request').attr.status._approved;
                    this.can_change = false;
                    return;
                }

                this.can_change = true;
                this.status_label = 'btn-primary';
                this.status_text = this.$t('request').attr.status._in_progress;
            },
            isArray(value){
                return _.isArray(value);
            }
        },
        mounted() {
        },
        created() {
            this.loadRequests();
        }
    }
</script>
<style type="text/css">
.d-message { white-space: pre-wrap; }
</style>
