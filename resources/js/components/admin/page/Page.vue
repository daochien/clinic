<template>
    <div class="page-form-create">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">Create Page</h3>
            </div>
            <div class="col-12 col-sm-8 text-center text-sm-right mb-0">
                <button class="btn btn-primary float-right" style="font-size: 16px; width: 140px;" @click="createPost()">
                    Create New
                </button>                
            </div>
        </div>
        <page-form />        
    </div>
</template>
<script>
import PageForm from './PageForm';
export default {
    components: {
        PageForm
    }
}
</script>
