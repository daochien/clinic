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
                                                <select class="form-control" id="groups" v-model="form.group_ids">
                                                    <option value="" selected>{{ $t('app.user.place_holder.group') }}</option>
                                                    <option v-for="group in groups" :key="group.id" :value="group.id" >{{ group.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.clinic_name')}}</label>
                                                <select class="form-control" id="clinics" v-model="form.clinic_ids">
                                                    <option value="" selected>{{ $t('app.user.place_holder.clinic') }}</option>
                                                    <option v-for="clinic in clinics" :key="clinic.id" :value="clinic.id">{{ clinic.name }}</option>
                                                </select>
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
                                                    <option v-for="type in types" :key="type.id" :value="type.id" >{{ type.name }}</option>
                                                </select>
                                                <has-error :form="form" field="type_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('app.user.level')}}</label>
                                                <select class="form-control" id="levels" v-model="form.level_id">
                                                    <option value="" selected>{{ $t('app.user.place_holder.level') }}</option>
                                                    <option v-for="level in levels" :key="level.id" :value="level.id">{{ level.name }}</option>
                                                </select>
                                            </div>
                                        </div>
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
    export default {
        data() {
            return {
                clinics: [],
                groups: [],
                types: [],
                levels: [],
                form: new Form({
                    name: '',
                    email: '',
                    clinic_ids: [],
                    group_ids: [],
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
                        // this.$router.push("/admin/users")
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
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
        },
        created() {
            this.$Progress.start();
            this.loadGroup();
            this.loadClinic();
            this.loadType();
            this.loadLevel();
            this.$Progress.finish();
        }
    }
</script>
