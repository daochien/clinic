<template>
    <section class="content" v-if="$gate.canPermission('clinic.add.users')">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('clinic.clinic_users._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button type="button" class="btn btn-primary pl-5 pr-5" @click="updateUsers()">{{ $t('clinic.clinic_users.others._btn_update')}}
                </button>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="card">
                                <div class="card-body">
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
            <div class="row mt-5">
                <div class="col-10 offset-1 text-lg-right">{{ $t('clinic.clinic_users.data_table._cur_staff_count') }} : {{clinic.users_count}}</div>
                <div class="col-10 offset-1">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <!--<input type="checkbox" @change="selectAll" v-model="allSelected">-->
                                    </th>
                                    <th scope="col">{{ $t('staff.attr._username')}}</th>
                                    <th scope="col">{{ $t('staff.attr._mail_address')}}</th>
                                    <th scope="col">{{ $t('staff.attr._position')}}</th>
                                    <th scope="col">{{ $t('staff.list.data_table._registered_at')}}</th>
                                    <th scope="col">{{ $t('staff.list.data_table._last_login_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>
                                        <input :disabled="belongToClinic(user.id)" type="checkbox" @click="select" :checked="isChecked(user.id)" :value="user.id" @change="changeChecked">
                                    </td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <template v-if="user.groups.length !== 0">
                                             <span class="badge badge-info ml-1" v-for="target in user.groups" :key="target.id">
                                                {{ target.name}}
                                             </span>
                                        </template>
                                        <div v-else> - </div>
                                    </td>
                                    <td>{{user.created_at|myDate}}</td>
                                    <td>{{user.last_login|myDate}}</td>
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
        </div>
    </section>
    <div v-else>
        <not-found></not-found>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                paginator: {},
                keyword: "",
                selected: [],
                allSelected: false,
                userIds: [],
                clinic: {}
            };
        },
        watch: {
            userIds: function (val) {
                if(_.size(this.users) == _.size(this.userIds)) {
                    this.allSelected = true;
                } else {
                    this.allSelected = false;
                }
            }
        },
        methods: {
            belongToClinic(id) {
               return  _.findIndex(this.clinic.users, ['id', id]) >= 0;
            },
            getResults(page = 1) {
                this.$Progress.start();
                axios
                    .get("/api/user/search?keyword= " + this.keyword + "&page=" + page)
                    .then((response) => {
                        this.users = response.data.data;
                        this.paginator = response.data.meta
                    });

                this.$Progress.finish();
            },
            updateUsers() {
                this.$Progress.start();
                axios.post("/api/clinic/" + this.$route.params.id + "/user", {
                    user_ids: this.userIds,
                })
                .then((data) => {
                    if (data.data.status) {
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                        this.$router.push('/admin/clinic')
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('clinic.clinic_users.messages._update_failed')
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('common.messages._system_err')
                    });
                })
            },
            selectAll(event) {
                let self = this;
                if (event.target.checked) {
                    _.forEach(self.users, function (user) {
                        self.userIds = _.union(self.userIds, [user.id]);
                    })
                } else {
                    this.userIds = [];
                    this.isChecked()
                }
            },
            select() {
                this.allSelected = false;
            },
            isChecked(userId) {
                return _.indexOf(this.userIds, userId) > -1 ? true : false;
            },
            changeChecked(event) {
                if(event.target.checked) {
                    this.userIds = _.union(this.userIds, [parseInt(event.target.value)]);
                } else {
                    this.userIds = _.without(this.userIds, parseInt(event.target.value));
                }
            },
            resetKeyword() {
                this.keyword = ''
            },
            getClinicInfo(){
                axios.get("/api/clinic/" + this.$route.params.id)
                    .then(({ data }) => {
                        this.clinic = data.data;
                    });
            }
        },
        created() {
            this.$Progress.start();;
            this.getClinicInfo();
            this.getResults();
            this.$Progress.finish();
        }
    };
</script>
