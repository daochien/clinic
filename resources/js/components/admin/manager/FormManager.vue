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
                            <div class="invalid-feedback" v-if="!$v.manager.name.required">{{ $t('validation.required') }}</div>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="feInputTitle">{{ $t('manager.form_create.input_email') }} <span style="color:#c4183c;">*</span></label>
                            <input
                            
                            :class="['form-control', {'is-invalid': $v.manager.email.$error}]" 
                            type="text" v-model.trim="$v.manager.email.$model">
                            <div class="invalid-feedback" v-if="!$v.manager.email.required">{{ $t('validation.required') }}</div>
                            <div class="invalid-feedback" v-if="!$v.manager.email.email">{{ $t('validation.email') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $t('manager.form_create.role') }} <span style="color:#c4183c;">*</span>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-3 mr-4 float-left" v-for="(role, index) in roles" :key="index">
                                <input
                                type="checkbox"
                                :class="['custom-control-input', {'is-invalid': $v.manager.role_ids.$error}]" 
                                class="custom-control-input"
                                v-model="$v.manager.role_ids.$model"
                                :id="'formsCheckboxChecked_'+index"
                                :value="index">
                                <label class="custom-control-label" :for="'formsCheckboxChecked_'+index">{{ role }}</label>
                            </div>                                
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="feInputTitle">{{ $t('manager.form_create.note') }}</label>
                            <textarea
                            :class="['form-control', {'is-invalid': $v.manager.note.$error}]"  
                            v-model="$v.manager.note.$model" 
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
            manager: {
                name: '',
                email: '',
                role_ids: [],
                note: ''
            },
            roles: [],            
        }
    },

    validations: {
        manager: {
            name: {
                required,
                maxLength: maxLength(191)
            },
            email: {
                required,
                email,
                maxLength: maxLength(191)
            },
            role_ids: {
                required
            },
            note: {
                maxLength: maxLength(500)
            },           
        },
        
    },

    created () {
        this.infoAdmin();
        this.loadRoles();
    },

    methods: {
        loadRoles () {
            axios.get("/api/role/list").then(({ data }) => (this.roles = data.data));
        },
        createAdmin() {
            this.$v.manager.$touch();            
            if (!this.$v.manager.$invalid) {

                this.$Progress.start();
                axios.post('/api/manager', this.manager)
                .then( (data) => {
                    if(data.data.success) {
                        this.$router.push({path: '/admin/managers'});                        
                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();                
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
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
            this.manager.note = data.note;
            if (data.get_roles.length > 0) {
                data.get_roles.forEach(item => {
                    this.manager.role_ids.push(item.id);
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
                        // this.$router.push({path: '/admin/managers'});                        
                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();                
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            }
        },
        removeAdmin () {
            this.$Progress.start();
                axios.delete('/api/manager/'+this.manager.id)
                .then( (data) => {
                    if(data.data.success) {
                        this.$router.push({path: '/admin/managers'});                        
                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();                
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
        }
    }

}
</script>

<style lang="scss" scoped>

</style>
