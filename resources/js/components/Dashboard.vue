<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 v-show="profile.type != 'Customer'">Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" v-show="profile.type == 'Customer'">
            <div class="d-flex justify-content-center align-items-center">
            </div>
        </div>
        <div class="container" v-show="profile.type != 'Customer'">
            <div class="justify-content-center">
                <div class="row">
                    <div class="col-lg col">

                        <div class="small-box" style="background: #f87979;">
                            <div class="inner text-white">
                                <h3>{{ drop }}</h3>
                                <p>Drop Off</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shop"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col">

                        <div class="small-box" style="background-color: #36a2eb;">
                            <div class="inner text-white">
                                <h3>{{ pick }}</h3>
                                <p>Pick Up</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-truck-ramp-box"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col" v-show="profile.type == 'Administrator'">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count[2] }} %</h3>
                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-column"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col" v-show="profile.type == 'Administrator'">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>RM {{ count[1] }}</h3>
                                <p>Today Sales</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-around">
                    <div class="col-md-8">
                        <div class="card" style="position: relative; left: 0px; top: 0px;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Report Charts
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item" v-show="user.type == 'Administrator'">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">
                                                <i class="fa-solid fa-chart-area"></i>
                                                Purchases</a>
                                        </li>
                                        <li class="nav-item" v-show="user.type == 'Administrator'">
                                            <a class="nav-link" href="#sales-chart" data-toggle="tab"
                                                v-show="user.type == 'Administrator'">
                                                <i class="fa-solid fa-chart-pie"></i>
                                                Purchases
                                            </a>
                                        </li>
                                        <li class="nav-item" v-show="user.type == 'Administrator'">
                                            <a class="nav-link" href="#conversion-chart" data-toggle="tab">
                                                <i class="fa-solid fa-circle-half-stroke"></i>
                                                Conversion
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#warehouse-all-chart" data-toggle="tab"><i
                                                    class="fa-solid fa-circle-half-stroke fa-rotate-180"></i>
                                                Category</a>
                                        </li>
                                        <!-- <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                <a href="#" class="dropdown-item">Action</a>
                                                <a href="#" class="dropdown-item">Another action</a>
                                                <a href="#" class="dropdown-item">Something else here</a>
                                                <a class="dropdown-divider"></a>
                                                <a href="#" class="dropdown-item">Separated link</a>
                                                </div> -->
                                        <li class="nav-item" v-show="user.type == 'Merchant'">
                                            <a class="nav-link" href="#warehouse-chart" data-toggle="tab"><i
                                                    class="fa-solid fa-circle-half-stroke fa-rotate-180"></i>
                                                Category</a>
                                        </li>
                                        <li class="nav-item" v-show="profile.type == 'Merchant'">
                                            <a class="nav-link" href="#brand-chart" data-toggle="tab"><i
                                                    class="fa-solid fa-circle-half-stroke"></i> Brand</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">

                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;" v-show="user.type == 'Administrator'">
                                        <canvas class="d-block" height="120" id="revenue-chart-canvas" ref="line"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                        <canvas ref="chart" id="sales-chart-canvas" height="325"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="conversion-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas ref="donut" id="conversion-chart-canvas" height="325"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="brand-chart" style="position: relative; height: 300px;">
                                        <canvas ref="brand" id="brand-chart-canvas" height="325"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="warehouse-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas ref="warehouse" id="warehouse-chart-canvas" height="325"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="warehouse-all-chart" style="position: relative; height: 300px;">
                                        <canvas ref="brand" id="warehouse-all-chart-canvas" height="325"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="warehouse-all-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas ref="warehouse" id="warehouse-all-chart-canvas" height="325"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" v-show="user.type == 'Administrator'" @click="email()">
                        <div class="info-box mb-3 bg-orange">
                            <span class="info-box-icon"><i class="fas fa-tag text-white"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-white">Inventory</span>
                                <span class="info-box-number text-white">{{ count[3] }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-green pointer" type="button" @click="downloadCSV()" toggle="tooltip"
                            title="Financial Report" v-show="user.type == 'Administrator'">
                            <span class="info-box-icon"><i class="fas fa-file-excel"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Generated</span>
                                <span class="info-box-number">RM {{ count[4] }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-pink">
                            <span class="info-box-icon"><i class="fas fa-van-shuttle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Vehicles</span>
                                <span class="info-box-number">{{ count[5] }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-indigo">
                            <span class="info-box-icon"><i class="fas fa-city"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Branches</span>
                                <span class="info-box-number">{{ count[6] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import Chart from 'chart.js';
import Swal from "sweetalert2";
import { Colors } from 'chart.js';
// import ProvinceDataChart from './components/ProvinceDataChart.vue';
export default {
    props: ['profile'],
    data() {
        return {
            drop: '',
            pick: '',
            pickUps: {},
            dropOffs: {},
            modal: '',
            count: '',
            user: {}
        }
    },
    mounted() {
        console.log('Component Mounted');
    },
    methods: {
        confirm() {
            if (this.profile.type == "Customer") {
                Swal.fire({
                    title: "Welcome back !",
                    text: this.profile.name,
                    icon: "info",
                    showCancelButton: false,
                    confirmButtonColor: "#6610f2",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok",
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$router.push('/delivery');
                    }
                });
            }
        },
        downloadCSV() {
            Axios.get("/csv", { responseType: 'arraybuffer' }).then(response => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'Financial Report.csv');
                document.body.appendChild(fileLink);
                fileLink.click();
            })
        },
        renderChart(data) {
            new Chart(this.$refs.chart, {
                type: 'pie',
                data: {
                    labels: data.map(data => data.label),
                    datasets: [{
                        backgroundColor: ['#f87979', '#36a2eb'],
                        data: data.map(data => data.value)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        },
        email(){
            axios.post('/subscribe');
        },
        // renderArea(drop, pick) {
        //     const dropOfflabels = drop.map(item => item.branch);
        //     const pickUplabels = pick.map(item => item.province);
        //     // const labels = pickUplabels;
        //     const dropOffCounts = drop.map(item => item.count);
        //     const pickUpCounts = pick.map(item => item.count);

        //     new Chart(this.$refs.ctx, {
        //         type: 'line',
        //         data: {
        //             // labels: labels,
        //             datasets: [{
        //                 label: 'Drop Off',
        //                 data: dropOffCounts,
        //                 backgroundColor: 'rgba(255, 99, 132, 0.2)',
        //                 borderColor: 'rgba(255, 99, 132, 1)',
        //                 borderWidth: 1
        //             }, {
        //                 label: 'Pick Up',
        //                 data: pickUpCounts,
        //                 backgroundColor: 'rgba(54, 162, 235, 0.2)',
        //                 borderColor: 'rgba(54, 162, 235, 1)',
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             hover: {
        //                 mode: 'index',
        //                 intersect: false
        //             },
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: false,
        //                         suggestedMin: 1
        //                     }
        //                 }]
        //             }
        //         }
        //     });
        // },
        renderdonut(data) {
            new Chart(this.$refs.donut, {
                type: 'doughnut',
                data: {
                    labels: data.map(data => data.label),
                    datasets: [{
                        backgroundColor: ['#36a2eb', '#f87979', '#4bc0c0', '#ffcd56', '#9966ff'],
                        data: data.map(data => data.value)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        },
        renderWarehouse(data) {
            new Chart(this.$refs.warehouse, {
                type: 'doughnut',
                data: {
                    labels: data.map(data => data.category),
                    datasets: [{
                        backgroundColor: ['#4bc0c0', '#ffcd56', '#36a2eb', '#f87979', '#9966ff'],
                        data: data.map(data => data.quantity)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        colors: {
                            enabled: false
                        }
                    }
                }
            })
        },
        renderBrand(data) {
            new Chart(this.$refs.brand, {
                type: 'doughnut',
                data: {
                    labels: data.map(data => data.name),
                    datasets: [{
                        backgroundColor: ['#4bc0c0', '#ffcd56', '#36a2eb', '#f87979', '#9966ff'],
                        data: data.map(data => data.quantity)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        colors: {
                            enabled: false
                        }
                    }
                }
            })
        },
        proviceLineChart(data) {
            new Chart(this.$refs.line, {
                type: 'line',
                data: {
                    labels: data.map(data => data.date),
                    datasets: [{
                        label: 'Drop Off',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        data: data.map(data => data.dropOffCount)
                    }, {
                        label: 'Pickup',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        data: data.map(data => data.pickupCount)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    beginAtZero: false,
                    plugins: {
                        colors: {
                            enabled: false
                        }
                    }
                }
            });
        }



    },
    created() {
        this.confirm();
        axios.get('api/profile').then(({ data }) => (this.user = data));
        axios.get('api/dropOffCount').then(({ data }) => (this.drop = data));
        axios.get('api/pickUpCount').then(({ data }) => (this.pick = data));
        axios.get('api/dropData').then(({ data }) => (this.pickUps = data));
        axios.get('api/pickData').then(({ data }) => (this.dropOffs = data));
        axios.get('api/dashboard').then(({ data }) => (this.count = data));
        axios.get('api/chart').then(response => { this.renderChart(response.data) });
        axios.get('api/donutdrop').then(response => { this.renderdonut(response.data) });
        axios.get('api/warehouseChart').then(response => { this.renderWarehouse(response.data) });
        axios.get('api/chartData').then(response => { this.proviceLineChart(response.data) });
        axios.get('api/brandChart').then(response => { this.renderBrand(response.data) });
        // axios.all([
        //     axios.get('api/provinceDataDrop'),
        //     axios.get('api/provinceDataPick')
        // ])
        //     .then(axios.spread((dropOffResponse, pickUpResponse) => {
        //         this.renderArea(dropOffResponse.data, pickUpResponse.data);
        //     }));
    }
}
</script>
