<template>
    <section class="content" v-if="$gate.canPermission('notification.index')">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('notification.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <router-link
                    :class="'btn btn-primary pl-5 pr-5'"
                    :to="{ name: 'create_notification'}"
                >{{ $t('notification.list.others._btn_create')}}
                </router-link>
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
                                    <form>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.attr._target_users')}}</label>
                                                    <select class="form-control" id="targetPerson" v-model="form.group">
                                                        <option
                                                            v-for="(entity) in groups"
                                                            :key="entity.id"
                                                            :value="entity.name"
                                                        >{{ entity.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
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
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.list.search_box._public_date')}}</label>
                                                    <date-range-picker
                                                        ref="picker"
                                                        style="width: 100%"
                                                        v-model="form.release_date"
                                                        :auto-apply="true"
                                                        :locale-data="localeData"
                                                    >
                                                        <template v-slot:input="picker" style="min-width: 350px;">
                                                            <div v-if="picker.startDate && picker.endDate">
                                                                {{ $moment(picker.startDate).format('YYYY-MM-DD HH:mm:ss') }} - {{ $moment(picker.endDate).format('YYYY-MM-DD HH:mm:ss') }}
                                                            </div>
                                                        </template>
                                                    </date-range-picker>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.attr._status')}}</label>
                                                    <select class="form-control" id="targetPerson"
                                                            v-model="form.status">
                                                        <option value="0">{{ $t('notification.attr.status._public')}}</option>
                                                        <option value="1">{{ $t('notification.attr.status._private')}}</option>
                                                    </select>
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
                <div class="col-10 offset-1">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ $t('common.list.data_table._id') }}</th>
                                    <th scope="col">{{ $t('notification.attr._title')}}</th>
                                    <th scope="col">{{ $t('notification.attr._target_users')}}</th>
                                    <th scope="col">{{ $t('notification.list.data_table._sent_count')}}</th>
                                    <th scope="col">{{ $t('notification.list.data_table._read_count')}}</th>
                                    <th scope="col">{{ $t('notification.list.data_table._confirmed_count')}}</th>
                                    <th scope="col">{{ $t('notification.attr._public_at')}}</th>
                                    <th scope="col">{{ $t('notification.attr._status')}}</th>
                                    <th scope="col" style="width:100px">{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in notifications.data" :key="entity.id">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <router-link
                                            :to="{ name: 'details_notification', params: { id: entity.id }}"
                                        >{{ entity.title }}
                                        </router-link>
                                    </td>
                                    <td>
                                        <div v-if="entity.groups.length !== 0">
                                            <span
                                                class="badge badge-info ml-1"
                                                v-for="target in entity.groups"
                                                :key="'gr_' + target.group.id"
                                            >{{ target.group.name}}</span>
                                        </div>
                                        <div v-else>-</div>
                                    </td>
                                    <td>{{ entity.notification_users_count }}</td>
                                    <td>{{ entity.users_read }}</td>
                                    <td>
                                        <label v-if="entity.confirm === 1">{{ entity.users_confirmed_count }}</label>
                                        <label v-else> -- </label>
                                    </td>
                                    <td>
                                        <span> {{entity.schedule_date|myDate}} </span>
                                    </td>
                                    <td>
                                        <label class="text-secondary" v-if="entity.draft">{{ $t('notification.attr.status._private')}}</label>
                                        <label class="text-warning" v-else>{{ $t('notification.attr.status._public')}}</label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <i
                                                class="fa fa-ellipsis-v"
                                                id="operatingAction"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            ></i>
                                            <div
                                                class="dropdown-menu dropdown-menu-left"
                                                aria-labelledby="operatingAction"
                                            >
                                                <a
                                                    style="cursor: pointer"
                                                    v-if="new Date(entity.schedule_date) >= new Date() && !entity.draft"
                                                    class="dropdown-item text-primary"
                                                    @click="publishAnnouncement(entity)"
                                                >{{ $t('notification.list.data_table.actions._act_public')}}
                                                </a>
                                                <router-link
                                                    :class="'dropdown-item text-primary'"
                                                    style="cursor: pointer"
                                                    :to="{ name: 'details_notification', params: { id: entity.id }}"
                                                >{{ $t('notification.list.data_table.actions._act_show_list_user')}}
                                                </router-link>
                                                <router-link
                                                    :class="'dropdown-item text-primary'"
                                                    style="cursor: pointer"
                                                    :to="{ name: 'edit_notification', params: { id: entity.id }}"
                                                >{{ $t('notification.list.data_table.actions._act_edit')}}
                                                </router-link>
                                                <a
                                                    v-if="entity.draft"
                                                    class="dropdown-item text-danger"
                                                    @click="deleteNotification(entity)"
                                                    style="cursor: pointer"
                                                >{{ $t('notification.list.data_table.actions._act_remove')}}
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
                            <pagination :data="notifications" @pagination-change-page="getResults"></pagination>
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
    import DateRangePicker from 'vue2-daterange-picker';
    import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';

    export default {
        components: { DateRangePicker },
        data() {
            return {
                editmode: false,
                notifications: {},
                groups: {},
                form: new Form({
                    group: "",
                    keyword: "",
                    release_date: {
                        startDate: null,
                        endDate: null
                    },
                    status: 0,
                }),
                localeData: {
                    direction: 'ltr',
                    format: 'mm/dd/yyyy',
                    separator: ' - ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    weekLabel: 'W',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    firstDay: 0
                }
            };
        },
        methods: {
            resetForm() {
                this.isValidate = false;
                this.form = new Form({
                    group: "",
                    keyword: "",
                    release_date: null,
                    status: 0,
                });
            },
            getResults(page = 1) {
                this.$Progress.start();
                console.log("get Results");
                axios
                    .get("/api/notification?page=" + page)
                    .then(({data}) => (this.notifications = data));

                this.$Progress.finish();
            },
            loadNotification() {
                this.$Progress.start();
                if (this.$gate.isAdmin()) {
                    axios
                        .get("/api/notification")
                        .then(({data}) => (this.notifications = data));
                    axios
                        .get("/api/group/all")
                        .then(({data}) => (this.groups = data.data));
                }
                this.$Progress.finish();
            },
            editNotification() {
                this.$router.push({
                    path: "/admin/notification/edit",
                });
            },
            deleteNotification(entity) {
                Swal.fire({
                    title: this.$t("notification.others._remove_modal_title"),
                    text: this.$t("notification.others._remove_modal_description"),
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: this.$t("notification.others._remove_modal_yes"),
                    cancelButtonText: this.$t("notification.others._remove_modal_no"),
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`/api/notification/delete/${entity.id}`)
                            .then((data) => {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t("notification.list.messages._remove_success"),
                                });
                                return this.loadNotification();
                            })
                            .catch(() => {
                                Toast.fire({
                                    icon: "error",
                                    title: this.$t("notification.list.messages._remove_failed"),
                                });
                            });
                    }
                });
            },
            publishAnnouncement(notification) {
                notification.draft = 0;
                notification.notification_id = notification.id;
                let groups = notification.groups;
                notification.groups = [];
                axios.post("/api/notification/store", notification)
                    .then((data) => {
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                        this.$Progress.finish();
                        this.$router.push({path: "/admin/notification"});
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t("notification.list.messages._stt_update_failed"),
                        });
                    }).finally(() => {
                        notification.groups = groups;
                });
            },
            searchData() {
                this.$Progress.start();
                var app = this;
                axios
                    .post("/api/notification/search", this.form)
                    .then((data) => {
                        app.notifications = data.data;
                        Toast.fire({
                            icon: "success",
                            title: data.data.message,
                        });
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t("common.messages._system_err"),
                        });
                    });
                this.$Progress.finish();
                this.$forceUpdate();
            },
            dateFormatPicker(classes, date) {
                console.log(this.$moment)
                return this.$moment(date).format('YYYY-MM-DD HH:mm:ss');
            }
        },
        mounted() {
        },
        created() {
            this.$Progress.start();
            console.log("created");
            this.loadNotification();
            this.$Progress.finish();
        },
    };
</script>
