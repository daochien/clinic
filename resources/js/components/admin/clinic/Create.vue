<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('app.clinic.header.create') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <button type="button" class="btn btn-primary pl-5 pr-5" @click="create()">{{ $t('app.btn.create')}}</button>
      </div>
    </div>
    <!-- End Page Header -->
    <div class="container-fluid">
      <div class="row mb-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form v-on:submit="saveForm()">
                    <div class="row">
                      <div class="col-12">
                        <label>{{ $t('app.clinic.header.info')}}</label>
                      </div>
                    </div>
                    <hr class="mt-2 mb-4" />

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>
                            {{ $t('app.clinic.name')}}
                            <span class="text-danger">*</span>
                          </label>
                            <input v-model="form.name" type="text" name="name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                   :placeholder="$t('app.clinic.place_holder.name')">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label>
                            {{ $t('app.clinic.post_code')}}
                            <br />
                          </label>
                            <input v-model="form.post_code" type="text" name="post_code"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('post_code') }"
                                   :placeholder="$t('app.clinic.place_holder.post_code')">
                            <has-error :form="form" field="post_code"></has-error>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('app.clinic.address')}}
                            <span class="text-danger">*</span>
                            <br />
                          </label>
                            <input v-model="form.address" type="text" name="address"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"
                                   :placeholder="$t('app.clinic.place_holder.address')">
                            <has-error :form="form" field="address"></has-error>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('app.clinic.description')}}</label>
                            <textarea rows="12" v-model="form.description" name="description"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            </textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="!$gate.isAdmin()">
        <not-found></not-found>
      </div>
    </div>
  </section>
</template>

<script>

export default {
  data() {
    return {
      editmode: false,
      clinic: {},
        form: new Form({
            name: '',
            post_code: '',
            address: '',
            description: '',
        }),
    };
  },
  methods: {
      create(){
          this.$Progress.start();
          this.form.post('/api/clinic')
              .then((data)=>{
                  if(data.data.success){
                      Toast.fire({
                          icon: "success",
                          title: data.data.message,
                      });
                      this.$router.push("/admin/clinic")
                      this.$Progress.finish();

                  } else {
                      Toast.fire({
                          icon: 'error',
                          title: 'Some error occured! Please try again'
                      });

                      this.$Progress.failed();
                  }
              })
              .catch(()=>{
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
      },
  },
};
</script>
