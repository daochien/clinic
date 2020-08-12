<template>
    <tr>
        <td class="text-capitalize">{{dataRoute.name}}</td>
        <td class="text-capitalize">
            <div class="custom-control custom-checkbox mr-4 float-left">
                <input
                type="checkbox"
                :class="['custom-control-input']"
                :id="'checkbox_all_'+idx"
                v-model="selectAll"
                >
                <label class="custom-control-label" :for="'checkbox_all_'+idx"></label>
            </div>
        </td>
        <td class="text-capitalize">
            <div v-for="(item, index) in dataRoute.groups" :key="index">
                <div class="custom-control custom-checkbox mr-4 float-left" v-if="index == 'view'">
                    <input
                    type="checkbox"
                    :class="['custom-control-input']"
                    :id="'checkbox_view_'+idx"
                    v-model="selected"
                    :value="item.route_name"
                    >
                    <label class="custom-control-label" :for="'checkbox_view_'+idx"></label>
                </div>
            </div>
        </td>
        <td class="text-capitalize">
            <div v-for="(item, index) in dataRoute.groups" :key="index">
                <div class="custom-control custom-checkbox mr-4 float-left" v-if="index == 'create'">
                    <input
                    type="checkbox"
                    :class="['custom-control-input']"
                    :id="'checkbox_create_'+idx"
                    v-model="selected"
                    :value="item.route_name"
                    >
                    <label class="custom-control-label" :for="'checkbox_create_'+idx"></label>
                </div>
            </div>
        </td>
        <td class="text-capitalize">
            <div v-for="(item, index) in dataRoute.groups" :key="index">
                <div class="custom-control custom-checkbox mr-4 float-left" v-if="index == 'update'">
                    <input
                    type="checkbox"
                    :class="['custom-control-input']"
                    :id="'checkbox_update_'+idx"
                    v-model="selected"
                    :value="item.route_name"
                    >
                    <label class="custom-control-label" :for="'checkbox_update_'+idx"></label>
                </div>
            </div>
        </td>
        <td class="text-capitalize">
            <div v-for="(item, index) in dataRoute.groups" :key="index">
                <div class="custom-control custom-checkbox mr-4 float-left" v-if="index == 'delete'">
                    <input
                    type="checkbox"
                    :class="['custom-control-input']"
                    :id="'checkbox_destroy_'+idx"
                    v-model="selected"
                    :value="item.route_name"
                    >
                    <label class="custom-control-label" :for="'checkbox_destroy_'+idx"></label>
                </div>
            </div>
        </td>
</tr>
</template>
<script>
export default {
    props: {
        dataRoute: Object,
        idx: String,


    },
    data () {
        return {
            selected: [],
        }
    },
    created () {

    },

    computed : {
        selectAll: {
            get: function () {
                return this.dataRoute.groups ? this.selected.length == Object.keys(this.dataRoute.groups).length : false;
            },
            set: function (value) {
                var selected = [];

                if (value) {
                    let that = this;
                    Object.entries(this.dataRoute.groups).forEach(([key, value]) => {
                        selected.push(value.route_name);
                    });
                }

                this.selected = selected;
            }
        }
    },
    watch: {
        selected (val, oldVal) {
            this.$emit('select-permission', {
                type: this.idx,
                pers: val
            })
        }
    },
    methods: {

    }
}
</script>
<style lang="scss" scoped>

</style>
