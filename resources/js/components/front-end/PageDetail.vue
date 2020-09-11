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
                        <a :href="manual.files" target="blank">
                            <span class="title">{{ manual.short_title}}</span>
                            <span class="info">1.5mb <img src="/front-end/images/download-icon-2.png" alt=""></span>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            </aside>
            <div class="blog-content content-wrapper">
            <h2>Blog detail title Blog detail title Blog detail title Blog detail title Blog detail title </h2>
            <span class="date">05/08/2020</span>
            <div class="blog-main-img">
                <img src="/front-end/images/news-detail.jpg" alt="news detail">
            </div>
            <div class="blog-detail-content">

                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
                <p>今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！</p>
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
        }
    },
    created () {

    },
    mounted () {
        this.loadCategorys();
        this.loadManualLatest();
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
    }
}
</script>
