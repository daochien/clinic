<template>
  <section class="content" v-if="$gate.isAdmin()">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('notification.notifications') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <router-link
          :class="'btn btn-primary pl-5 pr-5'"
          :to="{ path: '/admin/notification/edit'}"
        >{{ $t('notification.singup')}}</router-link>
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
                  <form>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('notification.target_person')}}</label>
                          <select class="form-control" id="targetPerson">
                            <option v-for="(entity) in groups" :key="entity.id">{{ entity.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-6">
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
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('notification.release_date')}}</label>
                          <input type="date" class="form-control" :v-model="form.release_date" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ $t('notification.status')}}</label>
                          <select class="form-control" id="targetPerson">
                            <option
                              value="true"
                              :v-model="form.status"
                            >{{ $t('notification.publish')}}</option>
                            <option
                              value="false"
                              :v-model="form.status"
                            >{{ $t('notification.unpublish')}}</option>
                          </select>
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
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('notification.title')}}</th>
                    <th scope="col">{{ $t('notification.target_person')}}</th>
                    <th scope="col">{{ $t('notification.total_number_diliveries')}}</th>
                    <th scope="col">{{ $t('notification.exist_number')}}</th>
                    <th scope="col">{{ $t('notification.number_people_confirm')}}</th>
                    <th scope="col">{{ $t('notification.release_date')}}</th>
                    <th scope="col">{{ $t('notification.status')}}</th>
                    <th scope="col">{{ $t('notification.operating')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(entity, index) in notifications.data" :key="entity.id">
                    <td>{{ index }}</td>
                    <td>
                      <router-link
                        :to="{ name: 'details_notification', params: { id: entity.id }}"
                      >{{ entity.title }}</router-link>
                    </td>
                    <td>
                      <div v-for="target in entity.groups" :key="target.id">
                        <label>{{ target.group.name }}</label>
                      </div>
                    </td>
                    <td>{{ entity.users_count }}</td>
                    <td>{{ entity.users_read }}</td>
                    <td>
                      <label v-if="entity.confirm === 0">{{ entity.users_count}}</label>
                      <label v-else>{{ entity.users_confirm }}</label>
                    </td>
                    <td>{{ entity.created_at }}</td>
                    <td>
                      <label
                        class="text-secondary"
                        v-if="entity.draft === 0"
                      >{{ $t('notification.publish')}}</label>
                      <label class="text-warning" v-else>{{ $t('notification.unpublish')}}</label>
                    </td>
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
                          >{{ $t('notification.publish_announcement')}}</a>
                          <router-link
                            :class="'dropdown-item text-primary'"
                            :to="{ name: 'edit_notification', params: { id: entity.id }}"
                          >{{ $t('notification.edit')}}</router-link>
                          <a
                            class="dropdown-item text-danger"
                            href="#"
                          >{{ $t('notification.delete')}}</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination :data="notifications" @pagination-change-page="getResults"></pagination>
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
      notifications: {},
      groups: {},
      form: new Form({
        groups: [],
        keyword: "",
        release_date: "",
        status: false,
      }),
    };
  },
  methods: {
    resetForm() {
      this.isValidate = false;
      this.form = new Form({
        title: "",
        groups: [],
        keyword: "",
        release_date: "",
        status: false,
      });
    },
    getResults(page = 1) {
      this.$Progress.start();
      console.log("get Results");
      axios
        .get("/api/notification?page=" + page)
        .then(({ data }) => (this.notifications = data));

      this.$Progress.finish();
    },
    loadNotification() {
      this.$Progress.start();
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/notification")
          .then(({ data }) => (this.notifications = data));
        axios
          .get("/api/group/all")
          .then(({ data }) => (this.groups = data.data));
      }
      this.$Progress.finish();
    },
    editNotification() {
      this.$router.push({
        path: "/admin/notification/edit",
      });
    },
    searchData() {},
  },
  mounted() {
    console.log("Notification Component mounted.");
  },
  created() {
    this.$Progress.start();
    console.log("created");
    this.loadNotification();
    this.$Progress.finish();
  },
};
</script>
