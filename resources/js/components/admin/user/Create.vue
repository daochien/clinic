<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('app.user.title.create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button type="button" class="btn btn-primary pl-5 pr-5" @click="createUser()">{{ $t('app.btn.create')}}</button>
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
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>
                                                    {{ $t('app.user.name')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input v-model="form.name" type="text" name="name"
                                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                                       :placeholder="$t('app.user.place_holder.name')">
                                                <has-error :form="form" field="name"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>
                                                    {{ $t('app.user.email')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input v-model="form.email" type="email" name="email"
                                                       required autocomplete="email"
                                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                                                       :placeholder="$t('app.user.place_holder.email')">
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.group')}}</label>
                                                <span class="text-danger">*</span>
                                                <multiselect
                                                    v-model="form.groups"
                                                    :class="{ 'is-invalid': form.errors.has('groups') }"
                                                    :options="groups"
                                                    :multiple="true"
                                                    label="name"
                                                    track-by="id"
                                                    :placeholder="$t('app.user.place_holder.group')"
                                                ></multiselect>
                                                <has-error :form="form" field="groups"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.clinic_name')}}</label>
                                                <span class="text-danger">*</span>
                                                <multiselect
                                                    :class="{ 'is-invalid': form.errors.has('clinics') }"
                                                    v-model="form.clinics"
                                                    :options="clinics"
                                                    :multiple="true"
                                                    label="name"
                                                    track-by="id"
                                                    :placeholder="$t('app.user.place_holder.clinic')"
                                                ></multiselect>
                                                <has-error :form="form" field="clinics"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.type')}}</label>
                                                <span class="text-danger">*</span>
                                                <select class="form-control" id="types" v-model="form.type_id" :class="{ 'is-invalid': form.errors.has('type_id') }">
                                                    <option value="" selected>{{ $t('app.user.place_holder.type') }}</option>
                                                    <option v-for="type in types" :key="'type_' +type.id" :value="type.id" >{{ type.name }}</option>
                                                </select>
                                                <has-error :form="form" field="type_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.level')}}</label>
                                                <select class="form-control" id="levels" v-model="form.level_id">
                                                    <option value="" selected>{{ $t('app.user.place_holder.level') }}</option>
                                                    <option v-for="level in levels" :key="'level_' + level.id" :value="level.id">{{ level.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ml-1">
                                        <div class="form-group">
                                            <label>{{ $t('app.user.role_label')}}</label>
                                        </div>
                                        <template v-for="role in roles">
                                            <div class="col-1">
                                                <div class="custom-control custom-radio mb-1 col-1">
                                                    <input type="radio" class="custom-control-input"
                                                           name="role" v-bind:id="role.id + '-user'"
                                                           v-bind:value="{id: role.id, name: role.name}"
                                                           v-model="form.role"
                                                           :checked="role.id === form.role.id">
                                                    <label class="custom-control-label" :for="role.id + '-user'">{{role.name}}</label>
                                                </div>
                                            </div>
                                        </template>
                                     </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ $t('app.label.description')}}</label>
                                                <textarea rows="12" v-model="form.description" name="description" :placeholder="$t('app.user.place_holder.description')"
                                                          class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                                                </textarea>
                                                <has-error :form="form" field="description"></has-error>
                                            </div>
                                        </div>
                                    </div>
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
    export default {
        components: {
            Multiselect,
        },
        data() {
            return {
                clinics: [],
                groups: [],
                types: [],
                levels: [],
                roles: {},
                form: new Form({
                    name: '',
                    email: '',
                    role: [],
                    clinics: [],
                    groups: [],
                    level_id: '',
                    type_id: '',
                    description: '',
                }),
            }
        },
        methods: {
            createUser() {
                this.form.post('/api/user')
                    .then((response) => {
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                        this.$router.push("/admin/user")
                        this.$Progress.finish();
                    })
                    .catch(() => {
                    })
            },
            loadGroup() {
                axios.get("/api/group/all").then((response) => {
                    this.groups = response.data.data;
                });
            },
            loadClinic() {
                axios.get("/api/clinic/all").then((response) => {
                    this.clinics = response.data.data;
                });
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
            loadUserRole() {
                axios.get("/api/setting/user-role").then((response) => {
                    this.roles = response.data.data;
                });
            },
        },
        created() {
            this.$Progress.start();
            this.loadGroup();
            this.loadClinic();
            this.loadType();
            this.loadLevel();
            this.loadUserRole();
            this.$Progress.finish();
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
