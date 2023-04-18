<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Shipment</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="row d-flex justify-content-around" style="margin-left: 0; margin-right: 0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="#pickUp" data-toggle="tab">Pick Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#dropOff" data-toggle="tab">Drop Off</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="dropOff">
                                <div class="post">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-widget="expandable-table" aria-expanded="false"
                                                v-for="dropOff in dropOffs.data" :key="dropOff.id" v-show="dropOff.status">
                                                <td>
                                                    {{ dropOff.date }}
                                                </td>
                                                <td>
                                                    {{ dropOff.name }}
                                                </td>
                                                <td>
                                                    {{ dropOff.toname }}
                                                </td>
                                                <td>
                                                    {{ dropOff.toaddress1 }}, {{ dropOff.toaddress2 }}, {{
                                                        dropOff.topostcode }} {{ dropOff.tocity }}, {{
        dropOff.toprovince }}, {{ dropOff.tocountry }}
                                                </td>
                                                <td>
                                                    <button class="btn bg-blue" toggle="tooltip" title="Edit">
                                                        <i class="fa-solid fa-file-invoice-dollar text-white"></i>
                                                    </button>
                                                    <button class="btn bg-green" toggle="tooltip" title="Delete">
                                                        <i class="fa-solid fa-file-invoice text-white"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="pickUp">
                                <div class="post">
                                    <div class="table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="pickUP in pickUps.data" :key="pickUP.id" v-show="pickUP.status">
                                                    <td>{{ pickUP.date }}</td>
                                                    <td>{{ pickUP.name }}</td>
                                                    <td>
                                                        {{ pickUP.toname }}
                                                    </td>
                                                    <td>
                                                        {{ pickUP.toaddress1 }},{{ pickUP.toaddress2 }},{{ pickUP.topostcode
                                                        }} {{
    pickUP.tocity }}, {{ pickUP.toprovince }},{{ pickUP.tocountry }}
                                                    </td>
                                                    <!-- <td>183</td>
                                                                                                <td>183</td>
                                                                                                <td>183</td>
                                                                                                <td>183</td>
                                                                    <td>183</td>-->
                                                    <td>
                                                        <button class="btn bg-blue" toggle="tooltip" title="invoice">
                                                            <i class="fa-solid fa-file-invoice-dollar text-white"></i>
                                                        </button>
                                                        <button class="btn bg-green" toggle="tooltip" title="Consignment">
                                                            <i class="fa-solid fa-file-invoice text-white"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
import Swal from "sweetalert2";
import Axios from "axios";
export default {
    props: ["profile"],
    data() {
        return {
            dropOffs: {},
            pickUps: {},
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        this.loadDropOff();
        console.log(this.dropOffs.data);
    },
    methods: {
        loadDropOff() {
            axios.get("api/dropOff").then(({ data }) => (this.dropOffs = data));
            axios.get("api/pickUp").then(({ data }) => (this.pickUps = data));
        }
    },
};
</script>
