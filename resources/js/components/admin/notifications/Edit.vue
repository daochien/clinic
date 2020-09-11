<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('notification.info._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0" v-if="!disableForm">
                <label class="pt-2 mr-4" @click="saveNotification(1)" style="cursor: pointer">{{ $t('notification.info.others._btn_draft_save')}}</label>
                <button
                    type="button"
                    class="btn btn-primary pl-5 pr-5"
                    @click="saveNotification(0)"
                >{{ $t('notification.info.others._btn_create')}}
                </button>
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
                                                <label>{{ $t('notification.info.form._subtitle')}}</label>
                                            </div>
                                        </div>
                                        <hr class="mt-2 mb-4"/>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        {{ $t('notification.attr._title')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        :placeholder="$t('notification.info.form._title_pl')"
                                                        v-model="form.title"
                                                        :disabled="disableForm"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        {{ $t('notification.attr._target_users')}}
                                                        <span class="text-danger">*</span>
                                                        <br/>
                                                        <small>{{ $t('notification.info.form._target_users_des')}}</small>
                                                    </label>
                                                    <multiselect
                                                        v-model="form.groups"
                                                        :options="groups"
                                                        :multiple="true"
                                                        :disabled="!manual || disableForm"
                                                        label="name"
                                                        track-by="id"
                                                        :placeholder="$t('notification.info.form.target_user_opt._manual_pl')"
                                                    ></multiselect>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-1">
                                                        <b-form-checkbox
                                                            v-model="checkedDR"
                                                            name="check-button"
                                                            @change="changeCheckedDR"
                                                            :disabled="disableForm"
                                                        >{{ $t('notification.info.form.target_user_opt._dr')}}
                                                        </b-form-checkbox>
                                                    </div>
                                                    <div class="col-1">
                                                        <b-form-checkbox
                                                            v-model="checkedDH"
                                                            name="check-button"
                                                            @change="changeCheckedDH"
                                                            :disabled="disableForm"
                                                        >{{ $t('notification.info.form.target_user_opt._dh')}}
                                                        </b-form-checkbox>
                                                    </div>
                                                    <div class="col-1">
                                                        <b-form-checkbox
                                                            v-model="manual"
                                                            name="check-button"
                                                            :disabled="disableForm"
                                                        >{{ $t('notification.info.form.target_user_opt._manual')}}
                                                        </b-form-checkbox>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        {{ $t('notification.attr._confirm_required')}}
                                                    </label>
                                                    <b-form-checkbox
                                                        v-model="form.confirm"
                                                        name="check-button"
                                                        :disabled="disableForm"
                                                    >
                                                    </b-form-checkbox>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ $t('notification.attr._public_at')}}</label>
                                                    <datetime
                                                        ref="datetime"
                                                        :required="true"
                                                        format="YYYY-MM-DD h:i:s"
                                                        v-model='form.schedule_date'
                                                        :disabled-dates="{ to: new Date(Date.now()) }"></datetime>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.attr._content')}}</label>
                                                    <quill-editor
                                                        ref="quill"
                                                        :content="form.content"
                                                        v-model="form.content"
                                                        :disabled='disableForm'
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>
        </div>
    </section>
</template>

<script>
    import Multiselect from "vue-multiselect";
    import datetime from 'vuejs-datetimepicker';
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import { quillEditor } from 'vue-quill-editor'

    export default {
        name: "EditCreateNotification",
        components: {
            Multiselect,
            datetime,
            quillEditor
        },
        data() {
            return {
                editmode: false,
                isValidate: false,
                form: new Form({
                    notification_id: 0,
                    title: "",
                    groups: [],
                    content: "",
                    confirm: false,
                    draft: false,
                    schedule_date: "",
                }),
                groups: [],
                manual: false,
                checkedDR: false,
                checkedDH: false,
                disableForm: false,
            };
        },
        created() {
            this.$Progress.start();
            if (this.$route.params.id) {
                this.form.notification_id = this.$route.params.id;
            }

            this.loadNotification();
            this.$Progress.finish();

        },
        mounted() {
            this.$refs.quill.quill.getModule("toolbar").addHandler("image", this.imageHandler);
        },
        watch: {
            'form.groups' : function (value) {
                this.checkedDR = _.findIndex(this.form.groups, {id: 1}) > -1 ? true : false;
                this.checkedDH = _.findIndex(this.form.groups, {id: 2}) > -1 ? true : false;
            }
        },
        methods: {
            resetForm() {
                this.isValidate = false;
                this.form = new Form({
                    notification_id: 0,
                    title: "",
                    groups: [],
                    content: "",
                    confirm: false,
                    draft: false,
                    schedule_date: "",
                });
            },
            getResults(page = 1) {
                this.$Progress.start();
                console.log("get Results");
                axios
                    .get("/api/notification?page=" + page)
                    .then(({data}) => (this.notifications = data.data));

                this.$Progress.finish();
            },
            loadNotification() {
                this.$Progress.start();
                this.form.groups = [];
                if (this.$gate.isAdmin()) {
                    axios.get("/api/group/all").then(({data}) => {
                        this.groups = data.data;
                        if (
                            this.form.notification_id <= 0 ||
                            this.form.notification_id == undefined
                        ) {
                            this.form.groups.push(this.groups[0]);
                            this.form.groups.push(this.groups[1]);
                        }
                    });
                }
                if (this.form.notification_id > 0) {
                    axios
                        .get("/api/notification/" + this.form.notification_id + "/show")
                        .then(({data}) => {
                            this.form.title = data.data.title;
                            this.form.content = data.data.content;
                            this.form.draft = data.data.draft;
                            this.disableForm = new Date(data.data.schedule_date) <= new Date() && !data.data.draft;
                            if (this.disableForm) {
                                $('#tj-datetime-input').prop( "disabled", true );
                            }

                            this.form.schedule_date = this.$moment(data.data.schedule_date).format('YYYY-MM-DD hh:mm:ss');
                            if (data.data.confirm == 1) {
                                this.form.confirm = true;
                            } else {
                                this.form.confirm = false;
                            }

                            data.data.notification_groups.forEach((item) => {
                                this.form.groups.push(item.group);
                            });
                        });
                }
                this.$Progress.finish();
            },
            validateForm() {
                this.isValidate = true;
                if (this.form.title.length <= 0) {
                    Toast.fire({
                        icon: "error",
                        title: this.$t('app').notification.require_title,
                    });
                    this.isValidate = false;
                }
                if (this.form.groups.length <= 0) {
                    Toast.fire({
                        icon: "error",
                        title: this.$t('app').notification.require_group,
                    });
                    this.isValidate = false;
                }
                if (this.form.content.length <= 0) {
                    Toast.fire({
                        icon: "error",
                        title: this.$t('app').notification.require_content,
                    });
                    this.isValidate = false;
                }
            },
            saveNotification(draft = 1) {
                this.validateForm();
                if (!this.isValidate) {
                    return;
                }
                this.form.draft = draft;
                axios.post("/api/notification/store", this.form)
                    .then((data) => {
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                        this.$Progress.finish();
                        this.resetForm();
                        this.$router.push({path: "/admin/notification"});
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t('app').notification.some_error,
                        });
                    });
            },
            changeCheckedDR(value) {
                 if (value) {
                     this.form.groups = _.union(this.form.groups, [{
                         id: 1,
                         name: 'DR'
                     }]);
                 } else {
                     this.form.groups = _.filter(this.form.groups, ({id}) => id != 1);
                 }
            },
            changeCheckedDH(value) {
                if (value) {
                    this.form.groups = _.union(this.form.groups, [{
                        id: 2,
                        name: 'DH'
                    }]);
                } else {
                    this.form.groups = _.filter(this.form.groups, ({id}) => id != 2);
                }
            },
            imageHandler() {
                var input = document.createElement("input");
                input.setAttribute("type", "file");
                input.click();
                // Listen upload local image and save to server
                input.onchange = () => {
                    let file = input.files[0];
                    let maxFileSize = 3000000 // 3MB
                    // file type is only image.
                    if (/^image\//.test(file.type)) {
                        if (file.size > maxFileSize) {
                            return this.$alert('Over rate limit of filesize', {confirmButtonText: 'OK'});
                        }

                        this.uploadImage(file);
                    } else {
                        return this.$alert(this.language.upload.file_invalid, {
                            confirmButtonText: 'OK',
                        });
                    }
                }
            },
            uploadImage(file) {
                let formData = new FormData()
                formData.append('image', file);
                let uploadedInfo = {data: {access_url: null}}
                axios.post(`/api/s3/store`, formData)
                    .then(response => {
                        let imageUrl = response.data.image_url;
                        const range = this.$refs.quill.quill.getSelection()
                        this.$refs.quill.quill.insertEmbed(range.index, 'image', imageUrl)
                    })
                    .catch(error => {
                        console.log(error);
                        return this.$alert(this.$t('ugc.system_error'), {confirmButtonText: 'OK'});
                    });
            }
        },
    };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    #tj-datetime-input {
        height: 40px;
        border-radius: 4px;
        padding-left: 10px;
    }
</style>
