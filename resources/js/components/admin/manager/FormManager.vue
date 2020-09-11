<template>
    <div class="container-fluid">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ isEdit ? $t('admin.info._page_title_edit') : $t('admin.info._page_title_create') }}</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <button v-if="isEdit" class="btn mb-2 btn-sm btn-salmon" @click="removeAdmin(manager.id)">{{ $t('admin.info.others._btn_remove') }}</button>
                <button class="mb-2 btn btn-sm btn-primary" v-if="!isEdit" @click="createAdmin()"> {{ $t('admin.info.others._btn_create') }}</button>
                <button class="mb-2 btn btn-sm btn-primary" v-else @click="updateAdmin()"> {{ $t('admin.info.others._btn_edit') }}</button>
            </div>
        </div>
        <div class="col-12 col-sm-10 offset-sm-1">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $t('admin.info.form._subtitle') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6">
                            <label for="feInputTitle">{{ $t('admin.attr._username') }} <span style="color:#c4183c;">*</span></label>
                            <input
                            :placeholder="$t('admin.info.form._username_pl')"
                            :class="['form-control', {'is-invalid': manager.errors.has('name')}]"
                            type="text"
                            v-model.trim="manager.name">
                            <has-error :form="manager" field="name"></has-error>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="feInputTitle">{{ $t('admin.attr._mail_address') }} <span style="color:#c4183c;">*</span></label>
                            <input
                            :placeholder="$t('admin.info.form._mail_address_pl')"
                            :class="['form-control', {'is-invalid': manager.errors.has('email')}]"
                            type="text" v-model.trim="manager.email">
                            <has-error :form="manager" field="email"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ $t('admin.attr._position') }}</label>
                                <span class="text-danger">*</span>
                                <select :class="['form-control', {'is-invalid': manager.errors.has('posittion')}]" id="types" v-model="manager.posittion" >
                                    <option value="" selected>{{ $t('admin.info.form._position_df') }}</option>
                                    <option v-for="(item, index) in posittion" :key="index" :value="item" >{{ index }}</option>
                                </select>
                                <has-error :form="manager" field="posittion"></has-error>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                {{ $t('admin.attr._role') }} <span style="color:#c4183c;">*</span>
                            </div>
                            <div class="col-12" style="margin-top: 12px;">
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left" v-for="(role, index) in roles" :key="index">
                                    <input
                                    type="checkbox"
                                    :class="['custom-control-input', {'is-invalid': manager.errors.has('roles')}]"
                                    class="custom-control-input"
                                    v-model="manager.roles"
                                    :id="'formsCheckboxChecked_'+index"
                                    :value="role">
                                    <label class="custom-control-label" :for="'formsCheckboxChecked_'+index">{{ role }}</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label>{{ $t('app.user.level')}}</label>
                                <select class="form-control" id="levels" v-model="manager.level_id">
                                    <option value="" selected>{{ $t('app.user.place_holder.level') }}</option>
                                    <option v-for="level in levels" :key="'level_' + level.id" :value="level.id">{{ level.name }}</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="feInputTitle">{{ $t('admin.attr._memo') }}</label>
                            <textarea
                            :placeholder="$t('admin.info.form._mail_address_pl')"
                            :class="['form-control', {'is-invalid': manager.errors.has('description')}]"
                            v-model="manager.description"
                            class="form-control"
                            cols="30" rows="10"></textarea>
                            <has-error :form="manager" field="description"></has-error>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { required, minLength, between, requiredIf, email, maxLength, numeric, minValue } from 'vuelidate/lib/validators';

export default {
    props: {
        isEdit: Boolean
    },
    data () {
        return {
            manager: new Form( {
                name: '',
                email: '',
                roles: [],
                description: '',
                posittion: 1,
                // level_id: ''
            }),
            roles: [],
            types: [],
            levels: [],
        }
    },

    validations: {
        manager: {
            name: {
                required,
                maxLength: maxLength(50)
            },
            email: {
                required,
                email,
                maxLength: maxLength(255)
            },
            roles: {
                required
            },
            posittion: {
                required
            },
            description: {
                maxLength: maxLength(500)
            },
        },

    },

    created () {
        this.posittion = window.user.posittion;
        this.loadType();
        this.loadLevel();
        this.infoAdmin();
        this.loadRoles();

    },
    computed : {

    },
    methods: {
        loadRoles () {
            axios.get("/api/role/list").then(({ data }) => (this.roles = data.data));
        },
        loadType() {
            axios.get("/api/setting/type").then((response) => {
                this.types = response.data.data;
            });
        },
        loadLevel() {
            axios.get("/api/setting/level").then((response) => {
                this.levels = response.data.data;
            });
        },
        createAdmin() {
            // this.$v.manager.$touch();
            // if (!this.$v.manager.$invalid) {

                this.$Progress.start();
                this.manager.post('/api/manager')
                .then( (data) => {
                    if(data.data.status) {
                        this.$router.push({path: '/admin/manager'});
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('admin.info.messages._create_success')
                        });
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('admin.info.messages._create_failed')
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
            //}
        },
        infoAdmin () {
            if (this.isEdit) {
                axios.get("/api/manager/"+this.$route.params.id)
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
            this.manager.id = data.id;
            this.manager.name = data.name;
            this.manager.email = data.email;
            this.manager.description = data.description;
            this.manager.posittion = data.posittion;
            if (data.roles.length > 0) {
                data.roles.forEach(item => {
                    this.manager.roles.push(item.name);
                });
            }
        },
        updateAdmin () {

            this.$Progress.start();
            this.manager.put('/api/manager/'+this.manager.id, this.manager)
            .then( (data) => {
                if(data.data.status) {
                    this.$router.push({path: '/admin/manager'});
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.info.form.messages._edit_success')
                    });
                    this.$Progress.finish();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.info.form.messages._edit_failed')
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
        removeAdmin (id) {
            Swal.fire({
                title: this.$t('admin.others._remove_modal_title'),
                text: this.$t('admin.others._remove_modal_description'),
                showCancelButton: true,
                cancelButtonText: this.$t('admin.others._remove_modal_no'),
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: this.$t('admin.others._remove_modal_yes')
            }).then((result) => {
                // Send request to the server
                if (result.value) {

                    axios.delete('/api/manager/'+id).then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('admin.others._remove_modal_deleted')
                        });

                        // Fire.$emit('AfterCreate');
                        this.$router.push({path: '/admin/manager'});
                    }).catch((data) => {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('common.messages._system_err')
                        });
                    });
                }
            })
        },
    }

}
</script>

<style lang="scss" scoped>

</style>
