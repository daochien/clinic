<template>
<div class="main-wrapper">
    <div class="page-title center">
      <div class="container">
        {{ $t('page.web.manual._page_title') }}
      </div>
    </div>
    <div class="page-content white-content">
      <div class="container">
        <div class="manual-guide-wrapper" v-if="manuals.length > 0">
          <ul class="manual-list">
            <li v-for="(item, index) in manuals" :key="index">
                <img src="/front-end/images/png-icon.png" alt="">
                <div class="info">
                    <span class="title">{{ item.title }}</span>
                    <p> {{ item.content ? item.content : '---' }} </p>
                </div>
                <a :href="`/manual/downloadUrl?page_id=${item.id}`" target="_blank" @click="forceFileDownload(item)">
                <button class="download" >{{ item.files ? item.files.size : '' }}
                     <img src="/front-end/images/download-icon-2.png" alt="">
                </button>
                </a>
            </li>
          </ul>
          <nav v-if="pagination.last_page > 1">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous" @click="loadManual(1)">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li :class="['page-item', {'active': i == pagination.current_page}] " v-for="i in pagination.last_page" :key="i">
                  <a class="page-link" href="javascript:void(0)" @click="loadManual(i)">{{ i }}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next" @click="loadManual(pagination.last_page)">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
          </nav>
        </div>
        <div class="manual-guide-wrapper" v-else>
            <ul class="manual-list">
                <li>
                <span class="title">{{ $t('page.web.manual.others._no_data') }}</span>
                </li>
            </ul>
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
            pagination: {
                page: 1,
                total: 10
            }
        }
    },
    created () {
        this.loadManual();
    },
    methods: {
        async loadManual(page = 1) {
            this.$Progress.start();
            try {
                let {
                    data
                } = await axios.get('api/page?status=1&type=manual&page=' + page);
                this.manuals = data.data;
                this.pagination = data.meta;

            } catch (error) {
                Toast.fire({
                    icon: 'error',
                    title: this.$t('common.messages._system_err'),
                });
            }
            this.$Progress.finish();
        },
        async forceFileDownload(manual) {
            if (manual.files) {
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

        },
    }
}
</script>
<style scoped>
.info {
    width: 90%;
}
</style>
