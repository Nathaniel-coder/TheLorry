<template>
    <div>
        <canvas id="revenue-chart-canvas" ref="ctx" height="375"
        style="height: 300px; display: block; width: 654px;" width="817"
        class="chartjs-render-monitor"></canvas>
    </div>
</template>

<script>
import axios from 'axios';
import Chart from 'chart.js';

export default {
    mounted() {
        axios.all([
            axios.get('api/provinceDataDrop'),
            axios.get('api/provinceDataPick')
        ])
        .then(axios.spread((dropOffResponse, pickUpResponse) => {
            const dropOffData = dropOffResponse.data;
            const pickUpData = pickUpResponse.data;

            const labels = dropOffData.map(item => item.province);
            const dropOffCounts = dropOffData.map(item => item.count);
            const pickUpCounts = pickUpData.map(item => item.count);

            const ctx = document.getElementById('provinceChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Drop Off',
                        data: dropOffCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Pick Up',
                        data: pickUpCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }));
    }
}
</script>
