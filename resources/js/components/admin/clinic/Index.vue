<template>
    <section class="content" v-if="$gate.isAdmin()">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ $t('app.clinic.header.create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <router-link type="button" class="btn btn-primary pl-5 pr-5" to="/admin/clinic/create">{{ $t('app.btn.create')}}
                </router-link>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="col-auto">#</th>
                                    <th scope="col" class="col-auto">{{ $t('app.clinic.name')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('app.clinic.address')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('app.clinic.users_count')}}</th>
                                    <th scope="col" class="col-auto">{{ $t('app.label.operator')}}</th>
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
                                                    {{ $t('app.clinic.manage_user')}}
                                                </router-link>
                                                <router-link class="dropdown-item text-primary"
                                                             :to="{ name: 'clinic.edit', params: { id: entity.id }} ">
                                                    {{ $t('app.btn.edit')}}
                                                </router-link>
                                                <a class="dropdown-item text-danger" href="#" @click="deleteClinic(entity.id)">
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
                this.$Progress.start();
                if (this.$gate.isAdmin()) {
                    axios
                        .get("/api/clinic")
                        .then((response) => {this.clinics = response.data; this.paginator = response.data.meta});
                }
                this.$Progress.finish();
            },
            deleteClinic(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .delete("/api/clinic/"+id)
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
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
