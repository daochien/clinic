<template>
<div class="main-wrapper">
    <div class="page-content">
        <div class="container">
            <SideBar :with-cate-id="page.category_id" />
            <div class="blog-content content-wrapper">
                <h2>
                    {{ page.title }}
                </h2>
                <div class="blog-meta">
                    <a href="#">{{ page.categorys ? page.categorys.name : '' }}</a>
                    <span class="date">{{ page.created_at | dateFormat }}</span>
                </div>                
                <div class="blog-main-img" v-show="page.image">
                    <img :src="page.image" alt="news detail">
                </div>
                <div class="blog-detail-content" v-html="page.content">
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import SideBar from './SideBar';
export default {
    components: {
        SideBar
    },
    data() {
        return {
            manuals: [],
            categories: [],
            page: {}
        }
    },    
    created() {
        
    },
    mounted() {        
        this.loadPage();
    },
    methods: {        
        loadPage() {
            
            axios.get("/api/page/" + this.$route.params.id)
                .then(({data}) => {
                    if (data.data) {                        
                        this.page = data.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
                
    }
}
</script>
