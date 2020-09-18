<template>
    <section class="content">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('staff.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0" v-if="$gate.canPermission('user.store')">
                <router-link type="button" class="btn btn-primary pl-5 pr-5" to="/admin/user/create">{{ $t('staff.list.others._btn_create')}}
                </router-link>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid" >
            <div class="row mb-5" v-if="$gate.canPermission('user.index')">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('staff.attr._position')}}</label>
                                                <select class="form-control" id="types"  v-model="typeSelected">
                                                    <option value="" selected>{{ $t('staff.list.search_box._position_df') }}</option>
                                                    <option v-for="type_ in types" :key="'type_' + type_.id" :value="type_.id" >{{ type_.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('staff.attr._clinic')}}</label>
                                                <select class="form-control" id="clinics" v-model="clinicSelected">
                                                    <option value="" selected>{{ $t('staff.list.search_box._clinic_df') }}</option>
                                                    <option v-for="clinic in clinics" :key="'clinic_' + clinic.id" :value="clinic.id">{{ clinic.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ $t('common.list.search_box._keyword')}}</label>
                                                <input
                                                    v-model="keyword"
                                                    type="text"
                                                    class="form-control"
                                                    :placeholder="$t('common.list.search_box._keyword_pl')"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6 text-right">
                                            <button
                                                type="reset"
                                                class="btn btn-outline-secondary pl-4 pr-4" @click="resetKeyword()"
                                            >{{ $t('common.list.search_box._btn_reset')}}
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-outline-primary pl-4 pr-4" @click="getResults()">
                                                {{ $t('common.list.search_box._btn_search')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" v-if="$gate.canPermission('user.index')">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ $t('common.list.data_table._id') }}</th>
                                    <th>{{ $t('staff.attr._username') }}</th>
                                    <th>{{ $t('staff.attr._mail_address') }}</th>
                                    <th>{{ $t('staff.attr._position') }}</th>
                                    <th>{{ $t('staff.attr._clinic') }}</th>
                                    <th>{{ $t('staff.list.data_table._last_login_at') }}</th>
                                    <th>{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in users" :key="'user_' + user.id">
                                    <td>{{index + 1}}</td>
                                    <td class="text-capitalize">{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>
                                        <template v-if="user.type.length !== 0">
                                             <span class="badge badge-info ml-1" v-for="type in user.type" :key="'tp_' + type.id">
                                                {{ type.name}}
                                            </span>
                                        </template>
                                        <div v-else> -</div>
                                    </td>
                                    <td>
                                        <div v-if="user.clinics.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="clinic in user.clinics" :key="'sc_' + clinic.id">
                                                {{ clinic.name}}
                                            </span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>{{user.last_login|myDate}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <i
                                                class="fa fa-ellipsis-v"
                                                id="operatingAction"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            ></i>
                                                <div class="dropdown-menu" aria-labelledby="operatingAction">
                                                    <router-link class="dropdown-item text-primary"
                                                                 :to="{ name: 'user.edit', params: { id: user.id }} ">
                                                        {{ $t('staff.list.data_table.actions._act_edit')}}
                                                    </router-link>
                                                    <a class="dropdown-item text-danger" href="#" @click="deleteUser(user.id)">
                                                        {{$t('staff.list.data_table.actions._act_remove')}}
                                                    </a>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="paginator" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div v-if="!$gate.canPermission('user.index')">
                <not-found></not-found>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                clinics: [],
                types: [],
                paginator: {},
                keyword: "",
                clinicSelected: "",
                typeSelected: "",
            }
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                axios
                .get("/api/user/search?keyword= " + this.keyword + "&page=" + page + "&clinic_id=" + this.clinicSelected + "&type_id=" + this.typeSelected)
                    .then((response) => {
                    this.users = response.data.data;
                    this.paginator = response.data.meta
                });
                this.$Progress.finish();
            },
            deleteUser(id) {
                Swal.fire({
                    title: this.$t('staff').others._remove_modal_title,
                    text: this.$t('staff').others._remove_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('staff').others._remove_modal_yes,
                    cancelButtonText: this.$t('staff').others._remove_modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.delete('/api/user/' + id).then(() => {
                            Toast.fire({
                                icon: "success",
                                title: this.$t('staff').list._remove_success,
                            });
                            // Fire.$emit('AfterCreate');
                            this.loadUsers();
                        }).catch((data) => {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('staff').list._remove_failed,
                            });
                        });
                    }
                })
            },
            loadUsers() {
                axios.get("/api/user").then((response) => {
                    this.users = response.data.data;
                    this.paginator = response.data.meta
                });
            },
            loadType() {
                axios.get("/api/setting/type").then((response) => {
                    this.types = response.data.data;
                });
            },
            loadClinic() {
                axios.get("/api/clinic/all").then((response) => {
                    this.clinics = response.data.data;
                });
            },
        },
        resetKeyword() {
            this.keyword = '';
        },
        created() {
            this.$Progress.start();
            this.loadUsers();
            this.loadType();
            this.loadClinic();
            this.$Progress.finish();
        }
    }
</script>
