<template>
    <div class="row">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">Dashboard</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="stats-small card card-small">
                <div class="card-body px-0 pb-0">
                    <div class="d-flex px-3">
                        <div class="stats-small__data">
                            <span class="stats-small__label mb-1 text-uppercase">Users</span>
                            <h6 class="stats-small__value count m-0">2,390</h6>
                        </div>
                        <div class="stats-small__data text-right align-items-center">
                            <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                        </div>
                    </div>
                    <canvas height="60" class="analytics-overview-stats-small-1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="stats-small card card-small">
                <div class="card-body px-0 pb-0">
                    <div class="d-flex px-3">
                        <div class="stats-small__data">
                            <span class="stats-small__label mb-1 text-uppercase">Sessions</span>
                            <h6 class="stats-small__value count m-0">8,391</h6>
                        </div>
                        <div class="stats-small__data text-right align-items-center">
                            <span class="stats-small__percentage stats-small__percentage--decrease">7.21%</span>
                        </div>
                    </div>
                    <canvas height="60" class="analytics-overview-stats-small-2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="stats-small card card-small">
                <div class="card-body px-0 pb-0">
                    <div class="d-flex px-3">
                        <div class="stats-small__data">
                            <span class="stats-small__label mb-1 text-uppercase">Pageviews</span>
                            <h6 class="stats-small__value count m-0">21,293</h6>
                        </div>
                        <div class="stats-small__data text-right align-items-center">
                            <span class="stats-small__percentage stats-small__percentage--increase">3.71%</span>
                        </div>
                    </div>
                    <canvas height="60" class="analytics-overview-stats-small-3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="stats-small card card-small">
                <div class="card-body px-0 pb-0">
                    <div class="d-flex px-3">
                        <div class="stats-small__data">
                            <span class="stats-small__label mb-1 text-uppercase">Pages / Session</span>
                            <h6 class="stats-small__value count m-0">6.43</h6>
                        </div>
                        <div class="stats-small__data text-right align-items-center">
                            <span class="stats-small__percentage stats-small__percentage--decrease">2,71%</span>
                        </div>
                    </div>
                    <canvas height="60" class="analytics-overview-stats-small-4"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
