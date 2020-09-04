<template>
    <div class="page-form-create">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">Create Page</h3>
            </div>
            <div class="col-12 col-sm-8 text-center text-sm-right mb-0">
                <button class="btn btn-primary float-right" style="font-size: 16px; width: 140px;" @click="createPage()">
                    Create New
                </button>
            </div>
        </div>
        <div class="container-fluid">            
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-10 offset-1">
                    <div class="title">
                        <span style="font-size: 18px;">Basic information</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">Type <span color="color:#c4183c;">*</span></label>
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
                                <label class="col-sm-2 col-form-label">Title <span color="color:#c4183c;">*</span></label>
                                <div class="col-sm-10 ">
                                    <input 
                                    type="text" 
                                    :class="['form-control', {'is-invalid': pageFormErrors.errors.has('title')}]"
                                    v-model="page.title" 
                                    placeholder="Please enter a title">
                                    <has-error :form="pageFormErrors" field="title"></has-error>
                                </div>
                            </div>
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">Release </label>
                                <div class="col-sm-10 col-form-label">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch1" v-model="page.release">
                                        <label for="switch1">Toggle</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">Release Date </label>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-4">
                                        <datepicker
                                            v-model="page.release_date"
                                            :format="formatUnix"
                                            :calendar-button="true"
                                            :calendar-button-icon="'fa fa-calendar'"
                                            :clear-button="true"
                                            :wrapper-class="'custom-datepicker'"
                                            :disabledDates="disabledDateStart"
                                            :input-class="{'form-control': true, 'is-invalid': false}">
                                        </datepicker>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" v-model="page.hours">
                                            <option value="">Hours</option>
                                            <option v-for="i in 24" :key="i">{{ i - 1 }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" v-model="page.minute">
                                            <option value="">Minute</option>
                                            <option v-for="i in 60" :key="i">{{ i - 1 }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom">
                                <label class="col-sm-2 col-form-label">Public</label>
                                <div class="col-sm-10 col-form-label">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch2" v-model="page.public">
                                        <label for="switch2">Toggle</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">Public destination</label>
                                <div class="col-sm-10">
                                    <input v-model="page.public_destination" type="text" class="form-control" placeholder="Please specify the publication destination">
                                </div>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-4">
                                    <select class="form-control" v-model="page.category_id">
                                        <option value="">Please specify a category</option>
                                        <option
                                        v-for="(cat,index) in categories" :key="index"
                                        :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                </div>
                                <label @click="showModalCategory()" class="col-sm-2 col-form-label" style="color:#007BFF; cursor:pointer;">+ Add Category</label>
                            </div>
                            <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-4" v-show="previewImage">
                                    <img :src="previewImage" style="width:100%;">
                                </div>
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input
                                        type="file"
                                        :class="['custom-file-input', {'is-invalid': false}]"
                                        id="uploadImage"
                                        @change="onImageChange">
                                        <label class="custom-file-label" for="uploadImage">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 30px;">

                <div class="col-10 offset-1">
                    <div class="title">
                        <span style="font-size: 18px;">Article content</span>
                    </div>
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item col-sm-6">
                                <a class="nav-link active" data-toggle="tab" href="#home">Manual setting</a>
                            </li>
                            <li class="nav-item col-sm-6">
                                <a class="nav-link" data-toggle="tab" href="#menu1">File upload</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <!-- <vue-editor id="editor" useCustomImageHandler @image-added="handleImageAdded" v-model="page.content"></vue-editor> -->
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
                                        <h3 class="dropzone-custom-title">Please choose the file</h3>
                                        <div class="subtitle">Please upload the document (pdf, docx ppt), image file (png, jpg) or video (mp4).</div>
                                        <button class="btn btn-white">Upload file</button>
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
                            <h5 class="modal-title" >Create Category</h5>                        
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="createCategory()">
                            <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input v-model="formCategory.name" type="text" name="name"
                                            class="form-control" :class="{ 'is-invalid': formCategory.errors.has('name') }">
                                        <has-error :form="formCategory" field="name"></has-error>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Create</button>                            
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

import moment from 'moment';
import Datepicker from 'vuejs-datepicker';

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'

export default {
    components: {
        Datepicker,
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
                maxFilesize: 0.5,
                addRemoveLinks: true,
                duplicateCheck: true,
                maxFiles: 1
            },
            page: {
                type: 'blog',
                title: '',
                release: true,
                release_date: '',
                hours: '',
                minute: '',
                public: false,
                public_destination: '',
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
    },
    mounted () {
        this.$refs.quill.quill.getModule("toolbar").addHandler("image", this.imageHandler);
    },
    methods: {
        showModalCategory () {
            this.formCategory.reset();
            $('#addCategory').modal('show');
        },
        formatUnix (date) {
            return moment(date).format('DD/MM/YYYY');
        },
        formatDate (date) {
            return moment(date).format('YYYY-MM-DD');
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
                    this.previewImage = '';
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
            
           
            // .then((data)=>{
            //     console.log(data);
            //     Toast.fire({
            //         icon: 'success',
            //         title: data.data.message
            //     });

            //     this.$Progress.finish();

            // })
            // .catch(e => {
            //     console.log(e.data.errors);
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Some error occured! Please try again'
            //     });
            // })
        },
        handleSubmit () {
            let data = new FormData();
            data.append('type', this.page.type);
            data.append('image', this.page.image);
            data.append('title', this.page.title);
            data.append('release', this.page.release == true ? 1 : 0);
            data.append('release_date', this.formatDate(this.page.release_date));
            data.append('hours', this.page.hours);
            data.append('minute', this.page.minute);
            data.append('public', this.page.public == true ? 1 : 0);
            data.append('public_destination', this.page.public_destination);
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
        }
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
