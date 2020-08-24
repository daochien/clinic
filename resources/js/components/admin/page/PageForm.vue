<template>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-10 offset-1">
                <div class="title">
                    <span style="font-size: 18px;">Basic information</span>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row border-bottom">
                            <label class="col-sm-2 col-form-label">Documents <span color="color:#c4183c;">*</span></label>
                            <div class="col-sm-10 col-form-label">
                                <div class="custom-control custom-radio form-check-inline float-left">
                                    <input class="custom-control-input" type="radio" id="inlineArticle" value="option1">
                                    <label class="custom-control-label" for="inlineArticle">Article</label>
                                </div>
                                 <div class="custom-control custom-radio form-check-inline float-left">
                                    <input class="custom-control-input" type="radio" id="inlineManual" value="option2">
                                    <label class="custom-control-label" for="inlineManual">Manual</label>
                                </div>
                                 <div class="custom-control custom-radio form-check-inline float-left">
                                    <input class="custom-control-input" type="radio" id="inlineFAQ" value="option3">
                                    <label class="custom-control-label" for="inlineFAQ">FAQ</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                            <label class="col-sm-2 col-form-label">Title <span color="color:#c4183c;">*</span></label>
                            <div class="col-sm-10 ">
                                <input type="text" class="form-control" placeholder="Please enter a title">
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label class="col-sm-2 col-form-label">Release </label>
                            <div class="col-sm-10 col-form-label">
                                <div class="switchToggle">
                                    <input type="checkbox" id="switch1" checked>
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                            <label class="col-sm-2 col-form-label">Release Date </label>
                            <div class="col-sm-10 row">
                                <div class="col-sm-4">
                                    <datepicker
                                        :calendar-button="true"
                                        :calendar-button-icon="'fa fa-calendar'"
                                        :clear-button="true"
                                        :wrapper-class="'custom-datepicker'"
                                        :disabledDates="disabledDateStart"
                                        :input-class="{'form-control': true, 'is-invalid': false}">
                                    </datepicker>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control">
                                        <option>Hours</option>
                                        <option v-for="i in 24" :key="i">{{ i }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control">
                                        <option>Minute</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label class="col-sm-2 col-form-label">Public</label>
                            <div class="col-sm-10 col-form-label">
                                <div class="switchToggle">
                                    <input type="checkbox" id="switch2" checked>
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                            <label class="col-sm-2 col-form-label">Public destination</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Please specify the publication destination">
                            </div>
                        </div>
                        <div class="form-group row border-bottom" style="padding-bottom: 10px;">
                            <label class="col-sm-2 col-form-label">Category <span color="color:#c4183c;">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control">
                                    <option value="">Please specify a category</option>
                                </select>
                            </div>
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
                            <quill-editor
                                :style="{'height': '400px'}"
                                ref="myQuillEditor"
                                v-model="content"
                                :options="editorOption"
                            />
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" :useCustomSlot=true>
                                <div class="dropzone-custom-content">
                                    <h3 class="dropzone-custom-title">Please choose the file</h3>
                                    <div class="subtitle">Please upload the document (pdf, docx ppt), image file (png, jpg) or video (mp4).</div>
                                </div>
                            </vue-dropzone>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        Datepicker,
        quillEditor,
        vueDropzone: vue2Dropzone
    },
    data () {
        return {
            disabledDateStart: {
                to: new Date(Date.now() - 8640000),
                from: '',
            },
            previewImage: '',
            content: '',
            editorOption: {},
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: { "My-Awesome-Header": "header value" },
                addRemoveLinks: true
            }
        }
    },
    created () {

    },
    methods: {
        onImageChange (e) {

            try {
                let files = e.target.files || e.dataTransfer.files;
                // this.resetData();
                if (!files.length)
                    return;
                if ( /\.(jpe?g|png|gif)$/i.test( files[0].name ) ) {
                    // this.post.image = files[0];
                    this.previewImage = URL.createObjectURL(files[0]);
                } else {
                    // this.post.image = '';
                    this.previewImage = '';
                    alert('File error');
                }
            } catch(error) {

            }
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
    height: 500px;
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

.quill-editor {
    height: 100%;
}
.vue-dropzone {
    border: 1px dashed #000000;
}
</style>
