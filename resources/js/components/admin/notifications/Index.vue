<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('app.notifications') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <button type="button" class="btn btn-primary pl-5 pr-5">{{ $t('app.singup')}}</button>
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
                          <label>{{ $t('app.target_person')}}</label>
                          <select class="form-control" id="select1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-6">
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
                          type="button"
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
                    <th scope="col">{{ $t('app.title')}}</th>
                    <th scope="col">{{ $t('app.target_person')}}</th>
                    <th scope="col">{{ $t('app.total_number_diliveries')}}</th>
                    <th scope="col">{{ $t('app.exist_number')}}</th>
                    <th scope="col">{{ $t('app.number_people_confirm')}}</th>
                    <th scope="col">{{ $t('app.release_date')}}</th>
                    <th scope="col">{{ $t('app.status')}}</th>
                    <th scope="col">{{ $t('app.operating')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(entity, index) in notifications.data" :key="entity.id">
                    <td>{{ index }}</td>
                    <td>{{ entity.title }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ entity.created_at }}</td>
                    <td>
                      <label class="text-secondary" v-if="entity.draft === 1">{{ $t('app.publish')}}</label>
                      <label class="text-warning" v-else>{{ $t('app.unpublish')}}</label>
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
                          >{{ $t('app.publish_announcement')}}</a>
                          <a class="dropdown-item text-primary" href="#">{{ $t('app.edit')}}</a>
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
              <pagination :data="notifications" @pagination-change-page="getResults"></pagination>
            </div>
          </div>
          <!-- /.card -->
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
      notifications: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      console.log("get Results");
      axios
        .get("/api/notification?page=" + page)
        .then(({ data }) => (this.notifications = data.data));

      this.$Progress.finish();
    },
    loadNotification() {
      this.$Progress.start();
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/notification")
          .then(({ data }) => (this.notifications = data.data));
      }
      this.$Progress.finish();
    },
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
