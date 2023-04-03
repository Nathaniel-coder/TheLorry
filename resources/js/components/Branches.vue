<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Branches</h1>
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
                                <h3 class="card-title">Branches</h3>
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
                                            <th>Branch</th>
                                            <th>Type</th>
                                            <th>Address</th>
                                            <th>Postcode</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="branch in branches.data" :key="branch.id">
                                            <td>{{ branch.branch }}</td>
                                            <td>{{ branch.type }}</td>
                                            <td>{{ branch.address1 }},{{ branch.address2 }}</td>
                                            <td>{{ branch.postcode }}</td>
                                            <td>{{ branch.city }}</td>
                                            <td>{{ branch.province }}</td>
                                            <td>{{ branch.country }}</td>
                                            <td>
                                                <button class="btn bg-orange" toggle="tooltip" title="Edit Staff" @click="editModal(branch)">
                                                    <i class="fa-solid fa-pen-to-square text-light"></i>
                                                </button>
                                                <button class="btn bg-red" toggle="tooltip" title="Delete Staff" @click="deleteBranch(branch.id)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" v-show="branches">
                                <pagination class="nav-item" :data="branches" @change-page="getResults"></pagination>
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
                    <form @submit.prevent="editmode ? updateBranches() : createBranches()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input v-model="form.branch" class="form-control" type="text" name="branch"
                                    placeholder="Branch" :class="{ 'is-invalid': form.errors.has('branch') }" />
                                <div v-if="form.errors.has('branch')" v-html="form.errors.get('branch')"></div>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select v-model="form.btype" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('btype') }">
                                    <option selected>{{ form.btype }}</option>
                                    <option value="Warehouse">Warehouse</option>
                                    <option value="Office(Front-Desk)">Office(Front-Desk)</option>
                                    <option value="Office(Development)">Office(Development)</option>
                                </select>
                                <div v-if="form.errors.has('btype')" v-html="form.errors.get('btype')"></div>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input v-model="form.address1" class="form-control" type="text" name="address1"
                                    placeholder="Address 1" :class="{ 'is-invalid': form.errors.has('address1') }" />
                                <div v-if="form.errors.has('address1')" v-html="form.errors.get('address1')"></div>
                            </div>
                            <div class="form-group">
                                <input v-model="form.address2" class="form-control" type="text" name="address2"
                                    placeholder="Address 2" :class="{ 'is-invalid': form.errors.has('address2') }" />
                                <div v-if="form.errors.has('address2')" v-html="form.errors.get('address2')"></div>
                            </div>
                            <div class="form-group">
                                <input v-model="form.postcode" class="form-control" type="number" name="postcode"
                                    placeholder="Postcode" :class="{ 'is-invalid': form.errors.has('postcode') }" />
                                <div v-if="form.errors.has('postcode')" v-html="form.errors.get('postcode')"></div>
                            </div>
                            <div class="form-group">
                                <input v-model="form.city" class="form-control" type="text" name="city"
                                    placeholder="City" :class="{ 'is-invalid': form.errors.has('city') }" />
                                <div v-if="form.errors.has('city')" v-html="form.errors.get('city')"></div>
                            </div>
                            <div class="form-group">
                                <input v-model="form.province" class="form-control" type="text" name="province"
                                    placeholder="province" :class="{ 'is-invalid': form.errors.has('province') }" />
                                <div v-if="form.errors.has('province')" v-html="form.errors.get('province')"></div>
                            </div>
                            <div class="form-group">
                                <input v-model="form.country" class="form-control" type="text" name="country"
                                    placeholder="country" :class="{ 'is-invalid': form.errors.has('country') }" />
                                <div v-if="form.errors.has('country')" v-html="form.errors.get('country')"></div>
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
            branches: {},
            form: new Form({
                id: "",
                branches: "",
                btype: "",
                address1: "",
                address2: "",
                postcode: "",
                city: "",
                province: "",
                country: "",
            }),
        };
    },
    methods: {
        getResults(page) {
            axios.get('api/branch?page=' + page).then(response => {
                this.branches = response.data;
            })
        },
        editModal(branch) {
            this.editmode = true;
            this.form.reset();
            $("#CreateEdit").modal("show");
            this.form.fill(branch);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#CreateEdit").modal("show");
        },
        updateBranches() {
            this.$Progress.start();
            this.form
                .put("api/branch/" + this.form.id)
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.name + "'s",
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
        createBranches() {
            this.$Progress.start();

            this.form
                .post("api/branch")
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.branch + " is now " + this.form.btype,
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
        loadBranches() {
            axios.get("api/branch").then(({ data }) => (this.branches = data));
        },
        deleteBranch(id) {
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
                    this.form.delete("api/branch/" + id).then(() => {
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
            axios.get('api/findBranch?q=' + query).then((data) => {
                this.branches = data.data;
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
            this.loadBranches();
        });;
        this.loadBranches();
        getResults(page);
    },
};
</script>
