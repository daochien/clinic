<template>
<div class="main-wrapper">
    <div class="page-content">
        <div class="container">
            <SideBar />
            <div class="blog-content content-wrapper">

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
        this.loadCategorys();
        this.loadManualLatest();
        this.loadPage();
    },
    methods: {
        async loadCategorys() {
            this.$Progress.start();
            axios.get("/api/category/type/faq").then(({
                data
            }) => (this.categories = data.data));
            this.$Progress.finish();
        },
        async loadManualLatest() {
            try {
                let {
                    data
                } = await axios.get('/api/page/manual-latest');
                this.manuals = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        loadPage() {
            axios.get("/api/page/" + this.$route.params.id)
                .then(({
                    data
                }) => {
                    if (data.data) {
                        this.page = data.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
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
