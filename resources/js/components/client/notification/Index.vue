<template>
    <div class="main-wrapper">
        <div class="page-title">
            <div class="container">
                お知らせ
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <aside>
                    <div class="list-group list-group-horizontal" id="sideTab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-all" data-toggle="list" href="#all" role="tab" @click="from = 0">All</a>
                        <a class="list-group-item list-group-item-action" id="list-director" data-toggle="list" href="#director" role="tab" @click="from = 1">理事長から</a>
                        <a class="list-group-item list-group-item-action" id="list-hr" data-toggle="list" href="#hr" role="tab" @click="from = 2">事務局から</a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel">
                            <div class="notification-list list-group">
                                <div v-for="item in notifications.data" :class="`notification-item list-group-item ` + isActive(item)" @click="onSelect(item)">
                                    <div class="col-left">
                                        <span class="source bod">{{ getFromLabel(item) }}</span>
                                        <span class="date">{{ $moment(item.created_at).format('DD/MM/YYYY') }}</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">{{ getFromTitle(item) }}</span>
                                        <span class="title">{{ item.title }}</span>
                                        <p>{{ getTruncateContent(item) }}</p>
                                    </div>
<!--                                    <div :class="'status ' + getStatusClass(item)"></div>-->
                                </div>
                                <div v-if="isEmpty(notifications.data)" class="notification-item list-group-item">
                                    <span>表示するお知らせはまだありません。</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="director" role="tabpanel">
                            <div class="notification-list list-group">
                                <div v-for="item in notifications.data" :class="`notification-item list-group-item ` + isActive(item)" @click="onSelect(item)">
                                    <div class="col-left">
                                        <span class="source bod">{{ getFromLabel(item) }}</span>
                                        <span class="date">{{ $moment(item.created_at).format('DD/MM/YYYY') }}</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">{{ getFromTitle(item) }}</span>
                                        <span class="title">{{ item.title }}</span>
                                        <p v-html="getTruncateContent(item)"></p>
                                    </div>
<!--                                    <div :class="'status ' + getStatusClass(item)"></div>-->
                                </div>
                                <div v-if="isEmpty(notifications.data)" class="notification-item list-group-item">
                                    <span>表示するお知らせはまだありません。</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hr" role="tabpanel">
                            <div class="notification-list list-group">
                                <div v-for="item in notifications.data" :class="`notification-item list-group-item ` + isActive(item)" @click="onSelect(item)">
                                    <div class="col-left">
                                        <span class="source bod">{{ getFromLabel(item) }}</span>
                                        <span class="date">{{ $moment(item.created_at).format('DD/MM/YYYY') }}</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">{{ getFromTitle(item) }}</span>
                                        <span class="title">{{ item.title }}</span>
                                        <p>{{ getTruncateContent(item) }}</p>
                                    </div>
<!--                                    <div :class="'status ' + getStatusClass(item)"></div>-->
                                </div>
                                <div v-if="isEmpty(notifications.data)" class="notification-item list-group-item">
                                    <span>表示するお知らせはまだありません。</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="content-wrapper" v-if="selection">
                    <span class="date">{{ $moment(selection.created_at).format('DD/MM/YYYY') }}</span>
                    <h3 class="title">{{ selection.title }}</h3>
                    <div class="context">
                        <p v-html="selection.content">
                        </p>
                    </div>
                </div>
                <div class="content-wrapper" v-else>
                    <span>表示するお知らせはまだありません。</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                notifications: {
                    data : null
                },
                selection: null,
                from: 0,
            }
        },
        watch: {
            from: function (value) {
                this.fetch();
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch(from = 0) {
                let self = this;
                axios.get(`/api/notification/fetch?from=${this.from}`).then((response)=>{
                    self.notifications = response.data;
                    self.selection = self.notifications.data[0];
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
            updateStatus(item) {
                let self = this;
                axios.put(`/api/notification/status?notification_id=${item.notification_id}&status=1&user_id=${item.user_id}`)
                    .then((response)=>{

                    })
                    .catch(()=>{
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            },
            onSelect(item) {
                this.selection = item;
                // if (_.indexOf(item.status, 1) < 0) {
                //     this.updateStatus(item);
                // }
            },
            getFromLabel(item) {
                if (!_.isEmpty(item.notification) && !_.isEmpty(item.creator)) {
                    return item.creator.posittion == 1 ? '理事長' : '事務局'
                }

                return '事務局';
            },
            getFromTitle(item) {
                if (!_.isEmpty(item) && !_.isEmpty(item.creator)) {
                    return  item.creator.posittion == 1 ? '理事長から' : '理事長から'
                }

                return '理事長から';
            },
            getTruncateContent(item) {
                return _.truncate(this.stripHtml(item.content), {
                    'length': 100,
                    'separator': ' '
                });
            },
            isActive(item) {
                if (this.selection && item) {
                    return item.notification_id == this.selection.notification_id ? 'active' : '';
                }

                return '';
            },
            getStatusClass(item) {
                if (!_.isEmpty(item.status)) {
                    return _.indexOf(item.status, 1) > -1 ? 'yellow' : 'red';
                }

                return 'yellow';
            },
            stripHtml(html) {
                let temporalDivElement = document.createElement("div");
                temporalDivElement.innerHTML = html;
                return temporalDivElement.textContent || temporalDivElement.innerText || "";
            },
            isEmpty(data) {
                return _.isEmpty(data);
            }
        }
    }
</script>

<style scoped>

</style>
