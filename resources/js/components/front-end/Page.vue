<template>
    <div class="main-wrapper">

        <div class="page-title">
            <div class="container">
            記事
            </div>
        </div>
        <div class="page-content">
            <div class="latest-news">
                <div class="container">
                    <div class="col col-left">
                        <h2>最新ニュース</h2>
                        <p>私たちはインフォームドコンセントを重視し、歯の悩みをお気軽に相談してもらえる歯医者を目指しています。</p>
                    </div>
                    <div class="col col-right">
                        <div class="news-slider" ref="slick">
                            <div class="news-slider-item" v-for="(blog, index) in blogs" :key="index" v-if="index < 5">
                                <router-link :to="{path: 'blogs/'+blog.id}">
                                    <img :src="blog.image" alt="">
                                    <span class="title">{{ blog.title }}</span>
                                    <span class="date">{{ blog.created_at | dateFormat }}</span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <span class="info">{{ manual.files.size }} <img @click="downloadManual(manual)" src="/front-end/images/download-icon-2.png" alt=""></span>
                                </a>
                            </li>

                        </ul>
                        </div>
                    </div>
                </aside>
                <div class="blog-content content-wrapper">
                    <div class="blogs-list">
                        <div class="blog-item" v-for="(blog, index) in blogs" :key="index" v-if="index > 4">
                            <div class="blog-img">
                                <router-link :to="{path: 'blogs/'+blog.id}">
                                    <img :src="blog.image" alt="">
                                </router-link>
                            </div>
                            <div class="blog-info">
                                <router-link :to="{path: 'blogs/'+blog.id}" class="title">
                                {{ blog.title }}
                                </router-link>
                                <p>
                                {{ blog.content }}
                                </p>
                                <div class="blog-meta">
                                <span>{{ blog.created_at | dateFormat }}</span>
                                <span>|</span>
                                <span>記事</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-loading" @click="showMore()" v-show="pagination.current_page < pagination.last_page">もっと見る...</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            blogsLatest: [],
            manuals: [],
            faqs: [],
            blogs: [],
            categories: [],
            pagination: {
                page: 1,
                total: 10
            }
        }
    },
    created () {

    },
    async mounted () {
        await this.loadBlogs();
        await this.reloadSlick();
        this.loadCategorys();
        this.loadManualLatest();
        
    },
    methods: {
        async loadCategorys () {
            this.$Progress.start();
            axios.get("/api/category/type/faq").then(({ data }) => (this.categories = data.data));
            this.$Progress.finish();
        },
        async loadBlogs (page = 1) {
            this.$Progress.start();            
            try {
                let {data} = await axios.get('api/page?type=blog&page='+page);
                this.blogs = this.blogs.concat(data.data);
                this.pagination = data.meta;
            } catch (error) {
                console.log(error);
            }
            this.$Progress.finish();
        },
        async loadManualLatest () {
            try {
                let {data} = await axios.get('api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        showMore () {
            this.pagination.current_page ++;
            if (this.pagination.current_page <= this.pagination.last_page ) {
                this.loadBlogs(this.pagination.current_page);
            }
        },
        reloadSlick () {
            $('.news-slider').slick('refresh');
        },
        async downloadManual (manual) {
            if (manual.files.path) {
                try {
                    let {data} = await axios.put(`api/page/${manual.id}/rating`, {
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
<style lang="scss" scoped>
.blog-info {
    p {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }
}
.blog-img {
    a {
        width: 280px;
        height: 175px;
        overflow: hidden;
        display: block;
        img {
            width: 100%;

        }
    }
}
</style>
