<template>
    <div class="page-create-manager">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ isEdit ? $t('manager.title_page_edit') : $t('manager.title_page_create') }}</h3>
            </div>
        </div>
        <form-manager :is-edit="isEdit"/>
    </div>
</template>

<script>
import FormManager from './FormManager.vue';

export default {
    components: {
        FormManager
    },
    data () {
        return {
            isEdit: this.$route.params.id ? true : false,
        }
    },

    created () {
        
    },

    methods: {
                        
    }

}
</script>

<style lang="scss" scoped>

</style>
