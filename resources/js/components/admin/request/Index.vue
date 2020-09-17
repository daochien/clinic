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
                                        <div v-if="request.approvers.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="approver in request.approvers" :key="'sc_' + approver.id">
                                                {{ approver.name}}
                                            </span>
                                        </div>
                                    </td>
                                    <td> <span class="text-warning">承認待ち</span> </td>
                                    <td>{{ request.created_at|myDate }}</td>
                                    <td>-</td>
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
                                                <a class="dropdown-item text-primary"
                                                   :href="'/admin/template/' + request.id + '/edit'">
                                                    {{ $t('app.btn.edit')}}
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" @click="deleteTemplate(request.id)">
                                                    {{$t('app.btn.delete')}}
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
            }
        },
        methods: {

            getResults(page = 1) {
                axios.get("/api/request?category_id="  + this.$route.params.id + "/?page=" + page).then(({ data }) => ( this.requests = data.data));
            },
            /*deleteTemplate(id) {
                Swal.fire({
                    title: this.$t('app').popup.are_you_sure,
                    text: this.$t('app').popup.you_wont_able_revert,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('app').popup.delete_it
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.delete('/api/template/' + id).then(() => {
                            Swal.fire(
                                this.$t('app').popup.deleted,
                                this.$t('app').popup.your_item_has_been_deleted,
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            this.loadRequests();
                        }).catch((data) => {
                            Swal.fire(this.$t('app').popup.failed, data.message, "warning");
                        });
                    }
                })
            },*/
            loadRequests(){
                axios.get("/api/request/category/"  + this.$route.params.id).then(({ data }) => ( this.requests = data.data));
            },

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
