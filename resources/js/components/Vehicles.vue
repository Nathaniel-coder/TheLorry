<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vehicles</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Vehicles</h3>
                                <div class="card-tools">
                                    <button class="btn bg-blue" type="button" data-toggle="modal" data-target="#CreateEdit"
                                        @click="newModal()" toggle="tooltip" title="Create Staff">
                                        <i class="fa-solid fa-plus icon-btn-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Plate Number</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Category</th>
                                            <th>Year</th>
                                            <th>Situated</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="vehicle in vehicles.data" :key="vehicle.id">
                                            <td>{{ vehicle.platno }}</td>
                                            <td>{{ vehicle.brand }}</td>
                                            <td>{{ vehicle.model }}</td>
                                            <td>{{ vehicle.category }}</td>
                                            <td>{{ vehicle.year }}</td>
                                            <td>{{ vehicle.situated }}</td>
                                            <td>{{ vehicle.availability }}</td>
                                            <td>
                                                <button class="btn bg-orange" toggle="tooltip" title="Edit Staff"
                                                    @click="editModal(vehicle)">
                                                    <i class="fa-solid fa-pen-to-square text-light"></i>
                                                </button>
                                                <button class="btn bg-red" toggle="tooltip" title="Delete Staff"
                                                    @click="deleteVehicle(vehicle.id)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" v-show="vehicles">
                                <pagination class="nav-item" :data="vehicles" @change-page="getResults"></pagination>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="CreateEdit" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="staticBackdropLabel">
                            Create new Branch
                        </h5>
                        <h5 class="modal-title" v-show="editmode" id="staticBackdropLabel">
                            Update Branch
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateVehicles() : createVehicles()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Plate Number</label>
                                <input v-model="form.platno" class="form-control" type="text" name="platno"
                                    placeholder="Plate Number" :class="{ 'is-invalid': form.errors.has('platno') }" />
                                <div v-if="form.errors.has('platno')" v-html="form.errors.get('platno')"></div>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <input v-model="form.brand" class="form-control" type="text" name="brand"
                                placeholder="Brand" :class="{ 'is-invalid': form.errors.has('brand') }" />
                            <div v-if="form.errors.has('brand')" v-html="form.errors.get('brand')"></div>
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input v-model="form.model" class="form-control" type="text" name="model"
                                    placeholder="Model" :class="{ 'is-invalid': form.errors.has('model') }" />
                                <div v-if="form.errors.has('model')" v-html="form.errors.get('model')"></div>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <input v-model="form.category" class="form-control" type="text" name="category"
                                    placeholder="Category" :class="{ 'is-invalid': form.errors.has('category') }" />
                                <div v-if="form.errors.has('category')" v-html="form.errors.get('category')"></div>
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input v-model="form.year" class="form-control" type="text" name="year"
                                placeholder="Year" :class="{ 'is-invalid': form.errors.has('year') }" />
                            <div v-if="form.errors.has('year')" v-html="form.errors.get('year')"></div>
                            </div>
                            <div class="form-group">
                                <label>Situated</label>
                                <select v-model="form.situated" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('situated') }">
                                    <option selected v-show="form.situated">{{ form.situated ? form.situated : "" }}</option>
                                    <option v-for="branch in branches" :key="branch.id">{{ branch.branch }} {{ branch.city }},{{ branch.province }},{{ branch.country }}</option>
                                </select>
                                <div v-if="form.errors.has('situated')" v-html="form.errors.get('situated')"></div>

                            </div>
                            <div class="form-group">
                                <label>Availability</label>
                                <input v-model="form.availability" class="form-control" type="text" name="availability"
                                placeholder="Availability" :class="{ 'is-invalid': form.errors.has('availability') }" />
                            </div>
                            <!-- <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="form.photo" class="form-control-file" type="file" name="name" placeholder="Name" :class="{ 'is-invalid' : form.errors.has('photo')}">
                        <div v-if="form.errors.has('photo')" v-html="form.errors.get('photo')"></div>
                    </div> -->
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">
                                    Close
                                </button>
                                <button v-show="!editmode" type="submit" class="btn bg-blue">
                                    Create
                                </button>
                                <button v-show="editmode" type="submit" class="btn bg-blue">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
import Swal from "sweetalert2";
import Axios from 'axios';
import pagination from 'laravel-vue-semantic-ui-pagination';

export default {
    data() {
        return {
            editmode: false,
            vehicles: {},
            branches: {},
            form: new Form({
                id: "",
                platno: "",
                brand: "",
                model: "",
                category: "",
                year: "",
                situated: "",
                availability: "",
            }),
        };
    },
    methods: {
        getResults(page) {
            axios.get('api/vehicle?page=' + page).then(response => {
                this.branches = response.data;
            })
        },
        editModal(vehicle) {
            this.editmode = true;
            this.form.reset();
            $("#CreateEdit").modal("show");
            this.form.fill(vehicle);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#CreateEdit").modal("show");
        },
        updateVehicles() {
            this.$Progress.start();
            this.form
                .put("api/vehicle/" + this.form.id)
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.platno + "'s",
                        text: "Information has been updated",
                        showConfirmButton: true,
                        timer: 1500,
                    });
                    this.$Progress.finish();
                    Fire.$emit("AfterCreated");
                    $("#CreateEdit").modal("hide");
                })
                .catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                    this.$Progress.fail();
                });
        },
        createVehicles() {
            this.$Progress.start();

            this.form
                .post("api/vehicle")
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.platno + " is created",
                        showConfirmButton: true,
                        timer: 1500,
                    });
                    this.$Progress.finish();
                    Fire.$emit("AfterCreated");
                })
                .catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
            $("#CreateEdit").modal("hide");
        },
        loadVehicles() {
            axios.get("api/vehicle").then(({ data }) => (this.vehicles = data));
        },
        loadBranches() {
            axios.get("api/branches").then(({ data }) => (this.branches = data));
        },
        deleteVehicle(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    this.form.delete("api/vehicle/" + id).then(() => {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                    });
                    this.$Progress.finish();
                }
                Fire.$emit("AfterCreated");
            });
        },
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            this.$Progress.start();
            axios.get('api/findVehicle?q=' + query).then((data) => {
                this.vehicles = data.data;
                this.$progress.finish();
                Swal.fire({
                    icon: "success",
                    title: "Users found"
                });
            }).catch(() => {
                Swal.fire({
                    icon: "Error",
                    title: "Users not found"
                });
            })
        })
        Fire.$on("AfterCreated", () => {
            this.loadVehicles();
        });
        this.loadVehicles();
        this.loadBranches();
        getResults(page);
    },
};
</script>
