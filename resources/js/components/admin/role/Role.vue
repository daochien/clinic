<template>
    <div class="page-create-manager">        
        <form-role :is-edit="isEdit" />
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
