<template>
    <section class="content" v-if="$gate.canPermission('clinic.index')">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('clinic.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <router-link type="button" class="btn btn-primary pl-5 pr-5" to="/admin/clinic/create">{{ $t('clinic.list.others._btn_create')}}
                </router-link>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="$gate.canPermission('clinic.index')">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="col-auto">{{ $t('common.list.data_table._id') }}</th>
                                    <th scope="col" class="col-auto">{{ $t('clinic.attr._name')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('clinic.attr._address')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('clinic.list.data_table._staff_count')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in clinics.data" :key="entity.id">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ entity.name }}</td>
                                    <td>{{ entity.address }}</td>
                                    <td>{{ entity.users_count }}</td>
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
                                                             :to="{ name: 'clinic.add.user', params: { id: entity.id }} ">
                                                    {{ $t('clinic.list.data_table.actions._act_add_user')}}
                                                </router-link>
                                                <router-link class="dropdown-item text-primary"
                                                             :to="{ name: 'clinic.edit', params: { id: entity.id }} ">
                                                    {{ $t('clinic.list.data_table.actions._act_edit')}}
                                                </router-link>
                                                <a class="dropdown-item text-danger" href="#" @click="deleteClinic(entity.id)">
                                                    {{$t('clinic.list.data_table.actions._act_remove')}}
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
    <div v-else>
        <not-found></not-found>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                clinics: [],
                paginator: {},
            }
        },
        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                axios.get('/api/clinic?page=' + page)
                    .then((response) => {this.clinics = response.data; this.paginator = response.data.meta});
                this.$Progress.finish();
            },
            loadClinics() {
                axios
                    .get("/api/clinic")
                    .then((response) => {this.clinics = response.data; this.paginator = response.data.meta});
            },
            deleteClinic(id){
                Swal.fire({
                    title: this.$t('app').popup.are_you_sure,
                    text: this.$t('app').popup.you_wont_able_revert,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('app').popup.delete_it
                }).then((result) => {
                    if (result.value) {
                        axios
                            .delete("/api/clinic/"+id)
                            .then(() => {
                                Swal.fire(
                                    this.$t('app').popup.deleted,
                                    this.$t('app').popup.your_item_has_been_deleted,
                                    'success'
                                );
                                // Fire.$emit('AfterCreate');
                                this.loadClinics();
                            }).catch((data)=> {
                            Swal.fire("Failed!", data.message, "warning");
                        });
                    }
                })
            },
        },
        created() {
            this.$Progress.start();
            this.loadClinics();
            this.$Progress.finish();
        },
    };
</script>
