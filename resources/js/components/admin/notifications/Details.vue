<template>
    <section class="content" v-if="$gate.isAdmin() && this.notification_id != undefined">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('notification.noti_users._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0"></div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('staff.attr._clinic')}}</label>
                                                    <select class="form-control" id="clinic" v-model="form.clinic">
                                                        <option
                                                            v-for="(entity) in clinics"
                                                            :key="entity.id"
                                                            :value="entity.name"
                                                        >{{ entity.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.noti_users.attr._status')}}</label>
                                                    <select class="form-control" id="status" v-model="form.status">
                                                        <option value="0">{{
                                                            $t('notification.noti_users.search_box._status_df')}}
                                                        </option>
                                                        <option value="1">{{
                                                            $t('notification.noti_users.attr.status._unread')}}
                                                        </option>
                                                        <option value="2">{{
                                                            $t('notification.noti_users.attr.status._read')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>{{ $t('common.list.search_box._keyword')}}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="form.keyword"
                                                        :placeholder="$t('common.list.search_box._keyword_pl')"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                                <button
                                                    type="reset"
                                                    class="btn btn-outline-secondary pl-4 pr-4"
                                                    @click="resetForm()"
                                                >{{ $t('common.list.search_box._btn_reset')}}
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary pl-4 pr-4"
                                                    @click="searchData()"
                                                >{{ $t('common.list.search_box._btn_search')}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ $t('common.list.data_table._id') }}</th>
                                    <th scope="col">{{ $t('staff.attr._username')}}</th>
                                    <th scope="col">{{ $t('staff.attr._mail_address')}}</th>
                                    <th scope="col">{{ $t('staff.attr._position')}}</th>
                                    <th scope="col">{{ $t('staff.attr._clinic')}}</th>
                                    <th scope="col">{{ $t('notification.noti_users.attr._status')}}</th>
                                    <th scope="col">{{ $t('notification.noti_users.data_table._confirmed_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in members.data" :key="entity.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ entity.user.name }}</td>
                                    <td>{{ entity.user.email }}</td>
                                    <td>
                                        <div v-if="entity.user.group.length !== 0">
                                            <span
                                                class="badge badge-info ml-1"
                                                v-for="group in entity.user.group"
                                                :key="'sc_' + group.id"
                                            >{{ group.name}}</span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>
                                        <div v-if="entity.user.clinic.length !== 0">
                                            <span
                                                class="badge badge-info ml-1"
                                                v-for="clinic in entity.user.clinic"
                                                :key="'sc_' + clinic.id"
                                            >{{ clinic.name}}</span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>
                                        <div v-if="entity.notification.confirm == true">
                                            <span
                                                v-if="entity.user_status.status == 1"
                                                class="text-secondary"
                                            >{{ $t('notification.noti_users.attr.status._unread') }}</span>
                                            <span
                                                v-else-if="entity.user_status.status == 2"
                                                class="text-primary"
                                            >{{ $t('notification.noti_users.attr.status._read') }}</span>
                                            <span v-else>-</span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>
                                        <div v-if="entity.notification.confirm == true">
                                            <span
                                                v-if="entity.user_status.status == 1"
                                                class="text-secondary"
                                            >{{ $t('notification.noti_users.others._unconfirm') }}</span>
                                            <span
                                                v-else-if="entity.user_status.status == 2"
                                                class="text-primary"
                                            >{{ $moment(entity.user_confirm_date).format('YYYY-MM-DD HH:mm:ss') }}</span>
                                            <span v-else>-</span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="members" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                members: {},
                clinics: [],
                notification_id: 0,
                form: new Form({
                    notification_id: 0,
                    clinic: "",
                    keyword: "",
                    status: 0,
                }),
            };
        },
        created() {
            this.$Progress.start();
            this.notification_id = this.$route.params.id;
            this.form.notification_id = this.notification_id;
            this.getResults();
            this.loadClinic();
            this.$Progress.finish();
        },
        methods: {
            resetForm() {
                this.isValidate = false;
                this.form = new Form({
                    notification_id: this.notification_id,
                    clinic: "",
                    keyword: "",
                    status: 0,
                });
            },
            getResults(page = 1) {
                this.$Progress.start();
                axios.get("/api/notification/" + this.notification_id + "/members?page=" + page)
                    .then(({data}) => (this.members = data));
                this.$Progress.finish();
            },
            loadClinic() {
                axios.get("/api/clinic/all").then((response) => {
                    this.clinics = response.data.data;
                });
            },
            searchData() {
                this.$Progress.start();
                var app = this;
                axios
                    .post("/api/notification/detailSearch", this.form)
                    .then((data) => {
                        app.members = data.data;
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t("app").notification.some_error,
                        });
                    });
                this.$Progress.finish();
                this.$forceUpdate();
            },
        }
    };
</script>
