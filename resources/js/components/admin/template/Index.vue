<template>
    <section class="content">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('template.page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <a type="button" class="btn btn-primary pl-5 pr-5" href="/admin/template/create">{{ $t('app.btn.create')}}
                </a>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ $t('template.title')}}</th>
                                    <th>{{ $t('template.category_title')}}</th>
                                    <th>{{$t('template.approver')}}</th>
                                    <th>{{ $t('template.date_created')}}</th>
                                    <th>{{ $t('app.label.operator')}}</th>

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
                                                    {{ $t('app.btn.edit')}}
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" @click="deleteTemplate(template.id)">
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
                            <pagination :data="templates" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>
        </div>
    </section>
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
                axios.get("/api/template?page=" + page).then(({ data }) => ( this.templates = data.data));
            },
            deleteTemplate(id) {
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
                            this.loadTemplates();
                        }).catch((data) => {
                            Swal.fire(this.$t('app').popup.failed, data.message, "warning");
                        });
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
            console.log(this.$t('app').popup.are_you_sure)
        },
        created() {
            // this.$Progress.start();
            console.log('created')
            this.loadTemplates();
            // this.$Progress.finish();
        }
    }
</script>
