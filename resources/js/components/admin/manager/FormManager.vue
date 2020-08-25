<template>
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $t('manager.form_create.title') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6">
                            <label for="feInputTitle">{{ $t('manager.form_create.input_name') }} <span style="color:#c4183c;">*</span></label>
                            <input
                            :class="['form-control', {'is-invalid': $v.manager.name.$error}]"
                            type="text"
                            v-model.trim="$v.manager.name.$model">
                            <div class="invalid-feedback" v-if="!$v.manager.name.required">{{ $t('manager.validator.name_required') }}</div>
                            <div class="invalid-feedback" v-if="!$v.manager.name.maxLength">{{ $t('manager.validator.name_maxLength') }}</div>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="feInputTitle">{{ $t('manager.form_create.input_email') }} <span style="color:#c4183c;">*</span></label>
                            <input
                            :class="['form-control', {'is-invalid': $v.manager.email.$error}]"
                            type="text" v-model.trim="$v.manager.email.$model">
                            <div class="invalid-feedback" v-if="!$v.manager.email.required">{{ $t('manager.validator.email_required') }}</div>
                            <div class="invalid-feedback" v-if="!$v.manager.email.email">{{ $t('manager.validator.email_valid') }}</div>
                            <div class="invalid-feedback" v-if="!$v.manager.name.maxLength">{{ $t('manager.validator.email_maxLength') }}</div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ $t('app.user.type')}}</label>
                                    <span class="text-danger">*</span>
                                    <select :class="['form-control', {'is-invalid': $v.manager.type_id.$error}]" id="types" v-model="$v.manager.type_id.$model" >
                                        <option value="" selected>{{ $t('app.user.place_holder.type') }}</option>
                                        <option v-for="type in types" :key="'type_' +type.id" :value="type.id" >{{ type.name }}</option>
                                    </select>
                                    <div class="invalid-feedback" v-if="!$v.manager.type_id.required">{{ $t('validation.required') }}</div>
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
                        <div class="col-12">
                            {{ $t('manager.form_create.role') }} <span style="color:#c4183c;">*</span>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-3 mr-4 float-left" v-for="(role, index) in roles" :key="index">
                                <input
                                type="checkbox"
                                :class="['custom-control-input', {'is-invalid': $v.manager.roles.$error}]"
                                class="custom-control-input"
                                v-model="$v.manager.roles.$model"
                                :id="'formsCheckboxChecked_'+index"
                                :value="role">
                                <label class="custom-control-label" :for="'formsCheckboxChecked_'+index">{{ role }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="feInputTitle">{{ $t('manager.form_create.note') }}</label>
                            <textarea
                            :class="['form-control', {'is-invalid': $v.manager.description.$error}]"
                            v-model="$v.manager.description.$model"
                            class="form-control"
                            cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <span v-if="isEdit" class="mr-2" style="color:#EB5757; cursor: pointer;" @click="removeAdmin()">{{ $t('manager.form_create.button_remove') }}</span>
                            <button class="mb-2 btn btn-sm btn-primary" v-if="!isEdit" @click="createAdmin()"> {{ $t('manager.form_create.button_create') }}</button>
                            <button class="mb-2 btn btn-sm btn-primary" v-else @click="updateAdmin()"> {{ $t('manager.form_create.button_edit') }}</button>
                        </div>
                    </div>
                </div>
                <confirm-remove v-if="isEdit" :id="manager.id" @remove-success="removeSuccess" />
            </div>
        </div>
    </div>
</template>

<script>

import ConfirmRemove from './ConfirmRemove';
import { required, minLength, between, requiredIf, email, maxLength, numeric, minValue } from 'vuelidate/lib/validators';

export default {
    props: {
        isEdit: Boolean
    },
    components: {
        ConfirmRemove
    },
    data () {
        return {
            manager: {
                name: '',
                email: '',
                roles: [],
                description: '',
                type_id: '',
                // level_id: ''
            },
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
            type_id: {
                required
            },
            description: {
                maxLength: maxLength(500)
            },
        },

    },

    created () {
        this.loadType();
        this.loadLevel();
        this.infoAdmin();
        this.loadRoles();
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
            this.$v.manager.$touch();
            if (!this.$v.manager.$invalid) {

                this.$Progress.start();
                axios.post('/api/manager', this.manager)
                .then( (data) => {
                    if(data.data.success) {
                        this.$router.push({path: '/admin/manager'});
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('manager.form_create.alert_create_success')
                        });
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('manager.form_create.alert_error')
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: this.$t('manager.form_create.alert_error')
                    });
                })
            }

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
            if (data.roles.length > 0) {
                data.roles.forEach(item => {
                    this.manager.roles.push(item.name);
                });
            }
            if (data.type.length > 0) {
                data.type.forEach(item => {
                    this.manager.type_id = item.id;
                });
            }
        },
        updateAdmin () {
            this.$v.manager.$touch();
            if (!this.$v.manager.$invalid) {

                this.$Progress.start();
                axios.put('/api/manager/'+this.manager.id, this.manager)
                .then( (data) => {
                    if(data.data.success) {
                        // this.$router.push({path: '/admin/manager'});
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('manager.form_create.alert_edit_success')
                        });
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('manager.form_create.alert_error')
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('manager.form_create.alert_error')
                    });
                })
            }
        },
        removeAdmin (id) {
            this.idRemove = id;
            $('#removeAdmin').modal('show');
        },
        removeSuccess () {
            $('#removeAdmin').modal('hide');
            this.$router.push({path: '/admin/manager'});
        },
    }

}
</script>

<style lang="scss" scoped>

</style>
