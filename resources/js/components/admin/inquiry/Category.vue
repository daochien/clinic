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
            <div class="row mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('inquiry.list.search._status')}}</label>
                                                <select class="form-control" id="types" v-model="form.status">
                                                    <option value="" :selected="true">{{ $t('inquiry.list.search._status_place_holder')}}</option>
                                                    <option value="1">{{ $t('inquiry.attr.status._open')}}</option>
                                                    <option value="2">{{ $t('inquiry.attr.status._closed')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ $t('inquiry.list.search._time_range')}}</label>
                                                <date-range-picker
                                                    ref="picker"
                                                    style="width: 100%"
                                                    v-model="form.release_date"
                                                    :auto-apply="true"
                                                    :locale-data="localeData"
                                                >
                                                    <template v-slot:input="picker" style="min-width: 350px;">
                                                        <div v-if="picker.startDate && picker.endDate">
                                                            {{ $moment(picker.startDate).format('YYYY-MM-DD HH:mm:ss') }} - {{ $moment(picker.endDate).format('YYYY-MM-DD HH:mm:ss') }}
                                                        </div>
                                                    </template>
                                                </date-range-picker>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ $t('common.list.search_box._keyword')}}</label>
                                                <input
                                                    v-model="form.keyword"
                                                    type="text"
                                                    class="form-control"
                                                    :placeholder="$t('common.list.search_box._keyword_pl')"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6 text-right">
                                            <button
                                                type="reset"
                                                class="btn btn-outline-secondary pl-4 pr-4" @click="resetForm()"
                                            >{{ $t('common.list.search_box._btn_reset')}}
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-outline-primary pl-4 pr-4" @click="searchData()">
                                                {{ $t('common.list.search_box._btn_search')}}
                                            </button>
                                        </div>
                                    </div>
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
                                <thead>
                                <tr>
                                    <th>{{ $t('common.list.data_table._id') }}</th>
                                    <th>{{ $t('inquiry.list.data_table._title')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._username')}}</th>
                                    <th>{{ $t('inquiry.list.data_table._status')}}</th>
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
                            <pagination :data="paginator" @pagination-change-page="searchData()"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker';
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';

    export default {
        components: { DateRangePicker },
        data () {
            return {
                inquirys : [],
                paginator: {},
                statusSelected: '',
                form: new Form({
                    keyword: "",
                    release_date: {
                        startDate: null,
                        endDate: null
                    },
                    status: 0,
                    category_id: this.$route.params.id
                }),
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
        methods: {
            resetForm() {
                this.isValidate = false;
                this.form = new Form({
                    keyword: "",
                    release_date: {
                        startDate: null,
                        endDate: null
                    },
                    status: 0,
                    category_id: this.$route.params.id
                });
                this.loadInquiry();
            },
            searchData() {
                this.$Progress.start();
                axios
                    .post("/api/inquiry/search", this.form)
                    .then((response) => {
                        this.inquirys = response.data.data;
                        this.paginator = response.data.meta;
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: "error",
                            title: this.$t("common.messages._system_err"),
                        });
                    });
                this.$Progress.finish();
                this.$forceUpdate();
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
                        axios.post("/api/inquiry/" + id + "/close", {
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
                axios.get("/api/inquiry?category_id="  + this.$route.params.id)
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
