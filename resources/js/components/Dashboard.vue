<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="justify-content-center">
                <div class="row">
                    <div class="col-lg-3 col-6">

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

                    <div class="col-lg-3 col-6">

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

                    <div class="col-lg-3 col-6">

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

                    <div class="col-lg-3 col-6">

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
                        <div class="card">
                            <!-- <div class="card-header">
                                <h3 class="card-title">Delivery chart</h3>
                            </div> -->
                            <div class="card-body">
                                <canvas ref="chart" height="325"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="info-box mb-3 bg-orange">
                            <span class="info-box-icon"><i class="fas fa-tag text-white"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-white">Inventory</span>
                                <span class="info-box-number text-white">{{ count[3] }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="far fa-heart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mentions</span>
                                <span class="info-box-number">92,050</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-green pointer" type="button" @click="downloadCSV()" toggle="tooltip"
                            title="Financial Report">
                            <span class="info-box-icon"><i class="fas fa-file-excel"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Generated</span>
                                <span class="info-box-number">RM {{ count[4] }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="far fa-comment"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Direct Messages</span>
                                <span class="info-box-number">163,921</span>
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
export default {
    data() {
        return {
            drop: '',
            pick: '',
            pickUps: {},
            dropOffs: {},
            modal: '',
            count:'',
        }
    },
    mounted() {
        console.log('Component Mounted');
    },
    methods: {
        downloadCSV() {
            Axios.get("/csv", { responseType: 'arraybuffer' }).then(response => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'Financial Report.xlsx');
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
    },
    created() {
        axios.get('api/dropOffCount').then(({ data }) => (this.drop = data));
        axios.get('api/pickUpCount').then(({ data }) => (this.pick = data));
        axios.get('api/dropData').then(({ data }) => (this.pickUps = data));
        axios.get('api/pickData').then(({ data }) => (this.dropOffs = data));
        axios.get('api/dashboard').then(({ data }) => (this.count = data));
        axios.get('api/chart').then(response => { this.renderChart(response.data) });
    }
}
</script>
