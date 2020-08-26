<template>
    <section class="content" v-if="$gate.isAdmin()">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('notification.notifications') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <router-link
                    :class="'btn btn-primary pl-5 pr-5'"
                    :to="{ path: '/admin/notification/edit'}"
                >{{ $t('notification.singup')}}
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
                                                    <label>{{ $t('notification.target_person')}}</label>
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
                                                    <label>{{ $t('notification.keyword')}}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        v-model="form.keyword"
                                                        :placeholder="$t('notification.keyword_placeholder')"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.release_date')}}</label>
                                                    <date-range-picker
                                                        ref="picker"
                                                        style="width: 100%"
                                                        v-model="form.release_date"
                                                        :auto-apply="true"
                                                        :locale-data="{ format: 'DD-MM-YYYY HH:mm:ss' ,  separator: ' + ',}"
                                                    >
                                                        <template v-slot:input="picker" style="min-width: 350px;">
                                                            {{ picker.startDate }} - {{ picker.endDate }}
                                                        </template>
                                                    </date-range-picker>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ $t('notification.status')}}</label>
                                                    <select class="form-control" id="targetPerson"
                                                            v-model="form.status">
                                                        <option value="0">{{ $t('notification.publish')}}</option>
                                                        <option value="1">{{ $t('notification.unpublish')}}</option>
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
                                                >{{ $t('notification.clear_condition')}}
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary pl-4 pr-4"
                                                    @click="searchData()"
                                                >{{ $t('notification.search_condition')}}
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
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('notification.title')}}</th>
                                    <th scope="col">{{ $t('notification.target_person')}}</th>
                                    <th scope="col">{{ $t('notification.total_number_diliveries')}}</th>
                                    <th scope="col">{{ $t('notification.exist_number')}}</th>
                                    <th scope="col">{{ $t('notification.number_people_confirm')}}</th>
                                    <th scope="col">{{ $t('notification.release_date')}}</th>
                                    <th scope="col">{{ $t('notification.status')}}</th>
                                    <th scope="col">{{ $t('notification.operating')}}</th>
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
                                    <td>{{ entity.users_count }}</td>
                                    <td>{{ entity.users_read }}</td>
                                    <td>
                                        <label v-if="entity.confirm === 0">{{ entity.users_count}}</label>
                                        <label v-else>{{ entity.users_confirm }}</label>
                                    </td>
                                    <td>{{ $moment(entity.schedule_date).format('YYYY-MM-DD hh:mm:ss') }}</td>
                                    <td>
                                        <label class="text-secondary" v-if="entity.draft">{{ $t('notification.unpublish')}}</label>
                                        <label class="text-warning" v-else>{{ $t('notification.publish')}}</label>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <i
                                                class="fa fa-ellipsis-v fa-fw"
                                                id="operatingAction"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            ></i>
                                            <div
                                                class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="operatingAction"
                                            >
<!--                                                <button-->
<!--                                                    class="dropdown-item text-primary"-->
<!--                                                    @click="publishAnnouncement()"-->
<!--                                                >{{ $t('notification.publish_announcement')}}-->
<!--                                                </button>-->
                                                <router-link
                                                    :class="'dropdown-item text-primary'"
                                                    :to="{ name: 'edit_notification', params: { id: entity.id }}"
                                                >{{ $t('notification.edit')}}
                                                </router-link>
                                                <button
                                                    class="dropdown-item text-danger"
                                                    @click="deleteNotification()"
                                                >{{ $t('notification.delete')}}
                                                </button>
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
            deleteNotification() {
                Swal.fire({
                    title: this.$t("app").delete_head,
                    text: this.$t("app").delete_question,
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: this.$t("app").delete_yes,
                    cancelButtonText: this.$t("app").delete_cancel,
                }).then((result) => {
                    if (result.value) {
                    }
                });
            },
            publishAnnouncement() {
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
                            title: this.$t("app").notification.some_error,
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
            console.log("Notification Component mounted.");
        },
        created() {
            this.$Progress.start();
            console.log("created");
            this.loadNotification();
            this.$Progress.finish();
        },
    };
</script>
