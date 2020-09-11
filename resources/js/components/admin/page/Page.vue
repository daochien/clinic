<template>
    <div class="page-create-manager">
        <form-page :is-edit="isEdit" v-if="($gate.canPermission('page.store') && !isEdit) || ($gate.canPermission('page.update') && isEdit)"/>
        <div v-else>
            <not-found></not-found>
        </div>
    </div>
</template>

<script>
import FormPage from './FormPage.vue';

export default {
    components: {
        FormPage
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
