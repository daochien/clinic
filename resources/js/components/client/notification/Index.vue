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
                        <a class="list-group-item list-group-item-action active" id="list-all" data-toggle="list" href="#all" role="tab">All</a>
                        <a class="list-group-item list-group-item-action" id="list-director" data-toggle="list" href="#director" role="tab">理事長から</a>
                        <a class="list-group-item list-group-item-action" id="list-hr" data-toggle="list" href="#hr" role="tab">事務局から</a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel">
                            <div class="notification-list list-group">
                                <div v-for="item in notifications.data" class="notification-item list-group-item active">
                                    <div class="col-left">
                                        <span class="source bod">{{ getFromLabel(item) }}</span>
                                        <span class="date">{{ $moment(item.created_at).format('DD/MM/YYYY') }}</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">{{ getFromTitle(item) }}</span>
                                        <span class="title" v-if="item.notification">{{ item.notification.title }}</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status red"></div>
                                </div>
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source hr">HR</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status yellow"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source bod">BOD</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status red"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source hr">HR</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status yellow"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source bod">BOD</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status red"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source hr">HR</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status yellow"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source bod">BOD</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status red"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source hr">HR</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status yellow"></div>-->
<!--                                </div>-->
<!--                                <div class="notification-item list-group-item">-->
<!--                                    <div class="col-left">-->
<!--                                        <span class="source bod">BOD</span>-->
<!--                                        <span class="date">28/7/2020</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-right">-->
<!--                                        <span class="sub">理事長から</span>-->
<!--                                        <span class="title">コロナウィルスの影響に関する対応について</span>-->
<!--                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>-->
<!--                                    </div>-->
<!--                                    <div class="status red"></div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="director" role="tabpanel">
                            <div class="notification-list list-group">
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source bod">BOD</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status red"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source bod">BOD</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status red"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source bod">BOD</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status red"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source bod">BOD</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status red"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hr" role="tabpanel">
                            <div class="notification-list list-group">
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                                <div class="notification-item list-group-item">
                                    <div class="col-left">
                                        <span class="source hr">HR</span>
                                        <span class="date">28/7/2020</span>
                                    </div>
                                    <div class="col-right">
                                        <span class="sub">理事長から</span>
                                        <span class="title">コロナウィルスの影響に関する対応について</span>
                                        <p>コロナウィルスの影響に関する対応についてコロナウィルスの影響に関する対応についてコロナウィルスの影 ...</p>
                                    </div>
                                    <div class="status yellow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="content-wrapper">
                    <span class="date">28/7/2020</span>
                    <h3 class="title">コロナウィルスの影響に関する対応について</h3>
                    <div class="context">
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
                        </p>
                        <p>
                            今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！今さら聞けない！Instagramマーケティングで知っておきたい基礎知識今さら聞けない！
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
            }
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch(from = 0) {
                axios.get('/api/notification/fetch').then((response)=>{
                    this.notifications = response.data;
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
            getFromLabel(item) {
                console.log(item)
                if (!_.isEmpty(item.notification) && !_.isEmpty(item.notification.creator)) {
                    return item.notification.creator.posittion == 1 ? 'BOD' : 'HR'
                }

                return 'HR';
            },
            getFromTitle(item) {
                if (!_.isEmpty(item.notification) && !_.isEmpty(item.notification.creator)) {
                    return  item.notification.creator.posittion == 1 ? '理事長から' : '理事長から'
                }

                return '理事長から';
            }
        }
    }
</script>

<style scoped>

</style>
