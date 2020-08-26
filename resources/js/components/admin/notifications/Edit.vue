<template>
  <section class="content">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
        <h3 class="page-title">{{ $t('notification.notification_management') }}</h3>
      </div>
      <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
        <label class="pt-2 mr-4">{{ $t('notification.save_draft')}}</label>
        <button
          type="button"
          class="btn btn-primary pl-5 pr-5"
          @click="saveNotification()"
        >{{ $t('notification.singup')}}</button>
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
                        <label>{{ $t('notification.notice_information')}}</label>
                      </div>
                    </div>
                    <hr class="mt-2 mb-4" />

                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('notification.title_info')}}
                            <span class="text-danger">*</span>
                          </label>
                          <input
                            type="text"
                            class="form-control"
                            :placeholder="$t('notification.please_enter_title')"
                            v-model="form.title"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>
                            {{ $t('notification.target_audience')}}
                            <span class="text-danger">*</span>
                            <br />
                            <small>{{ $t('notification.target_help')}}</small>
                          </label>
                          <multiselect
                            v-model="form.groups"
                            :options="groups"
                            :multiple="true"
                            :disabled="!enable_manual"
                            label="name"
                            track-by="id"
                            :placeholder="$t('notification.please_enter_target')"
                          ></multiselect>
                        </div>
                        <div class="form-group row ml-0">
                          <label class="col-form-label">{{ $t('notification.release_date')}}</label>
                          <div class="col-sm-3">
                            <datetime format="YYYY/MM/DD H:i" v-model="form.schedule_date"></datetime>
                          </div>
                          <div class="col-sm-1"></div>
                          <div class="col-sm-1 mr-2">
                            <b-form-checkbox v-model="default_dr" name="check-button">DR</b-form-checkbox>
                            <b-form-checkbox v-model="default_dh" name="check-button">DH</b-form-checkbox>
                          </div>
                          <div class="col-sm-2">
                            <b-form-checkbox
                              v-model="form.confirm"
                              name="check-button"
                              switch
                            >Enable Confirm</b-form-checkbox>
                            <b-form-checkbox
                              v-model="enable_manual"
                              name="check-button"
                              switch
                            >Enable Manual</b-form-checkbox>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ $t('notification.notice_content')}}</label>
                          <vue-editor
                            v-model="form.content"
                            class="form-control"
                            :placeholder="$t('notification.please_enter_title')"
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
import Multiselect from "vue-multiselect";
import datetime from "vuejs-datetimepicker";

export default {
  components: {
    Multiselect,
    datetime,
  },
  data() {
    return {
      editmode: false,
      isValidate: false,
      form: new Form({
        notification_id: 0,
        title: "",
        groups: [],
        content: "",
        confirm: false,
        draft: false,
        schedule_date: "",
      }),
      groups: [],
      enable_manual: false,
      default_dr: true,
      default_dh: true,
    };
  },
  watch: {
    default_dr: function () {
      var drGroup = this.form.groups.filter((e) => e.id == 1);
      if (drGroup.length == 0 && this.default_dr) {
        this.form.groups.push(this.groups[0]);
      } else if (drGroup.length > 0 && !this.default_dr) {
        console.log(drGroup);
        this.form.groups.splice(this.form.groups.indexOf(drGroup[0]), 1);
      }
    },
    default_dh: function () {
      var dhGroup = this.form.groups.filter((e) => e.id == 2);
      if (dhGroup.length == 0 && this.default_dh) {
        this.form.groups.push(this.groups[1]);
      } else if (dhGroup.length > 0 && !this.default_dh) {
        this.form.groups.splice(this.form.groups.indexOf(dhGroup[0]), 1);
      }
    },
  },
  methods: {
    resetForm() {
      this.isValidate = false;
      this.form = new Form({
        notification_id: 0,
        title: "",
        groups: [],
        content: "",
        confirm: false,
        draft: false,
        schedule_date: "",
      });
    },
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
      this.form.groups = [];
      if (this.$gate.isAdmin()) {
        axios.get("/api/group/default").then(({ data }) => {
          this.groups = data.data;
          if (
            this.form.notification_id <= 0 ||
            this.form.notification_id == undefined
          ) {
            this.form.groups.push(this.groups[0]);
            this.form.groups.push(this.groups[1]);
          }
        });
      }
      if (this.form.notification_id > 0) {
        axios
          .get("/api/notification/" + this.form.notification_id + "/show")
          .then(({ data }) => {
            this.form.title = data.data.title;
            this.form.content = data.data.content;
            this.form.draft = data.data.draft;
            this.form.schedule_date = data.data.schedule_date;
            if (data.data.confirm == 1) {
              this.form.confirm = true;
            } else {
              this.form.confirm = false;
            }
            data.data.notification_groups.forEach((item) => {
              this.form.groups.push(item.group);
            });

            var drGroup = this.form.groups.filter((e) => e.id == 1);
            if (drGroup.length == 0) {
              this.default_dr = false;
            } else {
              this.default_dr = true;
            }

            var dhGroup = this.form.groups.filter((e) => e.id == 2);
            if (dhGroup.length == 0) {
              this.default_dh = false;
            } else {
              this.default_dh = true;
            }
          });
      }
      this.$Progress.finish();
    },
    validateForm() {
      this.isValidate = true;
      if (this.form.title.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.$t("app").notification.require_title,
        });
        this.isValidate = false;
      }
      if (this.form.groups.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.$t("app").notification.require_group,
        });
        this.isValidate = false;
      }
      if (this.form.content.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.$t("app").notification.require_content,
        });
        this.isValidate = false;
      }
    },
    saveNotification() {
      this.validateForm();
      if (!this.isValidate) {
        return;
      }
      this.form
        .post("/api/notification/store")
        .then((data) => {
          Toast.fire({
            icon: "success",
            title: data.data.message,
          });
          this.$Progress.finish();
          this.resetForm();
          this.$router.push({ path: "/admin/notification" });
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: this.$t("app").notification.some_error,
          });
        });
    },
  },
  mounted() {
    console.log("Notification Component mounted.");
    $("#tj-datetime-input").addClass("form-control");
  },
  created() {
    this.$Progress.start();
    console.log("created");
    this.form.notification_id = this.$route.params.id;
    this.loadNotification();
    this.$Progress.finish();
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
