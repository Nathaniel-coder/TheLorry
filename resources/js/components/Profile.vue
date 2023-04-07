<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">

                        <div class="card card-widget widget-user">

                            <div class="widget-user-header text-white"
                                style="background: url('/img/photo4.jpg') center right;">
                                <h3 class="widget-user-username text-right">{{ user.name }}</h3>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"></h5>
                                            <span class="description-text">SALES</span>
                                        </div>

                                    </div>

                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">13,000</h5>
                                            <span class="description-text">FOLLOWERS</span>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">35</h5>
                                            <span class="description-text">PRODUCTS</span>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings"
                                            data-toggle="tab">Settings</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                        <form class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input v-model="form.name" class="form-control" type="text"
                                                        name="name" placeholder="Name"
                                                        :class="{ 'is-invalid': form.errors.has('name') }" />
                                                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputphone" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input v-model="form.phone" class="form-control" type="number"
                                                        name="phone" placeholder="Phone No."
                                                        :class="{ 'is-invalid': form.errors.has('phone') }" />
                                                        <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input v-model="form.email" class="form-control" type="email"
                                                        name="email" placeholder="Email"
                                                        :class="{ 'is-invalid': form.errors.has('email') }" />
                                                        <div v-if="form.errors.has('email')" v-html="form.errors.get('email')"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                                                <div class="col-sm-10">
                                                    <textarea v-model="form.bio" class="form-control" type="text"
                                                        name="bio" placeholder="Bio"
                                                        :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                                    <div v-if="form.errors.has('bio')" v-html="form.errors.get('bio')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Profile
                                                    Photo</label>
                                                <div class="col-sm-10">
                                                    <input type="file" @change="updateProfile" class="form-control-file"
                                                        id="inputName2">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills"
                                                    class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input v-model="form.password" class="form-control" type="password"
                                                        name="password" placeholder="Password"
                                                        :class="{ 'is-invalid': form.errors.has('password') }" />
                                                    <div v-if="form.errors.has('password')"
                                                        v-html="form.errors.get('password')"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="address1" class="pt-2">Address</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="address1" v-model="form.address1" class="form-control"
                                                        type="text" name="address1" placeholder="Address 1"
                                                        :class="{ 'is-invalid': form.errors.has('address1') }" />
                                                    <div v-if="form.errors.has('address1')"
                                                        v-html="form.errors.get('address1')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <!-- <label for="toAddress2" class="pt-2">Address 2 :</label> -->
                                                </div>
                                                <div class="col-lg-10 col-md-9 justify-content-end">
                                                    <input id="address2" v-model="form.address2" class="form-control"
                                                        type="text" name="toAddress2" placeholder="Address 2"
                                                        :class="{ 'is-invalid': form.errors.has('address2') }" />
                                                    <div v-if="form.errors.has('address2')"
                                                        v-html="form.errors.get('address2')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="Postcode" class="pt-2">Postcode</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="Postcode" v-model="form.postcode"
                                                        class="form-control" type="number" name="postcode"
                                                        placeholder="Postcode"
                                                        :class="{ 'is-invalid': form.errors.has('postcode') }" />
                                                    <div v-if="form.errors.has('postcode')"
                                                        v-html="form.errors.get('postcode')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="city" class="pt-2">City</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="city" v-model="form.city"
                                                        class="form-control" type="text" name="city"
                                                        placeholder="City"
                                                        :class="{ 'is-invalid': form.errors.has('city') }" />
                                                    <div v-if="form.errors.has('city')"
                                                        v-html="form.errors.get('city')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="Province" class="pt-2">Province</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="Province" v-model="form.province"
                                                        class="form-control" type="text" name="province"
                                                        placeholder="Province"
                                                        :class="{ 'is-invalid': form.errors.has('province') }" />
                                                    <div v-if="form.errors.has('province')"
                                                        v-html="form.errors.get('province')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="country" class="pt-2">Country</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <input id="country" v-model="form.country"
                                                        class="form-control" type="text" name="country"
                                                        placeholder="Country"
                                                        :class="{ 'is-invalid': form.errors.has('country') }" />
                                                    <div v-if="form.errors.has('country')"
                                                        v-html="form.errors.get('country')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> I agree to the <a href="#">terms and
                                                                conditions</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button @click.prevent="updateinfo" type="submit"
                                                        class="btn bg-green">update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5">
                        <div class="card card-info elevation-2">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>

                            <div class="card-body">
                                <strong><p><i class="fa-solid fa-user mr-2"></i>{{ user.name }}</p></strong>
                                <strong><p><i class="fa-solid fa-phone mr-2"></i>{{ user.phone }}</p></strong>
                                <strong><p><i class="fa-solid fa-envelope mr-2"></i>{{ user.email }}</p></strong>
                                <!-- <strong><p><i class="fa-solid fa-circle-info mr-2"></i>{{ user.bio }}</p></strong> -->
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                <p class="text-muted">{{ user.address1 }},<br> {{ user.address2 }},<br> {{ user.postcode }} {{ this.form.city }},<br> {{ this.form.province }}, {{ this.form.country }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Axios from 'axios';
import { Form } from "vform";
import Swal from 'sweetalert2';
export default {
    props: ['profile'],
    data() {
        return {
            penaltyCount: '',
            pickUpCount: '',
            dropOffCount: '',
            user:{},
            shop:{},
            form: new Form({
                id: "",
                name: "",
                phone: "",
                email: "",
                password: "",
                type: "",
                bio: "",
                photo: "",
                address1: "",
                address2: "",
                postcode: "",
                city: "",
                province: "",
                country: ""
            })
        }
    },
    mounted() {
        console.log('Component Mounted')
    },
    methods: {
        getProfilePhoto() {
            let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/" + this.form.photo;
            return photo;
        },
        updateinfo() {
            this.$Progress.start();
            this.form.put('api/profile/').then(() => {
                Swal.fire({
                    title: "Successfully Updated",
                    text: "Your profile will be updated soon",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#0d6efd",
                    confirmButtonText: "ok",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$Progress.finish();
                        Fire.$emit("AfterCreated");
                        location.reload();
                    }
                })
            }).catch(() => {
                this.$Progress.fail();
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You have yet to fill in all the required details",
                }); $Progress.fail();
            });
        },
        updateProfile(e) {
            // console.log("updating");
            let file = e.target.files[0];
            var reader = new FileReader();
            let vm = this;
            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result)
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You are uploading a large file.",
                });
            }
        },
        RIC(){
            window.location.href = "receipt&Invoice"
        },
    },
    created() {
        Axios.get("api/profile").then(({ data }) => this.form.fill(data));
        Axios.get("api/profile").then(({ data }) => this.user=data);
    }
}
</script>
