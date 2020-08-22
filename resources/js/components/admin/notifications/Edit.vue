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
                            <input type="date" class="form-control" v-model="form.schedule_date" />
                          </div>
                          <div class="col-sm-1"></div>
                          <div class="col-sm-2">
                            <b-form-checkbox
                              v-model="form.confirm"
                              name="check-button"
                              switch
                            >Enable Confirm</b-form-checkbox>
                          </div>
                          <div class="col-sm-1"></div>
                          <div class="col-sm-2">
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
                          <textarea
                            rows="15"
                            cols="50"
                            class="form-control"
                            :placeholder="$t('notification.please_enter_title')"
                            v-model="form.content"
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
export default {
  components: {
    Multiselect,
  },
  data() {
    return {
      editmode: false,
      isValidate: false,
      lang: {},
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
    };
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
        axios.get("/api/group/all").then(({ data }) => {
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
            console.log(this.form.groups);
            data.data.notification_groups.forEach((item) => {
              this.form.groups.push(item.group);
            });
          });
      }
      this.$Progress.finish();
    },
    validateForm() {
      this.isValidate = true;
      if (this.form.title.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.lang.ja.notification.require_title,
        });
        this.isValidate = false;
      }
      if (this.form.groups.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.lang.ja.notification.require_group,
        });
        this.isValidate = false;
      }
      if (this.form.content.length <= 0) {
        Toast.fire({
          icon: "error",
          title: this.lang.ja.notification.require_content,
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
            title: t("notification.some_error"),
          });
        });
    },
  },
  mounted() {
    console.log("Notification Component mounted.");
  },
  created() {
    this.$Progress.start();
    console.log("created");
    this.form.notification_id = this.$route.params.id;
    this.loadNotification();
    this.$Progress.finish();
    this.lang = this.$i18n._vm.messages;
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
