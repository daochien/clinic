<template>
<aside>
    <div class="side-panel" v-if="showCategoryBlog && blogCategorys.length > 0">
        <div class="side-header">
            <h3><img src="/front-end/images/menu-icon.png" alt="Categories">{{ $t('page.web.sidemenu._blog_category') }}</h3>
        </div>
        <div class="side-content">
            <ul>
                <li :class="[{'active': item.id == withCateId}]" v-for="(item, index) in blogCategorys" :key="index" v-show="item.latest_page" >
                    <a href="javascript:void(0)">
                    <span class="title">{{item.name}}</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
    <div class="side-panel">
        <div class="side-header">
            <h3><img src="/front-end/images/question-icon.png" alt="">{{ $t('page.web.sidemenu._faq') }}</h3>
        </div>
        <div class="side-content">
            <div v-if="canShowFAQ">
                <div :class="['faq-block', {'active': item.id == withCateId}]" class="faq-block" v-for="(item, index) in categories" :key="index" v-show="item.latest_page">
                    <a href="javascript:void(0)" @click="showDetailFAQ(item.latest_page)">
                        <img :src="`/front-end/images/icon${index + 1}.png`" alt="">
                        {{ item.name }}
                    </a>
                </div>
            </div>
            <span v-else>{{ $t('page.web.faq.others._no_data') }}</span>
        </div>
    </div>
    <div class="side-panel">
        <div class="side-header">
            <h3><img src="/front-end/images/download-icon.png" alt="">{{ $t('page.web.sidemenu._manual') }}</h3>
            <a href="/manual" v-if="manuals.length > 0">{{ $t('page.web.sidemenu.others._show_more') }}</a>
        </div>
        <div class="side-content">
            <ul v-if="canShowManual">
                <li v-for="(manual, index) in manuals" :key="index">
                    <a :href="`/manual/downloadUrl?page_id=${manual.id}`" target="_blank"  @click="downloadManual(manual)">
                        <span class="title">{{ manual.title}}</span>
                        <span class="info">
                            {{ manual.files.size }}
                            <img src="/front-end/images/download-icon-2.png" alt="">
                        </span>
                    </a>
                </li>
            </ul>
            <ul v-else>
                <li>
                    <span>{{ $t('page.web.manual.others._no_data') }}</span>
                </li>
            </ul>

        </div>
    </div>
</aside>
</template>

<script>
export default {
    props: ['withCateId'],
    data() {
        return {
            manuals: [],
            categories: [],
            blogCategorys: []
        }
    },
    computed: {
        showCategoryBlog () {
            if (this.$route.name === 'client.blogDetail') {
                return true;
            }
            return false;
        },
        canShowFAQ () {
            if (this.categories.length > 0) {
                let show = false;
                this.categories.forEach ((item) => {
                    if (item.latest_page) {
                        show = true;
                    }
                })
                return show;
            }
            return false;
        },
        canShowManual () {
            if (this.manuals.length > 0) {
                return true;
            }
            return false;
        }
    },
    watch: {
        withCateId (newVal, oldVal) {
            if (this.showCategoryBlog) {
                this.loadBlogCategorys(newVal);
            }
        }
    },
    created() {

    },
    mounted() {
        this.loadCategorys();
        this.loadManualLatest();
    },
    methods: {
        async loadCategorys() {
            this.$Progress.start();
            axios.get("/api/category/type/faq", {
                params: {
                    show_client: 1,
                    latest_page: 1
                }
            }).then(({data}) => (this.categories = data.data));
            this.$Progress.finish();
        },
        async loadManualLatest() {
            try {
                let { data } = await axios.get('/api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                Toast.fire({
                    icon: 'error',
                    title: this.$t('common.messages._system_err'),
                });
            }
        },

        async loadBlogCategorys (cateId) {

            this.$Progress.start();
            axios.get("/api/category/type/blog", {
                params : {
                    latest_page: 1,
                    show_client: 1,
                    with_id: cateId
                }
            }).then(({ data }) => {
                this.blogCategorys = data.data;
            });
            this.$Progress.finish();
        },

        showDetailFAQ (item) {
            if (item) {
                window.location.href = '/blogs/'+item.id;
            }
        },

        async downloadManual(manual) {
            if (manual.files.path) {
                try {
                    await axios.put(`/api/page/${manual.id}/rating`, {
                        type: 'download'
                    });

                } catch (error) {
                    Toast.fire({
                        icon: 'error',
                        title: this.$t('common.messages._system_err'),
                    });
                }
            }
        }
    }
}
</script>
