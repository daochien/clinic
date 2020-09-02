<template>
    <section class="content">
        <div class="container-fluid" v-if="this.$gate.isRoot()">

            <div class="page-header row no-gutters py-4">
                <div class="col-6 text-center text-sm-left mb-0">
                    <h3 class="page-title">{{ $t('group.group_users._page_title')}}</h3>
                </div>
                <div class="col-6 text-center text-sm-right mb-0">
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" :disabled="!addButton" @click="addToGroup()">{{ $t('group.group_users.others._btn_update')}} {{group}}</button>
                        <button type="button" class="btn btn-danger"  :disabled="!removeButton" @click="removeToGroup()">{{ $t('group.remove_from_group')}} {{group}}</button>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-10 col-ms-12 offset-1">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-4">
                            <form>

                                <div class="form-group">
                                    <label>{{ $t('common.list.search_box._keyword')}} <span class="text-danger">*</span></label>
                                    <input v-model="value" type="text" name="keyword"
                                           :placeholder="$t('common.list.search_box._keyword_pl')"
                                           class="form-control" >
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <button type="button" @click="removeCondition()"  class="btn btn-light border mr-3">{{ $t('common.list.search_box._btn_reset')}}</button>
                                    <button type="button" @click="filter()" class="btn btn-light text-primary border-primary">{{ $t('common.list.search_box._btn_search')}}</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row mb-5">

                <div class="col-12">

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" v-model="selectAll"></th>
                                    <th>{{ $t('staff.attr._username')}}</th>
                                    <th>{{ $t('staff.attr._mail_address')}}</th>
                                    <th>{{ $t('staff.attr._position')}}</th>
                                    <th>{{ $t('staff.list.data_table._registered_at')}}</th>
                                    <th>{{ $t('staff.list.data_table._last_login_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in members.data" :key="item.id">
                                    <td><input type="checkbox" v-model="selected" :value="item.id" number></td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{group}}</td>
                                    <td>{{item.created_at}}</td>
                                    <td>{{item.last_login}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>

        <div v-else>
            <not-found></not-found>
        </div>

    </section>
</template>

<script>
    export default {
        data () {
            return {
                members : {},
                groupUsers:{},
                selected:[],
                id:'',
                group:'',
                value : '',
                removeAllow: false
            }
        },
        computed: {

            addButton:function(){
                if(this.selected.length){
                    if(this.value != ''){
                        return true;
                    }
                } else{
                    return false;
                }
            },
            removeButton:function(){
                if(this.selected.length){
                    if(this.removeAllow){
                        return true;
                    }
                } else{
                    return false;
                }
            },

            selectAll: {
                get: function () {
                    return this.members.data ? this.selected.length == this.members.data.length : false;
                },
                set: function (value) {
                    let selected = [];
                    if (value) {
                        this.members.data.forEach( (item)=> {
                            selected.push(item.id);
                        });
                    }

                    this.selected = selected;
                }
            }
        },
        methods: {

            loadMembers(){
                if(this.$gate.isRoot()){
                    axios.get("/api/group/members/"+this.id).then(({ data }) => {
                        this.members = data.data
                    });
                }
            },

            removeCondition(){
              this.value='';
              this.removeAllow = true;
              this.selected = [];
              this.loadMembers();
            },

            filter(){
                if(this.$gate.isRoot()){
                    this.$Progress.start();

                    axios.get('/api/group/members/filter/'+this.id +'/'+this.value)
                            .then((data)=>{
                                this.members = data.data
                                Toast.fire({
                                    icon: 'success',
                                    title: data.data.message
                                });
                                this.removeAllow = true;
                                this.$Progress.finish();
                            })
                            .catch(()=>{
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('common.messages._system_err')
                                });
                            })
                    }
                },

            getGroupName(){
                axios.get("/api/group/"+this.id).then(({ data }) => {
                    this.group = data.data.name
                });
            },

            addToGroup(){
                if(this.$gate.isRoot()) {
                    var count_success = 0;
                    var count_error = 0;
                    if (this.selected.length) {
                        this.selected.forEach(element => {
                            axios.post("/api/group/members/add", {user_id: element, group_id: this.id})
                                .then((data) => {
                                    this.loadData();
                                    this.selected = [];
                                })
                                .catch(() => {
                                })
                        });

                        Toast.fire({
                            icon: 'success',
                            title: this.$t('group.group_users.messages._update_success')
                        });
                        this.$Progress.finish();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('group.group_users.messages._update_failed')
                        });
                    }
                }
            },

            loadGroupUsers(){
                axios.get('/api/group/members/group-users/'+this.id)
                    .then((data)=>{
                        this.groupUsers = data.data;
                    })
            },


            removeToGroup(){
                if(this.$gate.isRoot()) {

                    if (this.selected.length) {
                        let idSelected = [];

                        this.groupUsers.data.forEach((element) => {
                            this.selected.forEach((item) => {
                                if (element.user_id == item) {
                                    idSelected.push(element.id);
                                }
                            })
                        })


                        axios.post("/api/group/members/remove", {ids: idSelected})
                            .then((data) => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'remove user success'
                                });

                                this.selected = [];
                                idSelected = [];
                                this.loadData();
                                this.$Progress.finish();
                            })
                            .catch(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: this.$t('group.group_users.messages._update_success')
                                });
                            })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: this.$t('group.group_users.messages._update_failed')
                        });
                    }
                }
            },

            loadData(){
                if(this.$gate.isRoot()) {
                    this.removeAllow = true;
                    if (this.id) {
                        this.loadMembers();
                        this.getGroupName();
                        this.loadGroupUsers();
                    } else {
                        if (this.$route.params.id) {
                            this.id = this.$route.params.id;
                            this.loadMembers();
                            this.getGroupName();
                            this.loadGroupUsers();
                        } else {
                            this.$router.push({path: '/admin/group'});
                        }
                    }
                }
            }

        },
        mounted() {

        },
        created() {
            this.$Progress.start();

            this.loadData();

            this.$Progress.finish();
        }
    }
</script>
<style scoped>
    .table-hover th{font-weight: 200;font-size:13px}
    .dropdown-menu{border-radius: 0}
    .dropdown-item{font-weight: normal; font-size: 11px;line-height: 13px}
</style>>
