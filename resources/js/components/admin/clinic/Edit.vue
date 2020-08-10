<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('app.notification_management') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <label class="pt-2 mr-4">{{ $t('app.save_draft')}}</label>
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
                      <div class="col-12">
                        <label>{{ $t('app.notice_information')}}</label>
                      </div>
                    </div>
                    <hr class="mt-2 mb-4" />

                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('app.title_info')}}
                            <span class="text-danger">*</span>
                          </label>
                          <input
                            type="text"
                            class="form-control"
                            :placeholder="$t('app.please_enter_title')"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('app.target_audience')}}
                            <span class="text-danger">*</span>
                            <br />
                            <small>{{ $t('app.target_help')}}</small>
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            :placeholder="$t('app.please_enter_target')"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('app.notice_content')}}</label>
                          <input
                            type="text"
                            class="form-control"
                            :placeholder="$t('app.please_enter_title')"
                          />
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
