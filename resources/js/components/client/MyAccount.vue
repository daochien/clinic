<template>
    <div class="main-wrapper">
        <div class="page-title center">
            <div class="container">
                マイ・アカウント
            </div>
        </div>
        <div class="page-content white-content">
            <div class="container">
                <form action="" class="login-form">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email" class="form-control email" disabled="disabled" :value="manager.email">
                    </div>
                    <div class="form-group">
                        <label for="current_password" class="control-label">{{ $t('admin.my_account.change_password._current_pass') }}</label>
                        <input type="password"
                               v-model="manager.current_password"
                               class="form-control password"
                               id="current_password"
                               :class="{ 'is-invalid': manager.errors.has('current_password') }"
                        >
                        <has-error :form="manager" field="current_password"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="control-label">{{ $t('admin.my_account.change_password._new_pass') }}</label>
                        <input type="password"
                               v-model="manager.new_password"
                               class="form-control password"
                               id="new_password"
                               :class="{ 'is-invalid': manager.errors.has('new_password') }"
                        >
                        <has-error :form="manager" field="new_password"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="control-label">{{ $t('admin.my_account.change_password._verify_pass') }}</label>
                        <input type="password"
                               v-model="manager.confirm_password"
                               class="form-control password"
                               id="confirm_password"
                               :class="{ 'is-invalid': manager.errors.has('confirm_password') }"
                        >
                        <has-error :form="manager" field="confirm_password"></has-error>
                    </div>
                    <button @click.prevent="updatePassword" type="submit" class="btn btn-login">{{ $t('admin.my_account._btn_update') }}</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {
    },
    data(){
        return {
            manager: new Form({
                email: '',
                password: '',
            }),
            isEdit: true,
            roles: [],
        }
    },
    created() {
        this.$Progress.start();
        axios.get("/api/profile")
            .then(({ data }) => (this.manager.fill(data.data)));
        this.$Progress.finish();
    },
    mounted() {

    },
    methods: {
        updatePassword(){
            this.$Progress.start();
            this.manager.post('/api/change-my-password')
                .then((data)=>{
                    //  Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    this.manager.current_password = '';
                    this.manager.new_password = '';
                    this.manager.confirm_password = '';

                    Toast.fire({
                        icon: 'success',
                        title: this.$t('admin.my_account.change_password._password_changed')
                    });
                })
                .catch(() => {
                    this.$Progress.fail();

                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.my_account.change_password._password_update_failed')
                    });
                });
        },
    }
}
</script>

