<template>
    <div class="page-managers">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('manager.title_page_list') }}</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <router-link :to="{path: '/admin/manager/create'}">
                    <button class="btn btn-primary float-right">
                        {{ $t('manager.button_create') }}
                    </button>                
                </router-link>                
            </div>
        </div>
        <div class="row page-filter">
            <div class="col-12 col-sm-8 offset-sm-2">
                <div class="card card-small mb-3">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('manager.form_filter.select_roles') }}</label>
                                    <select class="form-control">
                                        <option value="">Super Admin</option>
                                        <option value="">Admin</option>
                                        <option value="">Manager</option>
                                        <option value="">Quest</option>
                                    </select>
                                </div>                            
                            </div>
                            <div class="col-sm-6 col-12">                           
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('manager.form_filter.input_text_search') }}</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="mb-2 btn btn-outline-dark mr-2">{{ $t('manager.form_filter.button_clear') }}</button>
                                <button type="button" class="mb-2 btn btn-outline-info">{{ $t('manager.form_filter.button_search') }}</button>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row table-list">
            <div class="col-12 col-sm-12">
                <div class="card card-small mb-4">                  
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                                <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.name') }}</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.email') }}</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.role') }}</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.note') }}</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.last_login') }}</th>
                                <th scope="col" class="border-0">{{ $t('manager.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ali</td>
                                    <td>Kerry</td>
                                    <td>Russian Federation</td>
                                    <td>Gdańsk</td>
                                    <td>107-0339</td>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#">
                                            <i class="fa fa-trash red"></i>
                                            </a>
                                    </td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>

</style>