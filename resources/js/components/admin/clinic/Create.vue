<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4" v-if="$gate.canPermission('clinic.store')">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('clinic.info._page_title_create') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <button type="button" class="btn btn-primary pl-5 pr-5" @click="create()">{{ $t('clinic.info.others._btn_create')}}</button>
      </div>
    </div>
    <!-- End Page Header -->
    <div class="container-fluid">
      <div class="row mb-5" v-if="$gate.canPermission('clinic.store')">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form v-on:submit="saveForm()">
                    <div class="row">
                      <div class="col-12">
                        <label>{{ $t('clinic.info.form._form_title')}}</label>
                      </div>
                    </div>
                    <hr class="mt-2 mb-4" />

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>
                            {{ $t('clinic.attr._name')}}
                            <span class="text-danger">*</span>
                          </label>
                            <input v-model="form.name" type="text" name="name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                   :placeholder="$t('clinic.info.form._name_pl')">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label>
                            {{ $t('clinic.attr._zip_code')}}
                            <br />
                          </label>
                            <input v-model="form.post_code" type="text" name="post_code"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('post_code') }"
                                   :placeholder="$t('clinic.info.form._zip_code_pl')">
                            <has-error :form="form" field="post_code"></has-error>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('clinic.attr._address')}}
                            <span class="text-danger">*</span>
                            <br />
                          </label>
                            <input v-model="form.address" type="text" name="address"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"
                                   :placeholder="$t('clinic.info.form._address_pl')">
                            <has-error :form="form" field="address"></has-error>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('clinic.attr._memo')}}</label>
                            <textarea rows="12" v-model="form.description" name="description"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"
                                   :placeholder="$t('clinic.info.form._memo_pl')">
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

      <div v-if="!$gate.canPermission('clinic.store')">
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
                          title: this.$t('clinic.info.messages._create_failed')
                      });

                      this.$Progress.failed();
                  }
              })
              .catch(()=>{
                  Toast.fire({
                      icon: 'error',
                      title: this.$t('common.messages._system_err')
                  });
              })
      },
  },
};
</script>
