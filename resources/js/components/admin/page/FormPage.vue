<template>
    <div class="page-form-create">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ isEdit ? $t('page.info._page_title_edit') : $t('page.info._page_title_create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-center text-sm-right mb-0">
                <button
                v-if="!isEdit"
                class="btn btn-primary float-right"
                style="font-size: 16px; width: 140px;"
                @click="createPage()">
                    {{ $t('page.info.others._btn_create') }}
                </button>
                <button
                v-if="isEdit"
                class="btn btn-primary float-right"
                style="font-size: 16px; width: 140px;"
                @click="updatePage()">
                    {{ $t('page.info.others._btn_edit') }}
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-10 offset-1">
                    <div class="title">
                        <span style="font-size: 18px;">{{ $t('page.info._basic_info') }}</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._type') }} <span color="color:#c4183c;">*</span></label>
                                <div class="col-sm-10 col-form-label">
                                    <div class="custom-control custom-radio form-check-inline float-left">
                                        <input class="custom-control-input" type="radio" id="inlineArticle" v-model="page.type" :value="'blog'">
                                        <label class="custom-control-label" for="inlineArticle">Article</label>
                                    </div>
                                    <div class="custom-control custom-radio form-check-inline float-left">
                                        <input class="custom-control-input" type="radio" id="inlineManual" v-model="page.type" :value="'manual'">
                                        <label class="custom-control-label" for="inlineManual">Manual</label>
                                    </div>
                                    <div class="custom-control custom-radio form-check-inline float-left">
                                        <input class="custom-control-input" type="radio" id="inlineFAQ" v-model="page.type" :value="'faq'">
                                        <label class="custom-control-label" for="inlineFAQ">FAQ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._title') }} <span color="color:#c4183c;">*</span></label>
                                <div class="col-sm-10 ">
                                    <input
                                    type="text"
                                    :class="['form-control', {'is-invalid': pageFormErrors.errors.has('title')}]"
                                    v-model="page.title"
                                    :placeholder="$t('page.attr._title_pl')">
                                    <has-error :form="pageFormErrors" field="title"></has-error>
                                </div>
                            </div>
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._public') }} </label>
                                <div class="col-sm-10 col-form-label">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch1" v-model="page.public">
                                        <label for="switch1">Toggle</label>
                                    </div>
                                    <has-error :form="pageFormErrors" field="public"></has-error>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._public_date') }} </label>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-4">
                                        <datetime
                                        ref="datetime"
                                        :required="true"
                                        format="YYYY-MM-DD h:i:s"
                                        v-model='page.public_date'
                                        :disabled-dates="{ to: new Date(Date.now()) }"></datetime>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._status') }}</label>
                                <div class="col-sm-10 col-form-label">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch2" v-model="page.status">
                                        <label for="switch2">Toggle</label>
                                    </div>
                                    <has-error :form="pageFormErrors" field="status"></has-error>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._url') }}</label>
                                <div class="col-sm-10">
                                    <input
                                    v-model="page.url"
                                    type="text"
                                    :class="['form-control', {'is-invalid': pageFormErrors.errors.has('url')}]"
                                    :placeholder="$t('page.info.form._url_pl')">
                                    <has-error :form="pageFormErrors" field="url"></has-error>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._category') }} <span color="color:#c4183c;">*</span></label>
                                <div class="col-sm-4">
                                    <select
                                    :class="['form-control', {'is-invalid': pageFormErrors.errors.has('category_id')}]"
                                    v-model="page.category_id">
                                        <option value="">{{ $t('page.info.form._category_pl') }}</option>
                                        <option
                                        v-for="(cat,index) in categories" :key="index"
                                        :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                    <has-error :form="pageFormErrors" field="category_id"></has-error>
                                </div>
                                <label @click="showModalCategory()" class="col-sm-2 col-form-label" style="color:#007BFF; cursor:pointer;">+ {{ $t('page.info.popup._btn_show_popup_category') }}</label>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">{{ $t('page.attr._image') }}</label>
                                <div class="col-sm-4" v-show="previewImage">
                                    <img :src="previewImage" style="width:100%;">
                                </div>
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input
                                        type="file"
                                        :class="['custom-file-input', {'is-invalid': pageFormErrors.errors.has('image')}]"
                                        id="uploadImage"
                                        @change="onImageChange">
                                        <label class="custom-file-label" for="uploadImage">Choose file...</label>
                                    </div>
                                    <has-error :form="pageFormErrors" field="image"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 30px;">

                <div class="col-10 offset-1">
                    <div class="title">
                        <span style="font-size: 18px;">{{ $t('page.info._article_content') }}</span>
                    </div>
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item col-sm-6">
                                <a class="nav-link active" data-toggle="tab" href="#home">{{ $t('page.info.tabs._manual') }}</a>
                            </li>
                            <li class="nav-item col-sm-6">
                                <a class="nav-link" data-toggle="tab" href="#menu1">{{ $t('page.info.tabs._file') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <quill-editor
                                    ref="quill"
                                    :content="page.content"
                                    v-model="page.content"
                                    :disabled='disableForm'
                                />
                            </div>
                            <div class="tab-pane container fade" id="menu1">
                                <vue-dropzone
                                ref="myVueDropzone"
                                id="dropzone"
                                @vdropzone-file-added="vfileAdded"
                                @vdropzone-removed-file="removeFile"
                                :options="dropzoneOptions"
                                :useCustomSlot=true>
                                    <div class="dropzone-custom-content">
                                        <h3 class="dropzone-custom-title">{{ $t('page.info.form._title_upload') }}</h3>
                                        <div class="subtitle">{{ $t('page.info.form._content_upload') }}</div>
                                        <button class="btn btn-white">{{ $t('page.info.form._btn_upload') }}</button>
                                    </div>
                                </vue-dropzone>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $t('page.info.popup._create_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="createCategory()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>{{ $t('page.info.popup.attr._name') }}</label>
                                    <input v-model="formCategory.name" type="text" name="name"
                                        class="form-control" :class="{ 'is-invalid': formCategory.errors.has('name') }">
                                    <has-error :form="formCategory" field="name"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('page.info.popup._btn_close') }}</button>
                                <button type="submit" class="btn btn-success">{{ $t('page.info.popup._btn_create') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import { VueEditor } from "vue2-editor";

import datetime from 'vuejs-datetimepicker';

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'

export default {
    props: {
        isEdit: Boolean
    },
    components: {
        datetime,
        quillEditor,
        vueDropzone: vue2Dropzone,
    },
    data () {
        return {
            disabledDateStart: {
                to: new Date(Date.now() - 8640000),
                from: '',
            },
            previewImage: '',

            dropzoneOptions: {
                autoProcessQueue: false,
                url: 'https://httpbin.org/post',
                thumbnailWidth: 170,
                maxFilesize: 50,
                addRemoveLinks: true,
                duplicateCheck: true,
                maxFiles: 1,
                acceptedFiles: '.jpeg,.png,.jpg,.zip,.pdf,.ppt,.pptx,.xlx,.xlsx,.docx,.doc,.gif,.webm,.mp4,.mpeg'
            },
            page: {
                type: 'blog',
                title: '',
                public: true,
                public_date: '',
                status: false,
                url: '',
                content: '',
                files: [],
                image: '',
                category_id: ''
            },
            pageFormErrors: new Form({}),
            disableForm: false,
            counter: 0,
            formCategory: new Form({
                name: '',
                type: 1
            }),
            categories: []
        }
    },
    created () {
        this.loadCategory();
        this.infoPage();
    },
    mounted () {
        this.$refs.quill.quill.getModule("toolbar").addHandler("image", this.imageHandler);
    },
    methods: {
        showModalCategory () {
            this.formCategory.reset();
            $('#addCategory').modal('show');
        },

        onImageChange (e) {
            try {
                let files = e.target.files || e.dataTransfer.files;
                // this.resetData();
                if (!files.length)
                    return;
                if ( /\.(jpe?g|png|gif)$/i.test( files[0].name ) ) {
                    this.page.image = files[0];
                    this.previewImage = URL.createObjectURL(files[0]);
                } else {
                    this.page.image = '';
                    if (!this.isEdit) {
                        this.previewImage = '';
                    }
                    alert('File error');
                }
            } catch(error) {}
        },
        vfileAdded (file) {
            this.page.files.push(file);
        },
        removeFile (file, error, xhr) {
            let index = this.page.files.indexOf(file);
            this.page.files.splice(index, 1);
        },
        async createPage () {
            this.$Progress.start();
            try {
                let params = this.handleSubmit();
                let {data} = await axios.post('/api/page', params, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if (data.success) {
                    this.$router.push({path: '/admin/page'});
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.info.form.messages._create_success')
                    });
                } else {
                    if (data.code == '01') {
                        this.pageFormErrors.errors.errors = data.errors;
                    }
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.info.form.messages._create_failed')
                    });
                }

            } catch (error) {
                console.log(error);
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            }
            this.$Progress.finish();
        },
        handleSubmit () {
            let data = new FormData();
            data.append('type', this.page.type);
            data.append('image', this.page.image);
            data.append('title', this.page.title);
            data.append('public', this.page.public == true ? 1 : 0);
            data.append('public_date', this.page.public_date);
            data.append('hours', this.page.hours);
            data.append('minute', this.page.minute);
            data.append('status', this.page.status == true ? 1 : 0);
            data.append('url', this.page.url);
            data.append('category_id', this.page.category_id);
            data.append('content', this.page.content);

            if (this.page.files.length > 0) {
                for (let i = 0; i < this.page.files.length; i++) {
                    data.append('files[]', this.page.files[i]);
                }
            }

            return data;
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
        },
        loadCategory () {
            axios.get("/api/category/type/document").then(({ data }) => (this.categories = data.data));
        },
        createCategory () {
            this.$Progress.start();
            this.formCategory.post('/api/category')
                .then( ({data}) => {
                    if(data.success) {
                        $('#addCategory').modal('hide');
                        this.loadCategory();
                        this.page.category_id = data.data.id;
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('admin.info.form.messages._create_success')
                        });
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('admin.info.form.messages._create_failed')
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('common.messages._system_err')
                    });
                })
        },

        infoPage () {
            if (this.isEdit) {
                axios.get("/api/page/"+this.$route.params.id)
                .then(({ data }) => {
                    if (data.data) {
                        this.syncRespone(data.data);
                        this.isEdit = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        },

        syncRespone (data) {
            this.page.id = data.id;
            this.page.title = data.title;
            this.page.type = data.type;
            this.page.public = data.public == 1 ? true: false;
            this.page.public_date = data.public_date;
            this.page.status = data.status;
            this.page.url = data.url;
            this.page.content = data.content;
            this.page.category_id = data.category_id;
            this.previewImage = data.image;
            if (data.files) {
                let objFile = JSON.parse(data.files);
                this.$refs.myVueDropzone.manuallyAddFile({
                    name: objFile.name,
                    size: objFile.size,
                    type: objFile.type
                }, objFile.path);
            }
        },

        async updatePage () {

            this.$Progress.start();
            try {
                let params = this.handleSubmit();
                let {data} = await axios.post('/api/page/'+this.page.id, params, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if (data.success) {
                    this.$router.push({path: '/admin/page'});
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.info.form.messages._edit_success')
                    });
                } else {
                    if (data.code == '01') {
                        this.pageFormErrors.errors.errors = data.errors;
                    }
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.info.form.messages._edit_failed')
                    });
                }

            } catch (error) {
                console.log(error);
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            }
            this.$Progress.finish();

        },
    }
}
</script>
<style scoped>
.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 70px; max-width: 70px; height: 22px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 0px; left: 2px; width: 22px; height: 22px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #3e98d3; }
.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'No'; position: absolute; top: 0px; left: 35px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Yes'; position: absolute; top: 0px; left: 10px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 60px; }
.toggle-switchArea { margin: 10px 0 10px 0; }
.nav-item .active {
    border-bottom: 2px solid #007BFF !important;
}
.nav-item {
    text-align: center;
    padding: 0;
    background: rgba(0, 0, 0, 0.05);
}
.nav-item a {
    border-radius: 0px;
    color: #3D5170;
}
.tab-content {
    min-height: 500px;
}
.tab-content .tab-pane {
    padding: 10px;
}
</style>
<style>
.vdp-datepicker__clear-button {
    position: absolute;
    top: 6px;
    right: 30px;
    color: red;
}
.vdp-datepicker__calendar-button {
    position: absolute;
    right: 10px;
    top: 5px;
}

.ql-container {
    min-height: 400px;
}
.vue-dropzone {
    border: 1px dashed #000000;
}
.dropzone .dz-preview {
    width: auto;
}
.dropzone .dz-preview .dz-image {
    max-width: 170px;
    margin-right: unset;
}
</style>
<style>
    #tj-datetime-input {
        height: 33px;
        /* font-size: 0.8125rem; */
        border-radius: 4px;
        padding-left: 10px;
    }
    #tj-datetime-input:focus {
        outline: none;
    }
</style>
