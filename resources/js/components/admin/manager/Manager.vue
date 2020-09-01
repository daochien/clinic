<template>
    <div class="page-create-manager">
        
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
