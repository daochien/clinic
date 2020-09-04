<template>
    <div class="page-managers">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">List of articles</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <router-link :to="{path: '/admin/page/create'}">
                    <button class="btn btn-primary float-right">
                        Create New
                    </button>
                </router-link>
            </div>
        </div>
        <div class="row page-filter mb-5">
            <div class="col-12 col-sm-10 offset-sm-1">
                <div class="card card-small">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">Documents</label>
                                    <select class="form-control" v-model="form_filter.type">
                                        <option value="">All documents</option>
                                        <option value="blog">Blog</option>
                                        <option value="manual">Manual</option>
                                        <option value="faq">FAQ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">Status</label>
                                    <select class="form-control" v-model="form_filter.status">
                                        <option value="">All status</option>
                                        <option value="1">Public</option>
                                        <option value="0">Un Public</option>                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">Publication date</label>
                                    <date-range-picker
                                        ref="picker"
                                        style="width: 100%"
                                        :opens="'left'"
                                        v-model="form_filter.release_date"
                                        :auto-apply="true"
                                        :locale-data="localeData"
                                    >
                                        <template v-slot:input="picker" style="min-width: 350px;">
                                            <div v-if="picker.startDate && picker.endDate">
                                                {{ $moment(picker.startDate).format('YYYY-MM-DD') }} - {{ $moment(picker.endDate).format('YYYY-MM-DD') }}
                                            </div>
                                        </template>
                                    </date-range-picker>
                                </div>
                            </div>
                            <div class="col-12">
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
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._id') }}</th>
                                <th scope="col" class="border-0">Title</th>
                                <th scope="col" class="border-0">Type</th>
                                <th scope="col" class="border-0">Category</th>
                                <th scope="col" class="border-0">Public date</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in pages" :key="index">
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
                                                style="cursor: pointer;"
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
    </div>
</template>
<script>

import DateRangePicker from 'vue2-daterange-picker';
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';

export default {
    components: { DateRangePicker },
    data () {
        return {
            form_filter: {
                release_date: {
                    startDate: null,
                    endDate: null
                },
            },
            pages: [],
            paginator: {},
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
    }
}
</script>