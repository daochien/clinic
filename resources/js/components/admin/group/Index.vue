<template>
  <section class="content">
    <div class="container-fluid" v-if="$gate.canPermission('group.index')">

        <div class="page-header row no-gutters py-4">
            <div class="col-6 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('group.list._page_title')}}</h3>
            </div>
            <div class="col-6 text-center text-sm-right mb-0" >
                <div class="card-tools">
                        <router-link :to="{name:'add_group'}" class="btn btn-sm btn-primary">{{ $t('group.list.others._btn_create')}}</router-link>
                </div>
            </div>
        </div>

        <div class="row">

          <div class="col-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>{{ $t('common.list.data_table._id') }}</th>
                      <th>{{ $t('group.attr._name')}}</th>
                      <th>{{ $t('group.list.data_table._staff_count')}}</th>
                      <th>{{ $t('common.list.data_table._actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="(item, index) in groups.data" :key="item.id">

                      <td>{{index + 1}}</td>
                      <td>{{item.name}}</td>
                         <td>{{item.users_count}}</td>
                         <td style="width:160px">
                             <div class="dropdown">
                                 <i
                                     class="fa fa-ellipsis-v"
                                     id="operatingAction"
                                     data-toggle="dropdown"
                                     aria-haspopup="true"
                                     aria-expanded="false"
                                 ></i>
                                 <div class="dropdown-menu" aria-labelledby="operatingAction">
                                     <router-link :to="{name:'users_group', params: { id: item.id }}"  class="dropdown-item text-primary">{{ $t('group.list.data_table.actions._act_add_user')}}</router-link>
                                     <router-link v-if="!(item.forced)"  :to="{name:'edit_group', params: { id: item.id }}" class="dropdown-item text-primary">{{ $t('group.list.data_table.actions._act_edit')}}</router-link>
                                     <a v-if="!(item.forced)" class="dropdown-item text-danger" href="#" @click="deleteGroup(item.id)">{{ $t('group.list.data_table.actions._act_remove')}}</a>
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

      <div v-else>
          <not-found></not-found>
      </div>
  </section>
</template>

<script>
    export default {
        data () {
            return {
              groups : [],
                paginator:{}
            }
        },

        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                axios.get('/api/group?page=' + page)
                    .then((response)=>{this.groups = response.data; this.paginator = response.data.meta});
                this.$Progress.finish();
            },

          loadGroup(){
            if(this.$gate.isRoot()){
              axios.get("/api/group").then( (response)=>{this.groups = response.data; this.paginator = response.data.meta});
            }
          },

            deleteGroup(id){
              if (id >3){
                  var temp = Swal.fire({
                    title: this.$t('group.others._remove_modal_title'),
                    text: this.$t('group.others._remove_modal_description'),
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: this.$t('group.others._remove_modal_yes'),
                    cancelButtonText: this.$t('group.others._remove_modal_no'),
                }).then((result) => {
                  console.log(result);
                    // Send request to the server
                    if (result.value) {
                        axios.delete('/api/group/'+id).then(()=>{
                            Toast.fire({
                                icon:"success",
                                title: this.$t('group.messages._update_success'),
                            });
                            // Fire.$emit('AfterCreate');
                            this.loadGroup();
                        }).catch((data)=> {
                            Toast.fire({
                                icon:"error",
                                title: data.message
                            })
                        });
                    }
                })
              }else{
                  Toast.fire({
                      title:this.$t(group.popup._cannot_do_this_action),
                      icon:"error"
                  });
              }
            },

        },
        mounted() {

        },
        created() {
            this.$Progress.start();
            this.loadGroup();
            this.$Progress.finish();
        }
    }
</script>
<style scoped>
tr th:last-child{text-align: right;padding-right: 1.25rem;}
      .dropdown .fa, .dropdown .material-icons {
          color: #c3c7cc;
          margin-right: 1.25rem;
          float: right;
      }
    .table-hover th{font-weight: 200;font-size:13px}
    .dropdown-menu{border-radius: 0}
    .dropdown-item{font-weight: normal; font-size: 11px;line-height: 13px}
</style>>
