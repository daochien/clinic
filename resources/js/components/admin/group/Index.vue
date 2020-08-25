<template>
  <section class="content">
    <div class="container-fluid">

        <div class="page-header row no-gutters py-4">
            <div class="col-6 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('group.group_list')}}</h3>
            </div>
            <div class="col-6 text-center text-sm-right mb-0" v-if="this.$gate.isRoot()">
                <div class="card-tools">
                        <router-link :to="{name:'add_group'}" class="btn btn-sm btn-primary">{{ $t('group.add_new')}}</router-link>
                </div>
            </div>
        </div>

        <div class="row">

          <div class="col-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{ $t('group.name')}}</th>
                      <th>{{ $t('group.number_staff')}}</th>
                      <th>{{ $t('group.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="(item, index) in group.data" :key="item.id">

                      <td>{{index + 1}}</td>
                      <td>{{item.name}}</td>
                         <td>{{item.group_users_count}}</td>
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
                                     <router-link :to="{name:'users_group', params: { id: item.id }}"  class="dropdown-item text-primary">{{ $t('group.user_in_group')}}</router-link>
                                     <router-link v-if="!(item.forced)"  :to="{name:'edit_group', params: { id: item.id }}" class="dropdown-item text-primary">{{ $t('group.edit_group_info')}}</router-link>
                                     <a v-if="!(item.forced)" class="dropdown-item text-danger" href="#" @click="deleteGroup(item.id)">{{ $t('group.remove_group')}}</a>
                                 </div>
                             </div>
                         </td>
                      <td>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="group" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

    </div>
  </section>
</template>

<script>
    export default {
        data () {
            return {
              group : {},
            }
        },

        methods: {
            getResults(page = 1) {
                this.$Progress.start();
                axios.get('/api/group?page=' + page)
                    .then(({data}) => {this.group = data.data});
                this.$Progress.finish();
            },

          loadGroup(){
            if(this.$gate.isRoot()){
              axios.get("/api/group").then(({ data }) => {this.group = data.data});
            }
          },

            deleteGroup(id){
              if (id >3){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                    if (result.value) {
                        axios.delete('/api/group/'+id).then(()=>{
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            this.loadGroup();
                        }).catch((data)=> {
                            Swal.fire("Failed!", data.message, "warning");
                        });
                    }
                })
              }else{
                  Swal.fire(
                      'Cannot do this Action!',
                      'Your cannot delete this group.',
                      'error'
                  );
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
    .table-hover th{font-weight: 200;font-size:13px}
    .dropdown-menu{border-radius: 0}
    .dropdown-item{font-weight: normal; font-size: 11px;line-height: 13px}
</style>>
