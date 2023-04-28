<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Warehouse</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" v-show="user.type == 'Customer'">
            <div class="d-flex justify-content-center align-items-center">
                <h3>You are not a Merchant yet!</h3>
            </div>
        </div>

        <div class="container" v-show="user.type != 'Customer'">
            <div class="justify-content-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Warehouse</h3>
                                <div class="card-tools">
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool bg-green" toggle="tooltip"
                                            title="Generate CSV" @click="generateCSV()">
                                            <i class="fa-solid fa-file-excel text-white"></i>
                                        </button>
                                    </div>
                                    <button class="btn bg-blue" type="button" data-toggle="modal" data-target="#CreateEdit"
                                        @click="newModal()" toggle="tooltip" title="Create Staff"
                                        v-show="user.type == 'Merchant'">
                                        <i class="fa-solid fa-plus icon-btn-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Product Type</th>
                                            <th>Quantity</th>
                                            <th>Weight(KG)</th>
                                            <th>Height(CM)</th>
                                            <th>Length(CM)</th>
                                            <th>Width(CM)</th>
                                            <th v-show="user.type != 'Merchant'">Merchant</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in items.data" :key="item.id">
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.category }}</td>
                                            <td>{{ item.quantity }}</td>
                                            <td>{{ item.weight }}</td>
                                            <td>{{ item.height }}</td>
                                            <td>{{ item.length }}</td>
                                            <td>{{ item.width }}</td>
                                            <td v-show="user.type != 'Merchant'">{{ item.user }}</td>
                                            <td>
                                                <button class="btn bg-orange" toggle="tooltip" title="Edit Staff"
                                                    @click="editModal(item)" v-show="user.type == 'Merchant'">
                                                    <i class="fa-solid fa-pen-to-square text-light"></i>
                                                </button>
                                                <button class="btn bg-red" toggle="tooltip" title="Delete Staff"
                                                    @click="deleteItem(item.id)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" v-show="items">
                                <pagination class="nav-item" :data="items" @change-page="getResults"></pagination>
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
                            Create new Item
                        </h5>
                        <h5 class="modal-title" v-show="editmode" id="staticBackdropLabel">
                            Update Items
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateItem() : createItem()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" class="form-control" type="text" name="name" placeholder="Name"
                                    :class="{ 'is-invalid': form.errors.has('name') }" />
                                <div v-if="form.errors.has('name')" v-html="form.errors.get('name')"></div>
                            </div>
                            <!-- <div class="form-group">
                            <input v-model="form.id" class="form-control" type="text" name="id"
                                placeholder="Name" :class="{ 'is-invalid': form.errors.has('id') }"/>
                            <div v-if="form.errors.has('id')" v-html="form.errors.get('id')"></div>
                        </div> -->
                            <div class="form-group">
                                <label>Category</label>
                                <input v-model="form.category" class="form-control" type="text" name="category"
                                    placeholder="Category" :class="{ 'is-invalid': form.errors.has('category') }" />
                                <div v-if="form.errors.has('category')" v-html="form.errors.get('category')"></div>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input v-model="form.quantity" class="form-control" type="text" name="quantity"
                                    placeholder="Quantity" :class="{ 'is-invalid': form.errors.has('quantity') }" />
                                <div v-if="form.errors.has('quantity')" v-html="form.errors.get('quantity')"></div>
                            </div>
                            <div class="form-group">
                                <label>Weight</label>
                                <input v-model="form.weight" class="form-control" type="text" name="weight"
                                    placeholder="Weight(kg)" :class="{ 'is-invalid': form.errors.has('weight') }"
                                    pattern="^\d*(\.\d{0,2})?$" />
                                <div v-if="form.errors.has('weight')" v-html="form.errors.get('weight')"></div>
                            </div>
                            <div class="form-group">
                                <label>Height</label>
                                <input v-model="form.height" class="form-control" type="text" name="height"
                                    placeholder="Height(cm)" :class="{ 'is-invalid': form.errors.has('height') }"
                                    pattern="^\d*(\.\d{0,2})?$" />
                                <div v-if="form.errors.has('height')" v-html="form.errors.get('height')"></div>
                            </div>
                            <div class="form-group">
                                <label>Length</label>
                                <input v-model="form.length" class="form-control" type="text" name="length"
                                    placeholder="length(cm)" :class="{ 'is-invalid': form.errors.has('length') }"
                                    pattern="^\d*(\.\d{0,2})?$" />
                                <div v-if="form.errors.has('length')" v-html="form.errors.get('length')"></div>
                            </div>
                            <div class="form-group">
                                <label>width</label>
                                <input v-model="form.width" class="form-control" type="text" name="width"
                                    placeholder="width(cm)" :class="{ 'is-invalid': form.errors.has('width') }"
                                    pattern="^\d*(\.\d{0,2})?$" />
                            </div>

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

        <div class="modal fade" id="Create" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Sign Up
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="newMerchant()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Shop Name</label>
                                <input v-model="form.shopname" class="form-control" type="text" name="shopname"
                                    placeholder="Shop Name" :class="{ 'is-invalid': form.errors.has('shopname') }" />
                                <div v-if="form.errors.has('shopname')" v-html="form.errors.get('shopname')"></div>
                            </div>
                            <div class="form-group">
                                <label>Niche</label>
                                <select v-model="form.niche" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('niche') }" name="niche">
                                    <option selected>{{ form.niche }}</option>
                                    <option value="Acne and Skin Care">Acne and Skin Care</option>
                                    <option value="Books and Fiction">Books and Fiction</option>
                                    <option value="Cooking Utensils">Cooking Utensils</option>
                                    <option value="Fashion and Accessories">Fashion and Accessories</option>
                                    <option value="Makeup and Beauty">Makeup and Beauty</option>
                                    <option value="Outdoors and Hiking">Outdoors and Hiking</option>
                                    <option value="Pets and Animal Care">Pets and Animal Care</option>
                                    <option value="Technology and Gadgets">Technology and Gadgets</option>
                                </select>
                                <div v-if="form.errors.has('niche')" v-html="form.errors.get('niche')"></div>
                            </div>
                            <div class="form-group">
                                <label>Company Liscence</label>
                                <input v-model="form.companyliscence" class="form-control" type="text"
                                    name="companyliscence" placeholder="Company Liscence"
                                    :class="{ 'is-invalid': form.errors.has('companyliscence') }" />
                                <div v-if="form.errors.has('companyliscence')" v-html="form.errors.get('companyliscence')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Situated</label>
                                <select v-model="form.branchid" class="form-control" aria-label="Default select example"
                                    :class="{ 'is-invalid': form.errors.has('branchid') }">
                                    <option selected v-show="form.branchid">{{ form.branchid ? form.branchid : "" }}
                                    </option>
                                    <option v-for="branch in branches" :key="branch.id">{{ branch.branch }} {{ branch.city
                                    }},{{ branch.province }},{{ branch.country }}</option>
                                </select>
                                <div v-if="form.errors.has('branchid')" v-html="form.errors.get('branchid')"></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn bg-blue">
                                    Create
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
import Axios from 'axios';
import Swal from "sweetalert2";
import { Form } from "vform";
export default {
    props: ['profile'],
    data() {
        return {
            editmode: false,
            user: {},
            branches: {},
            items: {},
            shop: {},
            form: new Form({
                id: '',
                name: '',
                category: '',
                quantity: '',
                weight: '',
                height: '',
                length: '',
                width: '',
                shopname: '',
                niche: '',
                companyliscence: '',
                // branchid: ''
            }),
        };
    },
    methods: {
        getResults(page) {
            axios.get('api/warehouse?page=' + page).then(response => {
                this.warehouses = response.data;
            })
        },
        confirm() {
            if (this.profile.type == "Customer") {
                Swal.fire({
                    title: "Wait!",
                    text: "You are not a Merchant yet!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0d6efd",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sign me Up!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#Create").modal("show");
                    }
                });
            }
        },
        newMerchant() {
            this.form.post("api/shop")
                .then(() => {
                    this.$Progress.finish();
                    Fire.$emit("AfterCreated");
                    $("#Create").modal("hide");
                    location.refresh();
                }).catch(() => {
                    this.$Progress.fail();
                });
        },
        createItem() {
            this.form.post("api/warehouse")
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: this.form.name,
                        text: "is created!",
                        showConfirmButton: true,
                        timer: 1500,
                    });
                    this.$Progress.finish();
                    Fire.$emit("AfterCreated");
                    $("#CreateEdit").modal("hide");
                }).catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                    this.$Progress.fail();
                });
        },
        editModal(item) {
            this.editmode = true;
            this.form.reset();
            $("#CreateEdit").modal("show");
            this.form.fill(item);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#CreateEdit").modal("show");
        },
        updateItem() {
            this.$Progress.start();
            this.form
                .put("api/warehouse/" + this.form.id)
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
        deleteItem(id) {
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
                    this.form.delete("api/warehouse/" + id).then(() => {
                        Swal.fire("Deleted!", "Your item has been deleted.", "success");
                    });
                    this.$Progress.finish();
                }
                Fire.$emit("AfterCreated");
            });
        },
        loadall() {
            Axios.get("api/warehouse").then(({ data }) => (this.items = data));
        },
        generateCSV() {
            Axios.get("/warehouseCSV", {responseType: 'arraybuffer'}).then(response => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'Warehouse.xlsx');
                document.body.appendChild(fileLink);
                fileLink.click();
            })
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    created() {
        // Axios.get("api/profile").then(({ data }) => this.form.fill(data));
        this.loadall();
        this.getResults();
        axios.get("api/profile").then(({ data }) => this.user = data);
        Axios.get("api/branches").then(({ data }) => (this.branches = data));
        // Axios.get("api/shopIndex").then(({data}) => this.form. = data.id);
        this.confirm();
        Fire.$on("AfterCreated", () => {
            this.loadall();
        });
    }
}
</script>
