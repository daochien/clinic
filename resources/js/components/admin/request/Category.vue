<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div v-if="category_name" class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{category_name}}の申請一覧</h3>
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('inquiry.list.search._status')}}</label>
                                                <select class="form-control" id="types" v-model="form.status">
                                                    <option value="" :selected="true">{{ $t('inquiry.list.search._status_place_holder')}}</option>
                                                    <option value="1">{{ $t('request').attr.status._open }}</option>
                                                    <option value="2">{{ $t('request').attr.status._in_progress }}</option>
                                                    <option value="3">{{ $t('request').attr.status._approved }}</option>
                                                    <option value="4">{{ $t('request').attr.status._rejected }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('inquiry.list.search._time_range')}}</label>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ $t('common.list.search_box._keyword')}}</label>
                                                <input
                                                    v-model="form.keyword"
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
                                                class="btn btn-outline-secondary pl-4 pr-4" @click="resetForm()"
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
                <div class="col-10 offset-1">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ $t('common.list.data_table._id') }}</th>
                                    <th>{{ $t('request.attr._sender')}}</th>
                                    <th>{{ $t('request.attr._approver')}}</th>
                                    <th>{{ $t('request.attr._status')}}</th>
                                    <th>{{ $t('request.list.data_table._request_at')}}</th>
                                    <th>{{ $t('request.list.data_table._last_approved_at')}}</th>
                                    <th>{{ $t('request.list.data_table._action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(request, index)  in requests" :key="request.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ request.user.name }}</td>
                                    <td>
                                        <div v-if="request.template.approvers.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="approver in request.template.approvers" :key="'sc_' + approver.id">
                                                {{ approver.name}}
                                            </span>
                                        </div>
                                    </td>
                                    <td v-html="getStatus(request)"> </td>
                                    <td>{{ request.created_at|myDate }}</td>
                                    <td>{{ getLastRequestLog(request)|myDate }}</td>
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
                                                   :to="'/admin/request/' + request.id">
                                                    {{ $t('request.list.data_table.actions._act_show_details')}}
                                                </router-link>
                                                <a class="dropdown-item text-primary" v-if="canUpdateRequest(request) & canChangeStatus(request)" href="#" @click="approve(request.id)">
                                                    {{$t('request.list.data_table.actions._act_approve')}}
                                                </a>
                                                <a class="dropdown-item text-danger" v-if="canUpdateRequest(request) & canChangeStatus(request)" href="#" @click="reject(request.id)">
                                                    {{$t('request.list.data_table.actions._act_reject')}}
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
        </div>
    </section>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker';
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';
    export default {
        components: { DateRangePicker },
        data () {
            return {
                form: new Form({
                    keyword: "",
                    release_date: {
                        startDate: null,
                        endDate: null
                    },
                    status: 0,
                    category_id: this.$route.params.id,
                }),
                requests : [],
                paginator : {},
                status_label: '',
                category_name: '',
                statusLabelClass: '',
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
            }
        },
        methods: {
            resetForm() {
                this.isValidate = false;
                this.form = new Form({
                    keyword: "",
                    release_date: {
                        startDate: null,
                        endDate: null
                    },
                    status: 0,
                    category_id: this.$route.params.id
                });
                this.getResults();
            },
            getCategory() {
                if(this.requests.length > 0) {
                    this.category_name = this.requests[0].template.category[0].name ?? '';
                    return;
                }
                this.loadCategory();
            },
            loadCategory() {
                axios.get("/api/category/"  + this.$route.params.id)
                    .then(( response ) => {
                        this.category_name = response.data.data['name'];
                    });
            },
            getResults(page = 1) {
                this.$Progress.start();
                axios.get("/api/request?category_id="  + this.$route.params.id + "&page=" + page
                    + "&keyword=" + this.form.keyword + "&status=" + this.form.status  + "&category_id=" + this.form.category_id
                    + "&start_date=" + new Date(this.form.release_date.startDate).toISOString() + "&end_date=" + new Date(this.form.release_date.endDate).toISOString())
                    .then((response) => {
                        this.requests = response.data.data;
                        this.paginator = response.data.meta;
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t("common.messages._system_err"),
                        });
                    });
                this.$Progress.finish();
            },
            canUpdateRequest(request) {
                return _.findIndex(request.template.approvers, ['id', window.user.id]) >= 0;
            },
            approve(id) {
                this.$Progress.start();
                axios.post("/api/request/" + id + "/status", {
                    status: 1,
                })
                .then((data) => {
                    if (data.data.status) {
                        Toast.fire({
                            icon: "success",
                            title: this.$t('request').list.messages._approve_success,
                        });
                        this.loadRequests();
                        this.$Progress.finish();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('request').list.messages._approve_failed,
                        });
                        this.$Progress.failed();
                    }
                })
                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('request').list.messages._approve_failed,
                    });
                })
            },
            reject(id) {
                Swal.fire({
                    title: this.$t('request').others._reject_modal_title,
                    text: this.$t('request').others._reject_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('request').others._modal_yes,
                    cancelButtonText: this.$t('request').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.$Progress.start();
                        axios.post("/api/request/" + id + "/status", {
                            status: 2,
                        })
                        .then((data) => {
                            if (data.data.status) {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t('request').list.messages._reject_success,
                                });
                                this.loadRequests();
                                this.$Progress.finish();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('request').list.messages._reject_failed,
                                });
                                this.$Progress.failed();
                            }
                        })
                        .catch(() => {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('request').list.messages._reject_failed,
                            });
                        })
                    }
                })
            },
            loadRequests(){
                axios.get("/api/request?category_id="  + this.$route.params.id)
                    .then(( response ) => {
                        this.requests = response.data.data;
                        this.paginator = response.data.meta;
                        this.getCategory();
                    });
            },
            canChangeStatus(object){
                self = this;
                if (object.request_logs.length === 0) {
                    return true;
                }

                let approvedCount = 0;
                _.forEach(object.request_logs, function (log, logKey) {
                    if (log.status === 2) {
                        return false;
                    }

                    let valid_approver = _.findIndex(object.template.approvers, ['id', log.approver_id]) >= 0;
                    if (valid_approver){
                        approvedCount++;
                    }
                });

                if (approvedCount === 0) {
                    return true;
                }

                if (approvedCount === object.template.approvers.length) {
                    return false;
                }

                return true;
            },
            getStatus(object) {
                if (object.status === 1) {
                    return '<span class="text-warning">' + this.$t('request').attr.status._open + '</span>'
                }
                if (object.status === 2) {
                    return '<span class="text-primary">' + this.$t('request').attr.status._in_progress + '</span>'
                }
                if (object.status === 3) {
                    return '<span class="text-info">' + this.$t('request').attr.status._approved + '</span>'
                }
                if (object.status === 4) {
                    return '<span class="text-secondary">' + this.$t('request').attr.status._rejected + '</span>'
                }
            },
            getLastRequestLog(object) {
                self = this;
                if (object.request_logs.length === 0) {
                    return '';
                }
                return object.request_logs[0].created_at;
            }
        },
        mounted() {
        },
        created() {
            this.$Progress.start();
            this.loadRequests();
            this.$Progress.finish();
        }
    }
</script>
