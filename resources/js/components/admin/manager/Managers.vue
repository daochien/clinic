<template>
    <div class="page-managers">
        <div class="page-header row no-gutters py-4" v-if="$gate.canPermission('manager.index')">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('admin.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <router-link :to="{path: '/admin/manager/create'}">
                    <button class="btn btn-primary float-right">
                        {{ $t('admin.list.others._btn_create') }}
                    </button>
                </router-link>
            </div>
        </div>
        <div class="row page-filter  mb-5" v-if="$gate.canPermission('manager.index')">
            <div class="col-10 offset-1 col-sm-8 offset-sm-2">
                <div class="card card-small">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('admin.attr._role') }}</label>
                                    <select class="form-control" v-model="form_filter.role">
                                        <option value="">{{ $t('admin.list.search_box._role_df') }}</option>
                                        <option v-for="(role, index) in roles" :key="index" :value="role">{{ role }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('common.list.search_box._keyword') }}</label>
                                    <input :placeholder="$t('common.list.search_box._keyword_pl')" v-model="form_filter.keyword" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button @click="clearFilter()" type="button" class="mb-2 btn btn-outline-dark mr-2">{{ $t('common.list.search_box._btn_reset') }}</button>
                                <button @click="searchAdmin()" type="button" class="mb-2 btn btn-outline-info">{{ $t('common.list.search_box._btn_search') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="$gate.canPermission('manager.index')">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._id') }}</th>
                                <th scope="col" class="border-0">{{ $t('admin.attr._username') }}</th>
                                <th scope="col" class="border-0">{{ $t('admin.attr._mail_address') }}</th>
                                <th scope="col" class="border-0">{{ $t('admin.attr._role') }}</th>
                                <th scope="col" class="border-0">{{ $t('admin.attr._memo') }}</th>
                                <th scope="col" class="border-0">{{ $t('admin.list.data_table._last_login_at') }}</th>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in admins" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name | limitString20 }}</td>
                                    <td>{{ item.email | limitString20 }}</td>
                                    <td>
                                        <span class="mr-2" v-for="(role, roleIndex) in item.roles" :key="roleIndex">
                                            {{ role.name }}
                                        </span>
                                    </td>
                                    <td>{{ item.description | limitString }}</td>
                                    <td>{{item.last_login|myDate}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <i
                                                class="fa fa-ellipsis-v"
                                                id="operatingAction"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            ></i>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="operatingAction">
                                                <router-link class="dropdown-item text-primary" :to="{path: `/admin/manager/edit/${item.id}`}">
                                                    {{ $t('admin.list.data_table.actions._act_edit') }}
                                                </router-link>
                                                <a class="dropdown-item text-danger" href="#" @click="removeAdmin(item.id)">
                                                    {{ $t('admin.list.data_table.actions._act_remove') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="paginator" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!$gate.canPermission('manager.index')">
            <not-found></not-found>
        </div>
    </div>
</template>

<script>

export default {

    data () {
        return {
            admins: [],
            paginator: {},
            roles: [],
            form_filter: {
                role: '',
                keyword: ''
            },
            idRemove: 0
        }
    },

    created () {
        console.log(this.$t('x.list'))
        this.loadRoles();
        this.loadListAdmin();
    },

    methods: {
        loadRoles () {
            axios.get("/api/manager/roles").then(({ data }) => (this.roles = data.data));
        },
        getResults(page = 1) {
            this.$Progress.start();

            axios.get('/api/manager', {
                params: {
                    page: page,
                    role: this.form_filter.role,
                    keyword: this.form_filter.keyword
                }
            }).then(({ data }) => {
                this.admins = data.data;
                this.paginator = data.meta
            });
            this.$Progress.finish();
        },
        searchAdmin () {
            this.$Progress.start();

            axios.get('/api/manager', {
                params: {
                    page: 1,
                    role: this.form_filter.role,
                    keyword: this.form_filter.keyword
                }
            }).then(({ data }) => (this.admins = data.data));
            this.$Progress.finish();
        },
        loadListAdmin () {
            axios.get("/api/manager")
            .then(({ data }) => {
                this.admins = data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        removeAdmin (id) {
            Swal.fire({
                title: this.$t('admin.others._remove_modal_title'),
                text: this.$t('admin.others._remove_modal_description'),
                showCancelButton: true,
                cancelButtonText: this.$t('admin.others._remove_modal_no'),
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: this.$t('admin.others._remove_modal_yes')
            }).then((result) => {
                // Send request to the server
                if (result.value) {

                    axios.delete('/api/manager/'+id).then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: this.$t('admin.others._remove_modal_deleted')
                        });
                        // Fire.$emit('AfterCreate');
                        this.loadListAdmin();
                    }).catch((data) => {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('common.messages._system_err')
                        });
                    });
                }
            })
        },
        clearFilter () {
            this.form_filter.role = '';
            this.form_filter.keyword = '';
            this.loadListAdmin();
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
