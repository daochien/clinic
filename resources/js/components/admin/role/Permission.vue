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
        <td class="text-capitalize"  v-for="(item, index) in dataRoute.groups" :key="index">
            <div>
                <div class="custom-control custom-checkbox mr-4 float-left">
                    <input
                    type="checkbox"
                    :class="['custom-control-input']"
                    :id="`checkbox_${idx}_${index}`"
                    v-model="selected"
                    :value="`${idx}.groups.${index}`"
                    >
                    <label class="custom-control-label" :for="`checkbox_${idx}_${index}`"></label>
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
        hasPers: Array
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
                let selected = [];

                if (value) {
                    
                    let that = this;
                    Object.entries(this.dataRoute.groups).forEach(([key, value]) => {                                               
                        selected.push(`${this.idx}.groups.${key}`);
                    });
                }

                this.selected = selected;
            }
        }
    },
    watch: {
        selected (val, oldVal) {
            // let unique = [...new Set(val)];
            this.$emit('select-permission', {
                type: this.idx,
                pers: val
            })
        },
        hasPers (val, oldVal) {
            let that = this;
            let selected = [];
            val.forEach ((item) => {
                Object.entries(this.dataRoute.groups).forEach(([key, value]) => {
                    //console.log(key, value.routes);
                    if (value.routes.indexOf(item) != -1) {
                        selected.push(`${that.idx}.groups.${key}`);
                    }                                               
                    
                });                
            });
            let unique = [...new Set(selected)];
            this.selected = unique;
        }
    },
    methods: {

    }
}
</script>
<style lang="scss" scoped>

</style>
