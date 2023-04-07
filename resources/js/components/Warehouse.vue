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
                        </div>
                    </div>
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
            user: {},
            branches: {},
            form: new Form({
                id: '',
                category: '',
                quantity: '',
                weight: '',
                height: '',
                length: '',
                width: '',
                shopname: '',
                niche: '',
                companyliscence: '',
                branchid: ''
            }),
        };
    },
    methods: {
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
                    $("#Create").modal("hide");
                }).catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                    this.$Progress.fail();
                });
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    created() {
        axios.get("api/profile").then(({ data }) => this.user = data);
        Axios.get("api/profile").then(({ data }) => this.form.fill(data));
        axios.get("api/branches").then(({ data }) => (this.branches = data));
        this.confirm();
    }
}
</script>
