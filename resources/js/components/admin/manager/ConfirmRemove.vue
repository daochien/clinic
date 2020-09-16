<template>
    <div class="modal fade" id="removeAdmin" tabindex="-1" role="dialog" aria-labelledby="removeAdmin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $t('admin.others._remove_modal_title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>{{ $t('admin.others._remove_modal_description') }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('admin.others._remove_modal_no') }}</button>
                    <button type="submit" class="btn btn-salmon" @click="remove()">{{ $t('admin.others._remove_modal_yes') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: Number
    },
    data () {
        return {

        }
    },
    methods: {
        remove () {
            this.$Progress.start();
            axios.delete('/api/manager/'+this.id)
            .then( (data) => {
                if(data.data.status) {
                    this.$emit('remove-success', true);
                    Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                    this.$Progress.finish();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('admin.list.messages._remove_failed')
                    });

                    this.$Progress.failed();
                }
            })
            .catch(()=>{
                Toast.fire({
                    icon: 'error',
                    title: this.$t('common.messages._system_err')
                });
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
