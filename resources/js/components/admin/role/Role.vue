<template>
    <div class="page-create-manager">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('role.title_page') }}</h3>
            </div>
        </div>
        <form-role :is-edit="isEdit"/>
    </div>
</template>
<script>
import FormRole from './FormRole';
export default {
    components: {
        FormRole
    },
    data () {
        return {
            isEdit: this.$route.params.id ? true : false,
        }
    },
    created () {

    }
}
</script>
