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
                        <h2>Latest News</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col col-right">
                        <div class="news-slider" ref="slick">
                            <div class="news-slider-item" v-for="(blog, index) in blogsLatest" :key="index">
                                <a href="#">
                                    <img :src="blog.image" alt="">
                                    <span class="title">{{ blog.short_title }}</span>
                                    <span class="date">{{ blog.created_at }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <aside>
                    <div class="side-panel">
                        <div class="side-header">
                        <h3><img src="/front-end/images/question-icon.png" alt=""> FAQ</h3>
                        </div>
                        <div class="side-content">
                            <div class="faq-block" v-for="(faq, index) in faqs" :key="index">
                                <a href="#">{{ faq.short_title }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="side-panel">
                        <div class="side-header">
                        <h3><img src="/front-end/images/download-icon.png" alt=""> Manual Guide</h3>
                        <a href="#">View all</a>
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
                    <div class="blogs-list">
                        <div class="blog-item" v-for="(blog, index) in blogs" :key="index">
                            <div class="blog-img">
                                <a href="#">
                                    <img :src="blog.image" alt="">
                                </a>
                            </div>
                            <div class="blog-info">
                                <a href="#" class="title">
                                {{ blog.short_title }}
                                </a>
                                <p>
                                {{ blog.short_description }}
                                </p>
                                <div class="blog-meta">
                                <span>{{ blog.created_at }}</span>
                                <!-- <span>|</span>
                                <span>記事</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-loading">Load more ...</button>
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
            blogs: []
        }
    },
    created () {

    },
    async mounted () {
        this.loadManualLatest();
        this.loadFaqLatest();
        this.loadBlogs();
        await this.loadBlogLatest();
        await this.reloadSlick();
    },
    methods: {
        async loadBlogs (page = 1) {
            try {
                let {data} = await axios.get('api/page/blogs?page='+page);
                this.blogs = this.blogs.concat(data.data);
            } catch (error) {
                console.log(error);
            }
        },
        async loadFaqLatest () {
            try {
                let {data} = await axios.get('api/page/faq-latest');
                this.faqs = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async loadBlogLatest () {
            try {
                let {data} = await axios.get('api/page/blog-latest');
                this.blogsLatest = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async loadManualLatest () {
            try {
                let {data} = await axios.get('api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        reloadSlick () {
            $('.news-slider').slick('refresh');
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
