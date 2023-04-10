<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 v-show="profile.type=='Staff'">User Management</h1>
                        <h1 v-show="profile.type=='Administrator'">Staff Management</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="justify-content-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" v-show="profile.type=='Staff'">Users</h3>
                                <h3 class="card-title" v-show="profile.type=='Administrator'">Staff</h3>
                                <div class="card-tools">
                                    <button class="btn bg-blue" type="button" data-toggle="modal" data-target="#CreateEdit"
                                        @click="newModal()" toggle="tooltip" title="Create Staff">
                                        <i class="fa-solid fa-plus icon-btn-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-wrap">
                                    <thead>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date Joined</th>
                                            <th>Status</th>
                                            <th>Branch</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-widget="table-hover" aria-expanded="false" v-for="user in users.data"
                                            :key="user.id">
                                            <td class="text-capitalize" v-show="user.type!='Customer' && user.type!='Merchant'">
                                                {{ user.type.charAt(0) }}{{ user.type.charAt(6) == "F" || user.type.charAt(6)
                                                    == "R"
                                                    || user.type.charAt(6) == "O" || user.type.charAt(6) == "E" ?
                                                    user.type.charAt(6) : ""
                                                }}
                                                {{ user.type.charAt(5) == "T" ? user.type.charAt(5) : "" }}-{{
                                                    user.id
                                                }}
                                            </td>
                                            <td v-show="user.type=='Customer' || user.type=='Merchant'"></td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td v-show="user.type!='Customer'">{{ user.created_at | myDate }}</td>
                                            <td v-show="user.type=='Customer'"></td>
                                            <td>{{ user.type | upText }}</td>
                                            <td>{{ user.branch }}</td>
                                            <td v-show="profile.type =='Administrator'">
                                                <button class="btn bg-orange" @click="editModal(user)" toggle="tooltip"
                                                    title="Edit Staff">
                                                    <i class="fa-solid fa-pen-to-square text-light"></i>
                                                </button>
                                                <button class="btn bg-red" @click="deleteUser(user.id)" toggle="tooltip"
                                                    title="Delete Staff">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" v-show="users">
                                <pagination class="nav-item" :data="users" @change-page="getResults"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create/Edit Modal -->
        <div class="modal fade" id="CreateEdit" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="staticBackdropLabel">
                            Create New Staff
                        </h5>
                        <h5 class="modal-title" v-show="editmode" id="staticBackdropLabel">
                            Update Staff
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? UpdateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" class="form-control" type="text" name="name" placeholder="Name"
                                    :class="{ 'is-invalid': form.errors.has('name') }" />
                                <div v-if="form.errors.has('name')" v-html="form.errors.get('name')"></div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" class="form-control" type="email" name="email"
                                    placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }" />
                                <div v-if="form.errors.has('email')" v-html="form.errors.get('email')"></div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" class="form-control" type="password" name="password"
                                    placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }" />
                                <div v-if="form.errors.has('password')" v-html="form.errors.get('password')"></div>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select v-model="form.type" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option selected>{{ form.type }}</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Part-Timer">Part-Timer</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Merchant">Merchant</option>
                                </select>
                                <div v-if="form.errors.has('type')" v-html="form.errors.get('type')"></div>

                            </div>
                            <div class="form-group">
                                <label>Situated</label>
                                <select v-model="form.branch" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('branch') }">
                                    <option selected v-show="form.branch">{{ form.branch ? form.branch : "" }}</option>
                                    <option v-for="branch in branches" :key="branch.id">{{ branch.branch }} {{ branch.city }},{{ branch.province }},{{ branch.country }}</option>
                                </select>
                                <div v-if="form.errors.has('branch')" v-html="form.errors.get('branch')"></div>

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
    props:['profile'],
    data() {
        return {
            editmode: false,
            users: {},
            branches:{},
            form: new Form({
                id: "",
                name: "",
                email: "",
                password: "",
                type: "",
                branch: "",
                photo: "",
            }),
        };
    },
    methods: {
        getResults(page) {
            axios.get('api/user?page=' + page).then(response => {
                this.users = response.data;
            })
        },
        editModal(user) {
            this.editmode = true;
            this.form.reset();
            $("#CreateEdit").modal("show");
            this.form.fill(user);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#CreateEdit").modal("show");
        },
        UpdateUser() {
            this.$Progress.start();
            this.form
                .put("api/user/" + this.form.id)
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
        createUser() {
            this.$Progress.start();

            this.form
                .post("api/user")
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.name + " is now " + this.form.type,
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
        loadusers() {
            axios.get("api/user").then(({ data }) => (this.users = data));
            axios.get("api/branches").then(({data}) => (this.branches = data));
        },
        deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    this.form.delete("api/user/" + id).then(() => {
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
            axios.get('api/findUser?q=' + query).then((data) => {
                this.users = data.data;
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
            this.loadusers();
        });;
        this.loadusers();
        getResults(page);
    },
};
</script>
