<template>
    <section class="content" v-if="$gate.canPermission('template.index')">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('request.template.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <a type="button" class="btn btn-primary pl-5 pr-5" href="/admin/template/create">{{ $t('request.template.list.others._btn_create')}}
                </a>
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
                                    <th>{{ $t('request.attr._title')}}</th>
                                    <th>{{ $t('request.attr._category')}}</th>
                                    <th>{{ $t('request.attr._approver')}}</th>
                                    <th>{{ $t('request.template.list.data_table._created_at')}}</th>
                                    <th>{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(template, index)  in templates.data" :key="template.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ template.name }}</td>
                                    <td>{{ template.category[0].name }}</td>
                                    <td>
                                        <div v-if="template.approvers.length !== 0">
                                            <span class="badge badge-info ml-1" v-for="approver in template.approvers" :key="'sc_' + approver.id">
                                                {{ approver.name}}
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ template.created_at|myDate }}</td>
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
                                                             :href="'/admin/template/' + template.id + '/edit'">
                                                    {{ $t('request.template.list.data_table.actions._act_edit')}}
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" @click="deleteTemplate(template.id)">
                                                    {{$t('request.template.list.data_table.actions._act_remove')}}
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
                            <pagination :data="templates" @pagination-change-page="getResults"></pagination>
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
        data () {
            return {
                templates : {},
            }
        },
        methods: {

            getResults(page = 1) {
                this.$Progress.start();
                axios.get("/api/template?page=" + page).then(({ data }) => ( this.templates = data.data));
                this.$Progress.finish();
            },
            deleteTemplate(id) {
                this.$Progress.start();
                Swal.fire({
                    title: this.$t('request').others._remove_modal_title,
                    text: this.$t('request').others._remove_modal_description,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('request').others._remove_modal_yes,
                    cancelButtonText: this.$t('request').others._remove_modal_no,
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        axios.delete('/api/template/' + id)
                            .then((data) => {
                                if (data.data.status) {
                                    Toast.fire({
                                        icon: "success",
                                        title: this.$t('request').template.info.messages._delete_success,
                                    });
                                    this.loadTemplates();
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: this.$t('request').list.messages._approve_failed,
                                    });
                                    this.$Progress.failed();
                                }

                                this.$Progress.finish();
                        })
                        .catch(() => {
                            Toast.fire({
                                icon: 'error',
                                title: this.$t('request').list.messages._approve_failed,
                            });
                        })
                    }
                })
            },
            loadTemplates(){
                this.$Progress.start();
                if(this.$gate.isAdmin()){
                    axios.get("/api/template").then(({ data }) => ( this.templates = data.data));
                }
                this.$Progress.finish();
            },

        },
        mounted() {
        },
        created() {
            // this.$Progress.start();
            this.loadTemplates();
            // this.$Progress.finish();
        }
    }
</script>
