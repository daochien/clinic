<template>
    <div class="container-fluid">
        <section class="content">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                    <h3 class="page-title">{{ $t('admin.my_account._page_title') }}</h3>
                </div>
            </div>
            <div class="col-12 col-sm-10 offset-sm-1">
                <div class="card card-small mb-3">
                    <div class="border-bottom clearfix d-flex mt-3">
                        <ul class="nav nav-tabs border-0 mt-auto mx-4 pt-2">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#settings" data-toggle="tab">{{ $t('admin.my_account.basic_info._title') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#change-password" data-toggle="tab">{{ $t('admin.my_account.change_password._title') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                    <div class="row">
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="username">{{ $t('admin.attr._username') }} <span style="color:#c4183c;">*</span></label>
                                            <input
                                                id="username"
                                                :placeholder="$t('admin.info.form._username_pl')"
                                                :class="['form-control', {'is-invalid': manager.errors.has('name')}]"
                                                type="text"
                                                v-model.trim="manager.name">
                                            <has-error :form="manager" field="name"></has-error>
                                        </div>
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="email">{{ $t('admin.attr._mail_address') }} <span style="color:#c4183c;">*</span></label>
                                            <input
                                                id="email"
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
                                                <div v-if="manager" class="custom-control custom-checkbox mb-3 mr-4 float-left" v-for="(role, index) in roles" :key="index">
                                                    <input
                                                        :checked="userHasRole(role)"
                                                        type="checkbox"
                                                        :class="['custom-control-input', {'is-invalid': manager.errors.has('roles')}]"
                                                        class="custom-control-input"
                                                        v-model="manager.roles"
                                                        :id="'formsCheckboxChecked_'+index"
                                                        :value="role">
                                                    <label class="custom-control-label" :for="'formsCheckboxChecked_'+index">{{ role.name }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="description">{{ $t('admin.attr._memo') }}</label>
                                            <textarea
                                                id="description"
                                                :placeholder="$t('admin.info.form._mail_address_pl')"
                                                :class="['form-control', {'is-invalid': manager.errors.has('description')}]"
                                                v-model="manager.description"
                                                class="form-control"
                                                cols="30" rows="10"></textarea>
                                            <has-error :form="manager" field="description"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button @click.prevent="updateInfo" type="submit" class="btn btn-primary float-right">{{ $t('admin.my_account._btn_update') }}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane" id="change-password">
                                <form class="form-horizontal">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="current_password" class="control-label">
                                                {{ $t('admin.my_account.change_password._current_pass') }}<span style="color:#c4183c;">*</span>
                                            </label>
                                                <input type="password"
                                                       v-model="manager.current_password"
                                                       class="form-control"
                                                       id="current_password"
                                                       :placeholder="$t('admin.my_account.change_password._current_pass_place_holder')"
                                                       :class="{ 'is-invalid': manager.errors.has('current_password') }"
                                                >
                                                <has-error :form="manager" field="current_password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="new_password" class="control-label">
                                                {{ $t('admin.my_account.change_password._new_pass') }}
                                                <span style="color:#c4183c;">*</span>
                                            </label>
                                            <input type="password"
                                                   v-model="manager.new_password"
                                                   class="form-control"
                                                   id="new_password"
                                                   :placeholder="$t('admin.my_account.change_password._new_pass_place_holder')"
                                                   :class="{ 'is-invalid': manager.errors.has('new_password') }"
                                            >
                                            <has-error :form="manager" field="new_password"></has-error>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="confirm_password" class="control-label">
                                                {{ $t('admin.my_account.change_password._verify_pass') }}<span style="color:#c4183c;">*</span>
                                            </label>
                                            <input type="password"
                                                   v-model="manager.confirm_password"
                                                   class="form-control"
                                                   id="confirm_password"
                                                   :placeholder="$t('admin.my_account.change_password._verify_pass_place_holder')"
                                                   :class="{ 'is-invalid': manager.errors.has('confirm_password') }"
                                            >
                                            <has-error :form="manager" field="confirm_password"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button @click.prevent="updatePassword" type="submit" class="btn btn-primary float-right">{{ $t('admin.my_account._btn_update') }}</button>
                                    </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            <!-- end tabs -->
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                 manager: new Form({
                     id:'',
                     name : '',
                     email: '',
                     password: '',
                     description: '',
                     roles: [],
                     posittion: '',
                }),
                isEdit: true,
                roles: [],
            }
        },
        mounted() {
        },
        methods:{

            updateInfo(){
                this.$Progress.start();
                if(this.manager.password === ''){
                    this.manager.password = undefined;
                }
                this.manager.put('/api/profile')
                .then((data)=>{
                    this.$Progress.finish();
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.info.messages._edit_success')
                    });
                })
                .catch((data) => {
                    this.$Progress.fail();

                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.info.messages._edit_failed')
                    });
                });
            },
            updatePassword(){
                this.$Progress.start();
                this.manager.post('/api/change-my-password')
                .then((data)=>{
                    //  Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    this.manager.current_password = '';
                    this.manager.new_password = '';
                    this.manager.confirm_password = '';

                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.my_account.change_password._password_changed')
                    });
                })
                .catch(() => {
                    this.$Progress.fail();

                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.my_account.change_password._password_update_failed')
                    });
                });
            },
            loadRoles () {
                axios.get("/api/manager/roles?re-format=true").then(({ data }) => (this.roles = data.data));
            },
            userHasRole(role) {
                for (var i=0; i < this.manager.roles.length; i++) {
                    if (this.manager.roles[i].name === role) {
                        return true;
                    }
                }
                return false;
            }
        },

        created() {
            this.$Progress.start();
            this.posittion = window.user.posittion;
            axios.get("/api/profile")
            .then(({ data }) => (this.manager.fill(data.data)));

            this.loadRoles();
            this.$Progress.finish();
        }
    }
</script>
