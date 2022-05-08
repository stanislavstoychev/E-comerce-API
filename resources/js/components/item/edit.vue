<template>
    <div>
        <div class="row">
            <router-link to="/item" class="btn btn-primary">All Itmes</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Item Update</h1>
                                    </div>
                                    <form class="user" @submit.prevent="itemUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Item name:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Item Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{errors.name[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Code:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your Item code" v-model="form.code">
                                                    <small class="text-danger" v-if="errors.code">
                                                        {{errors.code[0]}} </small>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Part</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.part_id">
                                                        <option v-for="part in parts" :value="part.id">
                                                            {{part.name}}</option>

                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Subcontractor</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.subcontractor_id">
                                                        <option v-for="subcontractor in subcontractors"
                                                            :value="subcontractor.id">{{subcontractor.name}}</option>

                                                    </select>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Buying price"
                                                        v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price">
                                                        {{errors.buying_price[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Selling price" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price">
                                                        {{errors.selling_price[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Enter Quantity"
                                                        v-model="form.quantity">
                                                    <small class="text-danger" v-if="errors.quantity">
                                                        {{errors.quantity[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Item root"
                                                        v-model="form.root">
                                                    <small class="text-danger" v-if="errors.root">
                                                        {{errors.root[0]}} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Buying Date:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Buying Date" v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date">
                                                        {{errors.buying_date[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            @change="onFileSelected">
                                                        <small class="text-danger" v-if="errors.newimage">
                                                            {{errors.newimage[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            image</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <img :src="form.image" style="height: 40px;width: 40px;">

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Update</button>
                                        </div>

                                    </form>
                                    <hr>
                                    <div class="text-center">

                                    </div>
                                    <div class="text-center">
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
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        let id = this.$route.params.id;
        axios.get('/api/item/' + id)
            .then(({
                data
            }) => {
                this.form = data
            })
            .catch(console.log('error'))

        axios.get('/api/part')
            .then(({
                data
            }) => {
                this.parts = data
            })
        axios.get('/api/subcontractor')
            .then(({
                data
            }) => {
                this.subcontractors = data
            })
    },
    data() {
        return {
            form: {
                part_id: '',
                name: '',
                code: '',
                buying_price: '',
                selling_price: '',
                subcontractor_id: '',
                image: '',
                newimage: '',
                quantity: '',
                root: '',
                buying_date: '',
            },
            errors: {},
            parts: {},
            subcontractors: {},
        }
    },
    methods: {
        itemUpdate() {
            let id = this.$route.params.id;

            axios.patch('/api/item/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "item"
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        onFileSelected(e) {
            let file = e.target.files[0];
            if (file.size > 6 * 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = e => {
                    this.form.newimage = e.target.result

                };
                reader.readAsDataURL(file);

            }

        }
    }
}
</script>

<style>










</style>