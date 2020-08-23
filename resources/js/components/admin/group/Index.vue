<template>
  <section class="content">
    <div class="container-fluid">

        <div class="page-header row no-gutters py-4">
            <div class="col-6 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('group.group_list')}}</h3>
            </div>
            <div class="col-6 text-center text-sm-right mb-0">
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
                      <th>{{ $t('group.description')}}</th>
                      <th>{{ $t('group.number_staff')}}</th>
                      <th>{{ $t('group.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="item in group.data" :key="item.id">

                      <td>{{item.id}}</td>
                      <td>{{item.name}}</td>
                      <td>{{item.description}}</td>
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
                                     <router-link v-if="(item.id>3)"  :to="{name:'edit_group', params: { id: item.id }}" class="dropdown-item text-primary">{{ $t('group.edit_group_info')}}</router-link>
                                     <a v-if="(item.id>3)" class="dropdown-item text-danger" href="#" @click="deleteGroup(item.id)">{{ $t('group.remove_group')}}</a>
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
          loadGroup(){
            if(this.$gate.isAdmin()){
              axios.get("/api/group").then(({ data }) => (this.group = data.data));
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
              }
            },

          createCategory(){
              this.$Progress.start();

              this.form.post('/api/category')
              .then((data)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadCategories();

              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          }

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
