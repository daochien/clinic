<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('inquiry.list._page_title') }}</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-10 offset-1">

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ $t('common.list.data_table._id') }}</th>
                                    <th>{{ $t('inquiry.list.data_table._title')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._username')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._requested_at')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._closed_at')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(inquiry, index)  in inquirys" :key="inquiry.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ inquiry.title }}</td>
                                    <td>{{ inquiry.created_by.name }}</td>
                                    <td> {{getStatus(inquiry)}}</td>
                                    <td>{{ inquiry.created_at|myDate }}</td>
                                    <td>{{ inquiry.closed_at|myDate }}</td>
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
                                                   :to="'/admin/inquiry/' + inquiry.id">
                                                    {{ $t('inquiry.list.data_table.actions._act_show_details')}}
                                                </router-link>
                                                <a class="dropdown-item text-danger" href="#" @click="close(inquiry.id)">
                                                    {{$t('inquiry.list.data_table.actions._act_close')}}
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
    export default {
        data () {
            return {
                inquirys : [],
                paginator: {},
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get("/api/inquiry/category/"  + this.$route.params.id + "/?page=" + page)
                    .then((response) => {
                        this.inquirys = response.data.data;
                        this.paginator = response.data.meta;
                    });
            },
            close(id) {
                Swal.fire({
                    title: this.$t('inquiry').others._reject_modal_title,
                    text: this.$t('inquiry').others._reject_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('inquiry').others._reject_modal_yes,
                    cancelButtonText: this.$t('inquiry').others._modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.$Progress.start();
                        axios.post("/api/inquiry/" + id + "/status", {
                            status: 2,
                        })
                        .then((data) => {
                            if (data.data.status) {
                                Toast.fire({
                                    icon: "success",
                                    title: this.$t('inquiry').list.messages._close_success,
                                });
                                this.loadInquiry();
                                this.$Progress.finish();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('inquiry').list.messages._close_failed,
                                });
                                this.$Progress.failed();
                            }
                        })
                        .catch(() => {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('inquiry').list.messages._close_failed,
                            });
                        })
                    }
                })
            },
            loadInquiry(){
                axios.get("/api/inquiry/category/"  + this.$route.params.id)
                    .then((response) => {
                        this.inquirys = response.data.data;
                        this.paginator = response.data.meta;
                    });
            },
            getStatus(inquiry) {
                if (inquiry.closed_by.length === 0) {
                    return this.$t('inquiry').attr.status._open;
                }
                return  this.$t('inquiry').attr.status._closed;
            },
        },
        mounted() {
        },
        created() {
            this.$Progress.start();
            this.loadInquiry();
            this.$Progress.finish();
        }
    }
</script>
