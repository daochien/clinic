<template>
    <section class="content" v-if="inquiry">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="pr-5 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('inquiry.info._page_title') }}</h3>
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
                            <label class="font-weight-bold" v-html="$t('inquiry.info.basic_info._subtitle')"></label>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('inquiry.attr._title')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="inquiry.title"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('inquiry.attr._category')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5" v-html="inquiry.category.name"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('inquiry.attr._status')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5" v-html="inquiry.category.name"></div>
                            </div>
                        </div>
                        <div class="card-header">
                            <label class="font-weight-bold">{{ $t('inquiry.info.form._subtitle')}}</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('inquiry.info.form._title')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="inquiry.title"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('inquiry.info.form._content')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10" v-html="inquiry.question"></div>
                            </div>
                            <button class="btn btn-primary float-right mr-3" :disabled="isClosed()" @click="close()">{{ $t('inquiry.info.others._btn_close')}}</button>
                        </div>
                    </div>
                    <div class="card mb-5" v-if="inquiry.inquiry_comments.length > 0"  id="inquiry-discussion">
                        <div class="card-header border-bottom">
                            <label class="font-weight-bold" v-html="$t('inquiry.discussion._title')"></label>
                        </div>
                        <div class="card-body p-0 pl-3 d-content">
                            <div class="blog-comments__item d-flex p-3 row" v-for="(comment, index) in inquiry.inquiry_comments" :key="'comment_' + index">
                                <div class="col-10 d-user-name">
                                    {{ comment.user.name }}
                                </div>
                                <div class="col-2 text-right d-created_at">
                                    {{ comment.created_at | myDate }}
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
                    <div class="card mb-5" v-if="!isClosed()">
                        <div class="card-body">
                            <b-form @submit="onSubmit" >
                                <b-form-textarea
                                    class="mb-3"
                                    id="textarea"
                                    required
                                    v-model="discussion.message"
                                    :placeholder="$t('inquiry.discussion.form._input_comment_pl')"
                                    rows="3"
                                    max-rows="6"
                                ></b-form-textarea>
                                <b-form-file
                                    @change="preUploadFile($event)"
                                    ref="fileInput"
                                    class="mb-3"
                                    accept="image/*,.doc,.docx,.xls,xlsx,.mp4,.mpeg,.txt,.csv"
                                    :placeholder="$t('inquiry.discussion.form._input_select_file_pl') "
                                    :drop-placeholder="$t('inquiry.discussion.form._input_drop_file_pl')"
                                ></b-form-file>
                                <b-button type="submit" variant="primary" class="float-right" :disabled="isClosed()">{{$t('inquiry.discussion.others._btn_comment')}}</b-button>
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
                inquiry : {
                    id: null,
                    category: {},
                    title: '',
                    question: '',
                    status: null,
                    created_by: {},
                    closed_by: {},
                    inquiry_comments: [],
                },

                status_label: '',
                status_text: '',
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
            onSubmit(evt) {
                this.$Progress.start();
                let formData = new FormData();
                formData.append('file', this.discussion.file);
                formData.append('message', this.discussion.message);

                evt.preventDefault();
                axios.post("/api/inquiry/" + this.inquiry.id + "/comment", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response)=>{
                    if(response.data.status){
                        Toast.fire({
                            icon: "success",
                            title: this.$t('inquiry').discussion.messages._comment_success,
                        });
                        this.inquiry.inquiry_comments = response.data.data;
                        this.resetChat();
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('common').discussion.messages._comment_failed,
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
            close() {
                Swal.fire({
                    title: this.$t('inquiry').others._close_modal_title,
                    text: this.$t('inquiry').others._close_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('inquiry').others._close_modal_yes,
                    cancelButtonText: this.$t('inquiry').others._close_modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.post("/api/inquiry/" + this.inquiry.id + "/close", {
                            status: 2,
                        })
                            .then((data) => {
                                if (data.data.status) {
                                    Toast.fire({
                                        icon: "success",
                                        title: this.$t('inquiry').list.messages._close_success,
                                    });
                                    this.$router.push("/admin/inquiry/category/" + this.inquiry.category.id)
                                    this.$Progress.finish();
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: this.$t('inquiry').list.messages._close_failed,
                                    });
                                    this.$Progress.failed();
                                }
                            })
                            .catch(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('inquiry').list.messages._close_failed,
                                });
                            })
                    }
                })
            },
            loadInquiry(){
                this.$Progress.start();
                axios.get("/api/inquiry/"  + this.$route.params.id).then((response ) => {
                    this.inquiry = response.data.data;
                    this.getStatus();
                });
                this.$Progress.finish();
            },
            loadComment(){
                this.$Progress.start();
                axios.get("/api/inquiry/"  + this.$route.params.id + "/comment").then((response ) => {
                    this.inquiry.request_comments = response.data.data;
                });
                this.$Progress.finish();
            },
            getStatus() {
                if (this.inquiry.closed_by.length === 0) {
                    this.status_label = 'btn-warning';
                    this.status_text = this.$t('inquiry').attr.status._open;
                    return;
                }

                this.status_label = 'btn-secondary';
                this.status_text = this.$t('inquiry').attr.status._closed;

            },
            isClosed() {
                return  (this.inquiry.closed_by.length > 0)
            }
        },
        mounted() {
        },
        created() {
            this.loadInquiry();
        }
    }
</script>
<style type="text/css">
.d-message { white-space: pre-wrap; }
</style>
