<template>
  <section class="content">
    <div class="container-fluid" v-if="$gate.canPermission('group.store')">

        <div class="page-header row no-gutters py-4">
            <div class="col-6 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('group.info._page_title_create')}}</h3>
            </div>
            <div class="col-6 text-center text-sm-right mb-0">
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" @click="createGroup()">
                        {{ $t('group.info.others._btn_create')}}
                    </button>
                </div>
            </div>
        </div>

        <div class="row">

          <div class="col-8 offset-2">

            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $t('group.info.form._subtitle')}}</h6>
                </div>
              <!-- /.card-header -->
              <div class="card-body  p-4">
                  <form>
                      <div class="row">
                          <div class="form-group col-12">
                              <label>{{ $t('group.attr._name')}} <span class="text-danger">*</span></label>
                              <input v-model="form.name" type="text" name="name"
                                     :placeholder="$t('group.info.form._name_pl')"
                                     class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                              <has-error :form="form" field="name"></has-error>
                          </div>

                      </div>

                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">{{ $t('group.attr._memo')}}</label>
                          <textarea v-model="form.description"
                                    :placeholder="$t('group.info.form._memo_pl')"
                                    name="description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" id="exampleFormControlTextarea1" rows="6"></textarea>
                          <has-error :form="form" field="description"></has-error>
                      </div>

                  </form>
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
              group : {},
              // Create a new form instance
              form: new Form({
                  name: '',
                  description: '',
                  forced: 0
              })
            }
        },
        methods: {
          createGroup(){
              this.$Progress.start();

              this.form.post('/api/group')
              .then((data)=>{
                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.$router.push({ path: '/admin/group' });
              })
              .catch(()=>{
                  Toast.fire({
                      icon: 'error',
                      title: this.$t('common.messages._system_err')
                  });
              })
          }

        },
        mounted() {

        },
        created() {

        }
    }
</script>
<style scoped>
    .table-hover th{font-weight: 200;font-size:13px}
    .dropdown-menu{border-radius: 0}
    .dropdown-item{font-weight: normal; font-size: 11px;line-height: 13px}
</style>>
