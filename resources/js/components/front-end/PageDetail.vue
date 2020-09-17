<template>
    <div class="main-wrapper">
        <div class="page-content">
        <div class="container">
            <aside>
            <div class="side-panel">
                <div class="side-header">
                <h3><img src="/front-end/images/question-icon.png" alt=""> よくある質問</h3>
                </div>
                <div class="side-content">
                    <div class="faq-block" v-for="(item, index) in categories" :key="index">
                        <a href="#">
                            <img :src="`/front-end/images/icon${index + 1}.png`" alt="">
                            {{ item.name }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="side-panel">
                <div class="side-header">
                <h3><img src="/front-end/images/download-icon.png" alt=""> マニュアル</h3>
                <a href="#">もっと見る</a>
                </div>
                <div class="side-content">
                <ul>
                    <li v-for="(manual, index) in manuals" :key="index">
                        <a href="javascript:void(0)" >
                            <span class="title">{{ manual.title}}</span>
                            <span class="info">{{ manual.files.size }} 
                                <img @click="downloadManual(manual)" src="/front-end/images/download-icon-2.png" alt="">
                            </span>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            </aside>
            <div class="blog-content content-wrapper">
            <h2>
                {{ page.title }}
            </h2>
            <span class="date">{{ page.created_at | dateFormat }}</span>
            <div class="blog-main-img">
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
export default {
    data () {
        return {
            manuals: [],
            categories: [],
            page: {}
        }
    },
    created () {

    },
    mounted () {
        this.loadCategorys();
        this.loadManualLatest();
        this.loadPage();
    },
    methods: {
        async loadCategorys () {
            this.$Progress.start();
            axios.get("/api/category/type/faq").then(({ data }) => (this.categories = data.data));
            this.$Progress.finish();
        },
        async loadManualLatest () {
            try {
                let {data} = await axios.get('/api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        loadPage () {
            axios.get("/api/page/"+this.$route.params.id)
            .then(({ data }) => {                
                if (data.data) {
                    this.page = data.data;                                        
                }
            })
            .catch((error) => {
                console.log(error);
            });
        },
        async downloadManual (manual) {
            if (manual.files.path) {
                try {
                    let {data} = await axios.put(`/api/page/${manual.id}/rating`, {
                        type: 'download'
                    });
                    if (data.status) {
                        window.open(
                            manual.files.path,
                            '_blank' // <- This is what makes it open in a new window.
                        );
                    }                    
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
}
</script>
