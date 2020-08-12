<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('app.clinic.header.create') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <label class="pt-2 mr-4">{{ $t('app.btn.create')}}</label>
        <button type="button" class="btn btn-primary pl-5 pr-5">{{ $t('app.btn.create')}}</button>
      </div>
    </div>
    <!-- End Page Header -->

      <div class="row page-filter">
          <div class="col-12 col-sm-8 offset-sm-2">
              <div class="card card-small mb-3">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-sm-6 col-12">
                              <div class="form-group">
                                  <label for="feInputTitle">aa</label>
                                  <select class="form-control" v-model="form_filter.role">
                                      <option value="">11</option>
                                      <option v-for="(role, index) in roles" :key="index" :value="role">{{ role }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-6 col-12">
                              <div class="form-group">
                                  <label for="feInputTitle">bbb</label>
                                  <input :placeholder="$t('manager.form_filter.placeholder_input_keyword')" v-model="form_filter.keyword" type="text" class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 text-center">
                              <button @click="clearFilter()" type="button" class="mb-2 btn btn-outline-dark mr-2">{{ $t('manager.form_filter.button_clear') }}</button>
                              <button @click="searchUser()" type="button" class="mb-2 btn btn-outline-info">{{ $t('manager.form_filter.button_search') }}</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row table-list">
          <div class="col-12 col-sm-12">
              <div class="card card-small mb-4">
                  <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                          <thead class="bg-light">
                          <tr>
                              <th scope="col" class="border-0">#</th>
                              <th scope="col" class="border-0">{{ $t('manager.table.name') }}</th>
                              <th scope="col" class="border-0">{{ $t('manager.table.email') }}</th>
                              <th scope="col" class="border-0">{{ $t('manager.table.group') }}</th>
                              <th scope="col" class="border-0">{{ $t('manager.table.register_date') }}</th>
                              <th scope="col" class="border-0">{{ $t('manager.table.last_login') }}</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr v-for="(item, index) in users.data" :key="index">
                              <td>{{ index + 1 }}</td>
                              <td>{{ item.name }}</td>
                              <td>{{ item.email }}</td>
                              <td>{{ item.group }}</td>
                              <td>{{ item.created_at }}</td>
                              <td>{{ item.created_at }}</td>
                              <td>-</td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="card-footer">
                      <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
      users: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      console.log("get Results");
      axios
        .get("/api/users?page=" + page)
        .then(({ data }) => (this.users = data.data));

      this.$Progress.finish();
    },
    loadUsers() {
      this.$Progress.start();
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/users")
          .then(({ data }) => (this.users = data.data));
      }
      this.$Progress.finish();
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.$Progress.start();
    this.loadUsers();
    this.$Progress.finish();
  },
};
</script>
