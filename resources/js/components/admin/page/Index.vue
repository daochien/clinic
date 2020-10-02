<template>
    <div class="page-managers">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('page.list._page_title') }}</h3>
            </div>
            <div class="col-12 col-sm-4 text-center text-sm-right mb-0">
                <router-link :to="{path: '/admin/page/create'}">
                    <button class="btn btn-primary float-right">
                        {{ $t('page.list.others._btn_create') }}
                    </button>
                </router-link>
            </div>
        </div>
        <div class="row page-filter mb-5">
            <div class="col-8 offset-2">
                <div class="card card-small">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('page.list.search_box._type') }}</label>
                                    <select class="form-control" v-model="form_filter.type">
                                        <option value="">{{ $t('page.list.search_box._type_pl') }}</option>
                                        <option value="blog">記事</option>
                                        <option value="manual">マニュアル</option>
                                        <option value="faq">よくある質問</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('page.list.search_box._status') }}</label>
                                    <select class="form-control" v-model="form_filter.status">
                                        <option value="">{{ $t('page.list.search_box._status_pl') }}</option>
                                        <option value="1">公開</option>
                                        <option value="0">非公開</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="feInputTitle">{{ $t('page.list.search_box._date') }}</label>
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
                                    <label for="feInputTitle">{{ $t('page.list.search_box._keyword') }}</label>
                                    <input :placeholder="$t('page.list.search_box._keyword_pl')" v-model="form_filter.keyword" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button @click="clearFilter()" type="button" class="mb-2 btn btn-outline-dark mr-2">{{ $t('page.list.search_box._btn_clear') }}</button>
                                <button @click="getResults()" type="button" class="mb-2 btn btn-outline-info">{{ $t('page.list.search_box._btn_search') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._id') }}</th>
                                <th scope="col" class="border-0">{{ $t('page.list.data_table._title') }}</th>
                                <th scope="col" class="border-0">{{ $t('page.list.data_table._type') }}</th>
                                <th scope="col" class="border-0">{{ $t('page.list.data_table._category') }}</th>
                                <th scope="col" class="border-0">{{ $t('page.list.data_table.public_date') }}</th>
                                <th scope="col" class="border-0">{{ $t('page.list.data_table.status') }}</th>
                                <th scope="col" class="border-0">{{ $t('common.list.data_table._actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in pages" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td style="width: 350px;">{{ item.title }}</td>
                                    <td>{{ getLableType(item.type) }}</td>
                                    <td>
                                        {{ item.category_name }}
                                    </td>
                                    <td>{{ item.created_at | myDate }}</td>
                                    <td>
                                        <span class="badge badge-info ml-1" v-if="item.status">
                                            公開
                                        </span>
                                        <span class="badge badge-secondary ml-1" v-else>
                                            非公開
                                        </span>
                                        <!-- <div class="switchToggle">
                                            <input type="checkbox" :id="'switch'+item.id" :checked="item.status" @change="changeStatus(item.id)">
                                            <label :for="'switch'+item.id">Toggle</label>
                                        </div> -->
                                    </td>
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
                                                <router-link class="dropdown-item text-primary" :to="{path: `/admin/page/edit/${item.id}`}">
                                                    {{ $t('page.list.data_table.actions._act_edit') }}
                                                </router-link>
                                                <a class="dropdown-item text-danger" href="#" @click="removePage(item.id)">
                                                    {{ $t('page.list.data_table.actions._act_remove') }}
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
                type: '',
                status: '',
                keyword: '',
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
    },
    created () {
        this.getResults();
    },
    methods: {

        getLableType (type) {
            if (type == 'blog') {
                return '記事';
            } else if (type == 'manual') {
                return 'マニュアル';
            } else if (type == 'faq') {
                return 'よくある質問';
            } else {
                return '-';
            }
        },

        async getResults (page = 1) {
            this.$Progress.start();
            this.form_filter.page = page;
            axios.get('/api/page', {
                params: this.form_filter
            }).then(({ data }) => {
                this.pages = data.data;
                this.paginator = data.meta
                this.$Progress.finish();
            }).catch (error => {
                this.$Progress.failed();
            });
        },

        changeStatus (id) {
            this.$Progress.start();
            axios.put('/api/page/'+id+'/change-status')
            .then((response) => {
                Toast.fire({
                    icon: 'success',
                    title: this.$t('page.info.messages._change_status_success')
                });
                this.$Progress.finish();
            })
            .catch((error) => {
                this.$Progress.failed();
                Toast.fire({
                    icon: 'error',
                    title: this.$t('page.info.messages._change_status_failed')
                });
            })
        },

        clearFilter () {
            this.form_filter.type = '';
            this.form_filter.status = '';
            this.form_filter.release_date.startDate = null;
            this.form_filter.release_date.endDate = null;
            this.form_filter.keyword = '';
            this.getResults();
        },

        removePage (id) {
            Swal.fire({
                title: this.$t('page.others._remove_modal_title'),
                text: this.$t('page.others._remove_modal_description'),
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: this.$t('page.others._remove_modal_no'),
                confirmButtonText: this.$t('page.others._remove_modal_yes')
            }).then((result) => {
                // Send request to the server
                if (result.value) {

                    axios.delete('/api/page/'+id).then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: this.$t('page.list.messages._remove_success')
                        });
                        // Fire.$emit('AfterCreate');
                        this.getResults();
                    }).catch((data) => {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('common.messages._system_err')
                        });
                    });
                }
            })
        },
    }
}
</script>
<style scoped>
.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 80px; max-width: 80px; height: 22px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 0px; left: 2px; width: 22px; height: 22px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #3e98d3; }
.switchToggle input + label:before, .switchToggle input + input + label:before {font-size: 12px; content: '非公開'; position: absolute; top: 2px; left: 35px; width: 40px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {font-size: 12px; content: '公開'; position: absolute; top: 2px; left: 10px; width: 40px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 60px; }
.toggle-switchArea { margin: 10px 0 10px 0; }
</style>
