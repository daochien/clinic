<template>
  <section class="content" v-if="$gate.isAdmin()">
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
      <div class="row mt-5">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('app.clinic.name')}}</th>
                    <th scope="col">{{ $t('app.clinic.address')}}</th>
                    <th scope="col">{{ $t('app.clinic.users_count')}}</th>
                    <th scope="col">{{ $t('app.operating')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(entity, index) in clinics.data" :key="entity.id">
                    <td>{{ index + 1}}</td>
                    <td>
                      <router-link
                        :to="{ name: 'clinic_user', params: { id: entity.id }}"
                      >{{ entity.name }}</router-link>
                    </td>
                    <td>{{ entity.address }}</td>
                    <td>0</td>
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
                          <a
                            class="dropdown-item text-primary"
                            href="#"
                          >{{ $t('app.publish_announcement')}}</a>
                          <router-link
                            :class="'dropdown-item text-primary'"
                            :to="{ name: 'edit_notification', params: { id: entity.id }}"
                          >{{ $t('app.edit')}}</router-link>
                          <a class="dropdown-item text-danger" href="#">{{ $t('app.delete')}}</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination :data="clinics" @pagination-change-page="getResults"></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <div v-else>
    <not-found></not-found>
  </div>
</template>

<script>
export default {
    data () {
        return {
            clinics: [],
        }
    },
  methods: {
      loadClinic() {
      this.$Progress.start();
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/clinic")
          .then(({ data }) => (this.clinics = data.data));
      }
      this.$Progress.finish();
    },
  },
  mounted() {
  },
  created() {
    this.$Progress.start();
    this.loadClinic();
    this.$Progress.finish();
  },
};
</script>
