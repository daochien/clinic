<template>
    <div>
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('blog.title_page_create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-center text-sm-right mb-0">
                <button class="btn btn-primary float-right" style="font-size: 16px; width: 140px;" @click="createPost()">
                    Public
                </button>
                <button class="mb-2 btn btn-outline-light mr-1" style="font-size: 16px;" @click="createPost()">
                    Draft
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <!-- Add New Post Form -->
                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Article Content</h6>
                    </div>
                    <div class="card-body">
                        <form class="add-new-post">
                            <div class="form-group">
                              <label for="feInputTitle">Title ({{ post.title.length }}/100)</label>
                              <input
                              type="text"
                              :class="['form-control', {'is-invalid': $v.post.title.$error}]"
                              id="feInputTitle"
                              v-model="$v.post.title.$model"
                              placeholder="Your Post Title">
                              <div class="invalid-feedback" v-if="!$v.post.title.required">This is title required.</div>
                              <div class="invalid-feedback" v-if="!$v.post.title.maxLength">This is title max 100 char.</div>
                            </div>
                            <div class="form-group">
                                <label for="feInputContent">Content ({{ post.content.length }}/1000)</label>
                                <div :class="{'is-invalid': $v.post.content.$error}">
                                    <ckeditor v-model="$v.post.content.$model" :editor="editor" :config="editorConfig"></ckeditor>
                                </div>
                                <div class="invalid-feedback" style="display:block;" v-if="!$v.post.content.required && $v.post.content.$error">This is content required.</div>
                                <div class="invalid-feedback" style="display:block;" v-if="!$v.post.content.maxLength">This is content max 1000 char.</div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- / Add New Post Form -->
            </div>
            <div class="col-lg-4 col-md-12">
                <!-- Post Overview -->
                <div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Infomation</h6>
                  </div>
                  <div class='card-body'>
                    <div class="form-inline mb-3">
                        <label for="email">
                            <span class="mr-sm-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18 4H19C20.1 4 21 4.9 21 6V20C21 21.1 20.1 22 19 22H5C3.89 22 3 21.1 3 20L3.01 6C3.01 4.9 3.89 4 5 4H6V2H8V4H16V2H18V4ZM5 10V20H19V10H5ZM19 8H5V6H19V8ZM12 13H17V18H12V13Z" fill="#3D5170"/>
                                </svg>
                            </span>
                            Date
                        </label>
                        <div class="offset-1">
                            <datepicker
                            v-model="$v.post.post_date.$model"
                            :disabledDates="disabledDateStart"
                            :calendar-class="'custom-datepicker'"
                            :input-class="{'form-control': true, 'form-control-sm': true, 'is-invalid': $v.post.post_date.$error}">
                            </datepicker>
                        </div>
                        <div class="invalid-feedback offset-3" style="display:block;" v-if="!$v.post.post_date.required && $v.post.post_date.$error">This is post date required.</div>
                    </div>
                    <div class="form-inline">
                        <label for="status">
                            <span class="mr-sm-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.48 6.47 2 11.99 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 11.99 22C6.47 22 2 17.52 2 12ZM15.97 8H18.92C17.96 6.35 16.43 5.07 14.59 4.44C15.19 5.55 15.65 6.75 15.97 8ZM12 4.04C12.83 5.24 13.48 6.57 13.91 8H10.09C10.52 6.57 11.17 5.24 12 4.04ZM4 12C4 12.69 4.1 13.36 4.26 14H7.64C7.56 13.34 7.5 12.68 7.5 12C7.5 11.32 7.56 10.66 7.64 10H4.26C4.1 10.64 4 11.31 4 12ZM5.08 16H8.03C8.35 17.25 8.81 18.45 9.41 19.56C7.57 18.93 6.04 17.66 5.08 16ZM5.08 8H8.03C8.35 6.75 8.81 5.55 9.41 4.44C7.57 5.07 6.04 6.34 5.08 8ZM12 19.96C11.17 18.76 10.52 17.43 10.09 16H13.91C13.48 17.43 12.83 18.76 12 19.96ZM9.5 12C9.5 12.68 9.57 13.34 9.66 14H14.34C14.43 13.34 14.5 12.68 14.5 12C14.5 11.32 14.43 10.65 14.34 10H9.66C9.57 10.65 9.5 11.32 9.5 12ZM14.59 19.56C15.19 18.45 15.65 17.25 15.97 16H18.92C17.96 17.65 16.43 18.93 14.59 19.56ZM16.5 12C16.5 12.68 16.44 13.34 16.36 14H19.74C19.9 13.36 20 12.69 20 12C20 11.31 19.9 10.64 19.74 10H16.36C16.44 10.66 16.5 11.32 16.5 12Z" fill="#3D5170"/>
                                </svg>
                            </span>
                            Status
                        </label>
                        <div class="offset-1">
                            <select  class="form-control form-control-sm" id="status" v-model="post.draft" >
                                <option value="0">Public</option>
                                <option value="1">UnPublic</option>
                            </select>
                        </div>

                    </div>
                  </div>
                </div>
                <!-- / Post Overview -->
                <!-- Post Overview -->
                <div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Category</h6>
                  </div>
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item px-3 pb-2">
                        <div
                        class="custom-control custom-checkbox mb-1"
                        v-for="(cat, index) in categories" :key="index">
                          <input
                          type="checkbox"
                          :class="['custom-control-input', {'is-invalid': $v.post.category_ids.$error}]"
                          :id="`cate_${index}`"
                          v-model="$v.post.category_ids.$model"
                          :value="index">
                          <label class="custom-control-label" :for="`cate_${index}`">{{ cat }}</label>
                        </div>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <div class="input-group">
                          <input
                          type="text"
                          :class="['form-control', {'is-invalid': $v.category.name.$error}]"
                          v-model="$v.category.name.$model"
                          placeholder="Add new category"
                          aria-label="Add new category"
                          aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white px-2" type="button" @click="createCategory()"><i class="material-icons">+</i></button>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- / Post Overview -->
                <div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Image</h6>
                  </div>
                  <div class='card-body'>
                    <div class="input-group mb-3 preview__image__post">
                        <img :src="previewImage">
                    </div>
                    <!-- <button type="button" class="mb-2 btn btn-outline-danger mr-2">Danger</button> -->
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input
                            type="file"
                            :class="['custom-file-input', {'is-invalid': $v.previewImage.$error}]"
                            id="uploadImage"
                            @change="onImageChange">
                            <label class="custom-file-label" for="uploadImage">Choose file...</label>
                        </div>
                    </div>
                    <div class="invalid-feedback" style="display:block;" v-if="!$v.previewImage.required && $v.previewImage.$error">This is image required.</div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/ja';
import Datepicker from 'vuejs-datepicker';
import { required, minLength, between, requiredIf, email, maxLength, numeric, minValue } from 'vuelidate/lib/validators';

class UploadAdapter {

    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return new Promise((resolve, reject) => {
            const data = new FormData();
            data.append('upload', this.loader.file);
            resolve({
                default: 'https://scontent-xsp1-2.xx.fbcdn.net/v/t1.0-9/s960x960/83823156_2489042574541029_3664970652525264896_o.jpg?_nc_cat=106&_nc_sid=85a577&_nc_ohc=zKocENzZ-HwAX88UodN&_nc_ht=scontent-xsp1-2.xx&_nc_tp=7&oh=93b570531ff84e4f42e908a96a9dff2f&oe=5F4BF398'
            });
            // axios({
            //     url: '/index/uploadimage',
            //     method: 'post',
            //     data,
            //     headers: {
            //         'Content-Type': 'multipart/form-data;'
            //     },
            //     withCredentials: false
            // }).then(response => {
            //     if (response.data.result == 'success') {
            //         resolve({
            //             default: response.data.url
            //         });
            //     } else {
            //         reject(response.data.message);
            //     }
            // }).catch(response => {
            //     reject ( 'Upload failed');
            // });

        });
    }

    abort() {
    }
}

