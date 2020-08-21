<template>
  <section class="content" v-if="$gate.isAdmin() && this.notification_id != undefined">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('notification.details_information') }}</h3>
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
                          <label>{{ $t('notification.clinic')}}</label>
                          <select class="form-control" id="clinic">
                            <option
                              v-for="(entity) in clinics"
                              :key="entity.id"
                              :v-model="form.clinics"
                            >{{ entity.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('notification.keyword')}}</label>
                          <select class="form-control" id="status">
                            <option
                              :v-model="form.status"
                              value="0"
                            >{{ $t('notification.all_status')}}</option>
                            <option :v-model="form.status" value="1">{{ $t('notification.un_read')}}</option>
                            <option
                              :v-model="form.status"
                              value="2"
                            >{{ $t('notification.already_read')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('notification.keyword')}}</label>
                          <input
                            type="text"
                            class="form-control"
                            :v-model="form.keyword"
                            :placeholder="$t('notification.keyword_placeholder')"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-6 text-right">
                        <button
                          type="reset"
                          class="btn btn-outline-secondary pl-4 pr-4"
                          @click="resetForm()"
                        >{{ $t('notification.clear_condition')}}</button>
                      </div>
                      <div class="col-6">
                        <button
                          type="button"
                          class="btn btn-outline-primary pl-4 pr-4"
                          @click="searchData()"
                        >{{ $t('notification.search_condition')}}</button>
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
            <div class="card-body p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('notification.username')}}</th>
                    <th scope="col">{{ $t('notification.mail_address')}}</th>
                    <th scope="col">{{ $t('notification.profession')}}</th>
                    <th scope="col">{{ $t('notification.clinic')}}</th>
                    <th scope="col">{{ $t('notification.status')}}</th>
                    <th scope="col">{{ $t('notification.confirm_date_and_time')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(entity, index) in members.data" :key="entity.id">
                    <td>{{ index }}</td>
                    <td>{{ entity.user.name }}</td>
                    <td>{{ entity.user.email }}</td>
                    <td>
                      <div v-if="entity.user.group.length !== 0">
                        <span
                          class="badge badge-info ml-1"
                          v-for="group in entity.user.group"
                          :key="'sc_' + group.id"
                        >{{ group.name}}</span>
                      </div>
                      <div v-else>-</div>
                    </td>
                    <td>
                      <div v-if="entity.user.clinic.length !== 0">
                        <span
                          class="badge badge-info ml-1"
                          v-for="clinic in entity.user.clinic"
                          :key="'sc_' + clinic.id"
                        >{{ clinic.name}}</span>
                      </div>
                      <div v-else>-</div>
                    </td>
                    <td>
                      <div v-if="entity.notification.confirm == true">
                        <span
                          v-if="entity.user_status.status == 1"
                          class="text-secondary"
                        >{{ $t('notification.un_read') }}</span>
                        <span
                          v-else-if="entity.user_status.status == 2"
                          class="text-primary"
                        >{{ $t('notification.already_read') }}</span>
                        <span v-else>-</span>
                      </div>
                      <div v-else>-</div>
                    </td>
                    <td>
                      <div v-if="entity.notification.confirm == true">
                        <span
                          v-if="entity.user_status.status == 1"
                          class="text-secondary"
                        >{{ $t('notification.no_read_date') }}</span>
                        <span
                          v-else-if="entity.user_status.status == 2"
                          class="text-primary"
                        >{{ entity.user_status.updated_at }}</span>
                        <span v-else>-</span>
                      </div>
                      <div v-else>-</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      members: {},
      clinics: {},
      notification_id: 0,
      form: new Form({
        clinics: [],
        keyword: "",
        status: 0,
      }),
    };
  },
  methods: {
    resetForm() {
      this.isValidate = false;
      this.form = new Form({
        groups: [],
        keyword: "",
        status: 0,
      });
    },
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
        axios
          .get("/api/group/all")
          .then(({ data }) => (this.groups = data.data));
      }
      this.$Progress.finish();
    },
    loadClinic() {
      axios.get("/api/clinic/all").then((response) => {
        this.clinics = response.data.data;
      });
    },
    searchData() {},
  },
  mounted() {
    console.log("mounted");
  },
  created() {
    this.$Progress.start();
    console.log("created");
    this.notification_id = this.$route.params.id;
    this.loadNotification();
    this.loadClinic();
    this.$Progress.finish();
  },
};
</script>
