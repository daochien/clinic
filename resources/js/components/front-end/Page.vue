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
                    <div class="news-slider" ref="slick" :key="keySlider">
                        <div class="news-slider-item" v-for="(blog, index) in blogs" :key="index" v-if="index < 5">
                            <a :href="'blogs/'+blog.id">
                                <img :src="blog.image" alt="">
                                <span class="title">{{ blog.title }}</span>
                                <span class="date">{{ blog.created_at | dateFormat }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <SideBar />
            <div class="blog-content content-wrapper">
                <div class="blogs-list">
                    <div class="blog-item" v-for="(blog, index) in blogs" :key="index" v-if="index > 4">
                        <div class="blog-img">
                            <a :href="'blogs/'+blog.id">
                                <img :src="blog.image" alt="">
                            </a>
                        </div>
                        <div class="blog-info">
                            <a :href="'blogs/'+blog.id" class="title">
                                {{ blog.title }}
                            </a>
                            <p>
                                {{ blog.summary }}
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
import SideBar from './SideBar';
export default {
    components: {
        SideBar
    },
    data() {
        return {
            keySlider: Date.now(),
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
    created() {
        console.log('xxx');
    },
    mounted() {
        this.loadBlogs();
        this.loadCategorys();
        this.loadManualLatest();
    },
    methods: {
        async loadCategorys() {
            this.$Progress.start();
            axios.get("/api/category/type/faq").then(({
                data
            }) => (this.categories = data.data));
            this.$Progress.finish();
        },
        async loadBlogs(page = 1) {
            this.$Progress.start();
            try {
                let {
                    data
                } = await axios.get('api/page?type=blog&page=' + page);
                this.blogs = this.blogs.concat(data.data);
                this.pagination = data.meta;
                this.$nextTick(function () {
                    this.reloadSlick();
                });
            } catch (error) {
                console.log(error);
            }
            this.$Progress.finish();
        },
        async loadManualLatest() {
            try {
                let {
                    data
                } = await axios.get('api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        showMore() {
            this.pagination.current_page++;
            if (this.pagination.current_page <= this.pagination.last_page) {
                this.loadBlogs(this.pagination.current_page);
            }
        },
        reloadSlick() {
            try {
                $('.news-slider').slick('refresh');
            } catch (error) {}

        },
        async downloadManual(manual) {
            if (manual.files.path) {
                try {
                    let {
                        data
                    } = await axios.put(`/api/page/${manual.id}/rating`, {
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