export default {
    components: {
        Datepicker
    },
    data () {
        return {
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                // language: 'ja',
                extraPlugins: [ this.MyCustomUploadAdapterPlugin ],
            },
            previewImage: '',
            disabledDateStart: {
                to: new Date(Date.now() - 8640000),
                from: '',
            },
            post: {
                id : '',
                category : '',
                title: '',
                content: '',
                image: '',
                category_ids: [],
                draft: 0,
                post_date: '',                
            },
            categories: [],
            category: {
                name: '',
                type: 2
            },            
        }
    },
    validations: {
        post: {
            title: {
                required,
                maxLength: maxLength(100)
            },
            content: {
                required,
                maxLength: maxLength(1000)
            },
            category_ids: {
                required
            },
            post_date: {
                // required
            }
        },
        previewImage: {
            required
        },
        category: {
            name: {
                required
            }
        }
    },
    created () {
        this.loadCategories();
    },
    mounted () {

    },
    methods: {
        MyCustomUploadAdapterPlugin ( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new UploadAdapter( loader );
            };
        },

        onImageChange (e) {

            try {
                let files = e.target.files || e.dataTransfer.files;
                // this.resetData();
                if (!files.length)
                    return;
                if ( /\.(jpe?g|png|gif)$/i.test( files[0].name ) ) {
                    this.post.image = files[0];
                    this.previewImage = URL.createObjectURL(files[0]);
                } else {
                    this.post.image = '';
                    this.previewImage = '';
                    alert('File error');
                }
            } catch(error) {

            }
        },

        loadCategories () {
            axios.get("/api/category/list?type=2").then(({ data }) => (this.categories = data.data));
        },

        createCategory () {
            this.$v.category.$touch();
            if (!this.$v.category.$invalid) {
                this.$Progress.start();
                
                axios.post('/api/category', this.category)
                .then((data)=>{
                    // $('#addNew').modal('hide');
                    this.loadCategories();
                    Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });

                    this.$Progress.finish();
                    this.loadCategories();

                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            }

        },

        createPost () {
            this.$v.post.$touch();
            this.$v.previewImage.$touch();
            if (!this.$v.post.$invalid && !this.$v.previewImage.$touch()) {
                this.$Progress.start();

                let params = this.handleSubmit();
                
                axios.post('/api/blog', params, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((data)=>{
                    console.log(data);
                    Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });

                    this.$Progress.finish();                    

                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            }
        },
        
        handleSubmit () {
            let data = new FormData();
            data.append('title', this.post.title);
            data.append('content', this.post.content);
            data.append('image', this.post.image);
            data.append('draft', this.post.draft);
            data.append('category_ids', this.post.category_ids);
            this.post.category_ids.forEach(function (cate) {
                data.append('category_ids[]', cate);
            });
            
            return data;
        }
    }
}
</script>

<style lang="scss">
.custom-datepicker {
    right: 0;
}
.ck-content {
    height: 350px;
}
.is-invalid {
    .ck-content {
        border-color: #c4183c !important;
        box-shadow: 0 5px 11.5px rgba(196, 24, 60, 0.1);
    }
}
.preview__image__post {
    max-height: 150px;
    overflow: hidden;
    img {
        width: 100%;
    }
}
</style>
