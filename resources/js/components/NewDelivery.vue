<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ mode }}</h1>
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
                                {{ mode }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card pointer" @click="drop()">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center py-4"><i class="fa-solid fa-shop icon-size"></i></div>
                                                <p class="text-center pl-4">Drop Off</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card pointer" @click="pick()">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center py-4"><i class="fa-solid fa-truck-ramp-box icon-size"></i></div>
                                                <p class="text-center pl-4">Pick Up</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form @submit.prevent="createDropOff" v-show="dropOff==true">
                            <div class="row d-flex justify-content-around">
                                <div class="card card-body col-5 col-md-5">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <label for="date" class="pt-2">Date :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-9">
                                            <input id="date" v-model="form.date" class="form-control" type="date" name="date"
                                                placeholder="Date" :class="{ 'is-invalid': form.errors.has('date') }" />
                                            <div v-if="form.errors.has('date')" v-html="form.errors.get('date')"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-around">
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header"><b>From</b></div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Country :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="name" v-model="form.country" class="form-control" type="text"
                                                        name="name" placeholder="Country"
                                                        :class="{ 'is-invalid': form.errors.has('country') }" />
                                                    <div v-if="form.errors.has('country')" v-html="form.errors.get('country')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="name" class="pt-2">Name :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="name" v-model="form.name" class="form-control" type="text"
                                                        name="name" placeholder="Name"
                                                        :class="{ 'is-invalid': form.errors.has('name') }" />
                                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="phone" class="pt-2">Phone :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="phone" v-model="form.phone" class="form-control" type="text"
                                                        name="phone" placeholder="Phone No."
                                                        :class="{ 'is-invalid': form.errors.has('phone') }" />
                                                    <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="branch" class="pt-2">Branch :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <select id="branch" v-model="form.branch" class="form-control"
                                                        aria-label="Default select example"
                                                        :class="{ 'is-invalid': form.errors.has('branch') }">
                                                        <option v-for="branch in branches" :key="branch.id" v-show="branch.country == form.country">{{ branch.branch }}, {{
                                                            branch.province }}, {{ branch.country }}</option>
                                                    </select>
                                                    <div v-if="form.errors.has('branch')" v-html="form.errors.get('branch')">
                                                    </div>
                                                    <!-- <fieldset v-show="form.country">{{ branch.address1 }},{{ branch.address2 }},{{ branch.postcode }},{{ branch.province }},{{ branch.country }}</fieldset> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <div class="card">
                                        <div class="card-header"><b>To</b></div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toName" class="pt-2">Name :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toName" v-model="form.toName" class="form-control" type="text"
                                                        name="toName" placeholder="Name"
                                                        :class="{ 'is-invalid': form.errors.has('toName') }" />
                                                    <div v-if="form.errors.has('toName')" v-html="form.errors.get('toName')"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toPhone" class="pt-2">Phone :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toPhone" v-model="form.toPhone" class="form-control" type="number"
                                                        name="toPhone" placeholder="Phone No."
                                                        :class="{ 'is-invalid': form.errors.has('toPhone') }" />
                                                    <div v-if="form.errors.has('toPhone')" v-html="form.errors.get('toPhone')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toAddress1" class="pt-2">Address:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toAddress1" v-model="form.toAddress1" class="form-control"
                                                        type="text" name="toAddress1" placeholder="Address 1"
                                                        :class="{ 'is-invalid': form.errors.has('toAddress1') }" />
                                                    <div v-if="form.errors.has('toAddress1')"
                                                        v-html="form.errors.get('toAddress1')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <!-- <label for="toAddress2" class="pt-2">Address 2 :</label> -->
                                                </div>
                                                <div class="col-lg-10 col-md-9 justify-content-end">
                                                    <input id="toAddress2" v-model="form.toAddress2" class="form-control"
                                                        type="text" name="toAddress2" placeholder="Address 2"
                                                        :class="{ 'is-invalid': form.errors.has('toAddress2') }" />
                                                    <div v-if="form.errors.has('toAddress2')"
                                                        v-html="form.errors.get('toAddress2')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toPostcode" class="pt-2">Postcode:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toPostcode" v-model="form.toPostcode" class="form-control"
                                                        type="number" name="toPostcode" placeholder="Postcode"
                                                        :class="{ 'is-invalid': form.errors.has('toPostcode') }" />
                                                    <div v-if="form.errors.has('toPostcode')"
                                                        v-html="form.errors.get('toPostcode')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toCity" class="pt-2">City:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toCity" v-model="form.toCity" class="form-control" type="text"
                                                        name="toCity" placeholder="City"
                                                        :class="{ 'is-invalid': form.errors.has('toCity') }" />
                                                    <div v-if="form.errors.has('toCity')" v-html="form.errors.get('toCity')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toProvice" class="pt-2">Provice:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toProvince" v-model="form.toProvince" class="form-control"
                                                        type="text" name="toProvince" placeholder="Province"
                                                        :class="{ 'is-invalid': form.errors.has('toProvince') }" />
                                                    <div v-if="form.errors.has('toProvince')"
                                                        v-html="form.errors.get('toProvince')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toCountry" class="pt-2">Country :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <select id="toCountry" v-model="form.toCountry" class="form-control"
                                                        aria-label="Default select example"
                                                        :class="{ 'is-invalid': form.errors.has('toCountry') }">
                                                        <option v-for="branch in branches" :key="branch.id">{{ branch.country }}</option>
                                                    </select>
                                                    <div v-if="form.errors.has('toCountry')" v-html="form.errors.get('toCountry')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            <button class="btn bg-blue" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form @submit.prevent="createPickUp" v-show="pickUp==true">
                            <div class="row d-flex justify-content-around">
                                <div class="card card-body col-5 col-md-5">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <label for="date" class="pt-2">Date :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-9">
                                            <input id="date" v-model="form.date" class="form-control" type="date" name="date"
                                                placeholder="Date" :class="{ 'is-invalid': form.errors.has('date') }" />
                                            <div v-if="form.errors.has('date')" v-html="form.errors.get('date')"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-around">
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header"><b>From</b></div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Country :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="name" v-model="form.country" class="form-control" type="text"
                                                        name="name" placeholder="Country"
                                                        :class="{ 'is-invalid': form.errors.has('country') }" />
                                                    <div v-if="form.errors.has('country')" v-html="form.errors.get('country')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="name" class="pt-2">Name :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="name" v-model="form.name" class="form-control" type="text"
                                                        name="name" placeholder="Name"
                                                        :class="{ 'is-invalid': form.errors.has('name') }" />
                                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="phone" class="pt-2">Phone :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="phone" v-model="form.phone" class="form-control" type="text"
                                                        name="phone" placeholder="Phone No."
                                                        :class="{ 'is-invalid': form.errors.has('phone') }" />
                                                    <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Address :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="address1" v-model="form.address1" class="form-control" type="text"
                                                        name="address1" placeholder="Address 1"
                                                        :class="{ 'is-invalid': form.errors.has('address1') }" />
                                                    <div v-if="form.errors.has('address1')" v-html="form.errors.get('address1')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <!-- <label for="country" class="pt-2">Address 2 :</label> -->
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="address2" v-model="form.address2" class="form-control" type="text"
                                                        name="address2" placeholder="Address 2"
                                                        :class="{ 'is-invalid': form.errors.has('address2') }" />
                                                    <div v-if="form.errors.has('address2')" v-html="form.errors.get('address2')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Postcode:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="postcode" v-model="form.postcode" class="form-control" type="text"
                                                        name="postcode" placeholder="postcode"
                                                        :class="{ 'is-invalid': form.errors.has('postcode') }" />
                                                    <div v-if="form.errors.has('postcode')" v-html="form.errors.get('postcode')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">City :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="city" v-model="form.city" class="form-control" type="text"
                                                        name="city" placeholder="City"
                                                        :class="{ 'is-invalid': form.errors.has('city') }" />
                                                    <div v-if="form.errors.has('city')" v-html="form.errors.get('city')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Province :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="province" v-model="form.province" class="form-control" type="text"
                                                        name="province" placeholder="Province"
                                                        :class="{ 'is-invalid': form.errors.has('province') }" />
                                                    <div v-if="form.errors.has('city')" v-html="form.errors.get('province')">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <div class="card">
                                        <div class="card-header"><b>To</b></div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toName" class="pt-2">Name :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toName" v-model="form.toName" class="form-control" type="text"
                                                        name="toName" placeholder="Name"
                                                        :class="{ 'is-invalid': form.errors.has('toName') }" />
                                                    <div v-if="form.errors.has('toName')" v-html="form.errors.get('toName')"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toPhone" class="pt-2">Phone :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toPhone" v-model="form.toPhone" class="form-control" type="number"
                                                        name="toPhone" placeholder="Phone No."
                                                        :class="{ 'is-invalid': form.errors.has('toPhone') }" />
                                                    <div v-if="form.errors.has('toPhone')" v-html="form.errors.get('toPhone')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toAddress1" class="pt-2">Address:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toAddress1" v-model="form.toAddress1" class="form-control"
                                                        type="text" name="toAddress1" placeholder="Address 1"
                                                        :class="{ 'is-invalid': form.errors.has('toAddress1') }" />
                                                    <div v-if="form.errors.has('toAddress1')"
                                                        v-html="form.errors.get('toAddress1')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <!-- <label for="toAddress2" class="pt-2">Address 2 :</label> -->
                                                </div>
                                                <div class="col-lg-10 col-md-9 justify-content-end">
                                                    <input id="toAddress2" v-model="form.toAddress2" class="form-control"
                                                        type="text" name="toAddress2" placeholder="Address 2"
                                                        :class="{ 'is-invalid': form.errors.has('toAddress2') }" />
                                                    <div v-if="form.errors.has('toAddress2')"
                                                        v-html="form.errors.get('toAddress2')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toPostcode" class="pt-2">Postcode:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toPostcode" v-model="form.toPostcode" class="form-control"
                                                        type="number" name="toPostcode" placeholder="Postcode"
                                                        :class="{ 'is-invalid': form.errors.has('toPostcode') }" />
                                                    <div v-if="form.errors.has('toPostcode')"
                                                        v-html="form.errors.get('toPostcode')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toCity" class="pt-2">City:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toCity" v-model="form.toCity" class="form-control" type="text"
                                                        name="toCity" placeholder="City"
                                                        :class="{ 'is-invalid': form.errors.has('toCity') }" />
                                                    <div v-if="form.errors.has('toCity')" v-html="form.errors.get('toCity')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toProvice" class="pt-2">Provice:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="toProvince" v-model="form.toProvince" class="form-control"
                                                        type="text" name="toProvince" placeholder="Province"
                                                        :class="{ 'is-invalid': form.errors.has('toProvince') }" />
                                                    <div v-if="form.errors.has('toProvince')"
                                                        v-html="form.errors.get('toProvince')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="toCountry" class="pt-2">Country :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <select id="toCountry" v-model="form.toCountry" class="form-control"
                                                        aria-label="Default select example"
                                                        :class="{ 'is-invalid': form.errors.has('toCountry') }">
                                                        <option v-for="branch in branches" :key="branch.id">{{ branch.Country }}
                                                        </option>
                                                    </select>
                                                    <div v-if="form.errors.has('toCountry')" v-html="form.errors.get('toCountry')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            <button class="btn bg-blue" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
import Swal from "sweetalert2";
import Axios from 'axios';
export default {
    data() {
        return {
            mode: 'New Delivery',
            dropOff: false,
            pickUp: false,
            branches: {},
            users: {},
            form: new Form({
                date: "",
                name: "",
                phone: "",
                country: "",
                address1: "",
                address2: "",
                postcode: "",
                city: "",
                province: "",
                toName: "",
                toPhone: "",
                toAddress1: "",
                toAddress2: "",
                toPostcode: "",
                toCity: "",
                toProvince: "",
                toCountry: "",
            })
        }
    },
    methods:{
        drop(){
            if(this.dropOff == false){
                this.dropOff = true;
                this.mode = 'Drop Off';
            }else{
                this.dropOff = false;
                this.mode = 'New Delivery';
            }
        },
        pick(){
            if(this.pickUp == false){
                this.pickUp = true;
                this.mode = 'Pick Up';
            }else{
                this.pickUp = false;
                this.mode = 'New Delivery';
            }
        },
        createDropOff() {
            this.$Progress.start();
            this.form.post('api/dropOff').then(({ data }) => {
                Swal.fire({
                    icon: "success",
                    title: "Created",
                    text: "Redirecting to payment page"
                })
                this.$Progress.finish();
                this.$router.push('/invoiceD');
            }).catch(() => {
                this.$Progress.fail();
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: "Something went wrong"
                })
            })

        },
        createPickUp(){
            this.$Progress.start();
            this.form.post('api/pickUp').then(({ data }) => {
                Swal.fire({
                    icon: "success",
                    title: "Created",
                    text: "Redirecting to payment page"
                })
                this.$Progress.finish();
                this.$router.push('/invoiceP');
            }).catch(() => {
                this.$Progress.fail();
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: "Something went wrong"
                })
            })
        },
        load() {
            // Axios.get('api/profile').then(({ data }) => this.form.fill(data));
            Axios.get('api/Branches').then(({ data }) => (this.branches = data));
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    created() {
        this.load();
        Axios.get("api/profile").then(({ data }) => this.form.fill(data));
    }
}
</script>
