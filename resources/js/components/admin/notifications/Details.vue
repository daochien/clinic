<template>
  <section class="content" v-if="$gate.isAdmin() && this.notification_id != undefined">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('app.details_information') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0"></div>
    </div>
    <!-- End Page Header -->
    <div class="container-fluid">
      <div class="row mb-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('app.clinic')}}</label>
                          <select class="form-control" id="clinic">
                            <option
                              v-for="(entity) in groups.data"
                              :key="entity.id"
                            >{{ entity.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('app.keyword')}}</label>
                          <select class="form-control" id="status">
                            <option>{{ $t('app.all_status')}}</option>
                            <option>{{ $t('app.un_read')}}</option>
                            <option>{{ $t('app.already_read')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('app.keyword')}}</label>
                          <input
                            type="text"
                            class="form-control"
                            :placeholder="$t('app.keyword_placeholder')"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-6 text-right">
                        <button
                          type="reset"
                          class="btn btn-outline-secondary pl-4 pr-4"
                        >{{ $t('app.clear_condition')}}</button>
                      </div>
                      <div class="col-6">
                        <button
                          type="button"
                          class="btn btn-outline-primary pl-4 pr-4"
                        >{{ $t('app.search_condition')}}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('app.username')}}</th>
                    <th scope="col">{{ $t('app.mail_address')}}</th>
                    <th scope="col">{{ $t('app.profession')}}</th>
                    <th scope="col">{{ $t('app.clinic')}}</th>
                    <th scope="col">{{ $t('app.status')}}</th>
                    <th scope="col">{{ $t('app.confirm_date_and_time')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(entity, index) in members.data" :key="entity.id">
                    <td>{{ index }}</td>
                    <td>{{ entity.name }}</td>
                    <td>{{ entity.email }}</td>
                    <td></td>
                    <td></td>
                    <td>
                      <label class="text-secondary" v-if="entity.draft === 1">{{ $t('app.un_read')}}</label>
                      <label class="text-warning" v-else>{{ $t('app.already_read')}}</label>
                    </td>
                    <td>
                      <label v-if="entity.updated_at != null">{{ entity.updated_at }}</label>
                      <label v-else>{{ $t('app.no_read_date')}}</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination :data="members" @pagination-change-page="getResults"></pagination>
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
  data() {
    return {
      editmode: false,
      members: {},
      groups: {},
      notification_id: 0,
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      console.log("get Results");
      axios
        .get(
          "/api/notification/" + this.notification_id + "/members?page=" + page
        )
        .then(({ data }) => (this.members = data.data));

      this.$Progress.finish();
    },
    loadNotification() {
      this.$Progress.start();
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/notification/" + this.notification_id + "/members")
          .then(({ data }) => (this.members = data.data));
        axios.get("/api/group").then(({ data }) => (this.groups = data.data));
      }
      this.$Progress.finish();
    },
  },
  mounted() {
    console.log("mounted");
  },
  created() {
    this.$Progress.start();
    console.log("created");
    this.notification_id = this.$route.params.id;
    this.loadNotification();
    this.$Progress.finish();
  },
};
</script>
