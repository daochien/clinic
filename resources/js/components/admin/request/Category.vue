<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('request.list._page_title') }}</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
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
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(request, index)  in requests.data" :key="request.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ request.user.name }}</td>
                                    <td>
                                        <div v-if="request.form.approvers.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="approver in request.form.approvers" :key="'sc_' + approver.id">
                                                {{ approver.name}}
                                            </span>
                                        </div>
                                    </td>
                                    <td> {{getStatus(request)}}</td>
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
                                                <a class="dropdown-item text-primary" href="#" @click="approve(request.id)">
                                                    {{$t('request.list.data_table.actions._act_approve')}}
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" @click="reject(request.id)">
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
                            <pagination :data="requests" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                requests : {},
                status_label: '',
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get("/api/request/category/"  + this.$route.params.id + "/?page=" + page).then(({ data }) => ( this.requests = data.data));
            },
            approve(id) {
                this.$Progress.start();
                axios.post("/api/request/" + id + "/status", {
                    status: 1,
                })
                .then((data) => {
                    if (data.data.success) {
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
                    confirmButtonText: this.$t('request').others._reject_modal_yes,
                    cancelButtonText: this.$t('request').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.$Progress.start();
                        axios.post("/api/request/" + id + "/status", {
                            status: 2,
                        })
                        .then((data) => {
                            if (data.data.success) {
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
                axios.get("/api/request/category/"  + this.$route.params.id).then(({ data }) => ( this.requests = data.data));
            },
            getStatus(object) {
                self = this;
                if (object.request_logs.length === 0) {
                    this.status_label = 'btn-warning';
                    return this.$t('request').attr.status._open;
                }

                let approvedCount = 0;
                _.forEach(object.request_logs, function (log, logKey) {
                    if (log.status === 2) {
                        self.status_label = 'btn-secondary';
                        return self.$t('request').attr.status._rejected;
                    }
                    approvedCount++;
                });

                if (approvedCount === object.form.approvers.length) {
                    this.status_label = 'btn-info';
                    return this.$t('request').attr.status._approved;
                }

                this.status_label = 'btn-primary';
                return this.$t('request').attr.status._in_progress;
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
