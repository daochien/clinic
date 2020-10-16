<template>
<div class="main-wrapper">

    <div class="page-title">
        <div class="container">
            {{ $t('page.web.blog._page_title') }}
        </div>
    </div>
    <div class="page-content">
        <div class="latest-news" v-if="blogs.length > 0">
            <div class="container">
                <div class="col col-left">
                    <h2>{{ $t('page.web.blog.list._latest_blogs') }}</h2>
                </div>
                <div class="col col-right">
                    <!-- <div class="news-slider" ref="slick" > -->
                        <slick class="news-slider" ref="slick" :options="slickOptions">

                            <div class="news-slider-item" v-for="(blog, index) in blogs" :key="index" v-if="index < 5">
                                <router-link :to="'blogs/'+blog.id">
                                    <img v-if="blog.image" :src="blog.image" alt="">
                                    <img v-else src="/front-end/images/default-image.png" alt="">
                                    <span class="title">{{ blog.title }}</span>
                                    <span class="date">{{ blog.created_at | myDateShort }}</span>
                                </router-link>
                            </div>
                        </slick>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="container">
            <SideBar />
            <div class="blog-content content-wrapper" v-if="blogs.length > 0">
                <div class="blogs-list">
                    <div class="blog-item" v-for="(blog, index) in blogs" :key="index" v-if="index > 4">
                        <div class="blog-img">
                            <a :href="'blogs/'+blog.id">
                                <img v-if="blog.image" :src="blog.image" alt="">
                                <img v-else src="/front-end/images/default-image.png" alt="">
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
                                <span>{{ blog.created_at | myDateShort }}</span>
                                <span>｜</span>
                                <span>{{ blog.category_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-loading" @click="showMore()" v-show="pagination.current_page < pagination.last_page">{{ $t('page.web.blog.list._show_more') }}</button>
            </div>
            <div class="blog-content content-wrapper" v-else>
                {{ $t('page.web.blog.others._no_data') }}
            </div>
        </div>
    </div>
</div>
</template>

<script>

import Slick from 'vue-slick';
import SideBar from './SideBar';
export default {
    components: {
        SideBar,
        Slick
    },
    data() {
        return {
            blogsLatest: [],
            manuals: [],
            faqs: [],
            blogs: [],
            categories: [],
            pagination: {
                page: 1,
                total: 10
            },
            slickOptions: {
                dots: false,
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: true,
                infinite: true,
                speed: 500,
                fade: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                variableWidth: true
            }
        }
    },
    created() {
        this.loadBlogs();
    },

    mounted() {

        //this.reloadSlick();
    },
    updated () {
        // console.log('xx');
        //this.reloadSlick();
    },
    methods: {

        async loadBlogs(page = 1) {
            this.$Progress.start();
            try {
                let {
                    data
                } = await axios.get('api/page?status=1&type=blog&limit=15&page=' + page);
                this.blogs = this.blogs.concat(data.data);
                this.pagination = data.meta;
                //  let currIndex = this.$refs.slick.currentSlide()
                // this.$refs.slick.destroy()
                // this.$nextTick(() => {
                //     this.$refs.slick.create()
                //     this.$refs.slick.goTo(currIndex, true)
                // })

            } catch (error) {
                Toast.fire({
                    icon: 'error',
                    title: this.$t('common.messages._system_err'),
                });
            }
            this.$Progress.finish();
        },

        showMore() {
            this.pagination.current_page++;
            if (this.pagination.current_page <= this.pagination.last_page) {
                this.loadBlogs(this.pagination.current_page);
            }
        },
    }
}
</script>
<style >
    @import '../../../../../node_modules/slick-carousel/slick/slick.css';
</style>

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
