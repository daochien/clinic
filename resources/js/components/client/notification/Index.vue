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
                                        <span class="title" v-if="item.notification">{{ item.notification.title }}</span>
                                        <p>{{ getTruncateContent(item) }}</p>
                                    </div>
                                    <div :class="'status ' + getStatusClass(item)"></div>
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
                                        <span class="title" v-if="item.notification">{{ item.notification.title }}</span>
                                        <p>{{ getTruncateContent(item) }}</p>
                                    </div>
                                    <div :class="'status ' + getStatusClass(item)"></div>
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
                                        <span class="title" v-if="item.notification">{{ item.notification.title }}</span>
                                        <p>{{ getTruncateContent(item) }}</p>
                                    </div>
                                    <div :class="'status ' + getStatusClass(item)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="content-wrapper" v-if="selection">
                    <span class="date">{{ $moment(selection.created_at).format('DD/MM/YYYY') }}</span>
                    <h3 class="title">{{ getFromTitle(selection) }}</h3>
                    <div class="context">
                        <p>
                            {{ selection.notification.content }}
                        </p>
                    </div>
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
                notifications: null,
                selection: null,
                from: 0,
            }
        },
        watch: {
            from: function (value) {
                this.fetch();
            }
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch(from = 0) {
                axios.get(`/api/notification/fetch?user_id=9999&from=${this.from}`).then((response)=>{
                    this.notifications = response.data;
                    this.selection = this.notifications.data[0];
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
            },
            getFromLabel(item) {
                if (!_.isEmpty(item.notification) && !_.isEmpty(item.notification.creator)) {
                    return item.notification.creator.posittion == 1 ? '理事長' : '事務局'
                }

                return '事務局';
            },
            getFromTitle(item) {
                if (!_.isEmpty(item.notification) && !_.isEmpty(item.notification.creator)) {
                    return  item.notification.creator.posittion == 1 ? '理事長から' : '理事長から'
                }

                return '理事長から';
            },
            getTruncateContent(item) {
                return _.truncate(item.notification.content, {
                    'length': 100,
                    'separator': ' '
                });
            },
            isActive(item) {
                if (this.selection) {
                    return item.notification.id == this.selection.notification.id ? 'active' : '';
                }

                return '';
            },
            getStatusClass(item) {
                if (!_.isEmpty(item.notification.status)) {
                    return item.notification.status.status === 1 ? 'yellow' : 'red';
                }

                return 'yellow';
            }
        }
    }
</script>

<style scoped>

</style>
