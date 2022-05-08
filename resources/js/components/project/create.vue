<template>
    <div>
        <div class="row">
            <router-link to="/project" class="btn btn-primary">All Projects</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Project</h1>
                                    </div>
                                    <form class="user" @submit.prevent="projectInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Project Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{errors.name[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Enter address"
                                                        v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address">
                                                        {{errors.address[0]}} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter abreviation" v-model="form.abreviation">
                                                    <small class="text-danger" v-if="errors.abreviation">
                                                        {{errors.abreviation[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Project Cost" v-model="form.cost">
                                                    <small class="text-danger" v-if="errors.cost"> {{errors.cost[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter start date" v-model="form.start_date">
                                                    <small class="text-danger" v-if="errors.start_date">
                                                        {{errors.start_date[0]}} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            @change="onFileSelected">
                                                        <small class="text-danger" v-if="errors.photo">
                                                            {{errors.photo[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            image</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <img :src="form.photo" style="height: 40px;width: 40px;">

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
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
    },
    data() {
        return {
            form: {
                name: null,
                abreviation: null,
                address: null,
                cost: null,
                start_date: null,
                photo: null,
            },
            errors: {}
        }
    },
    methods: {
        projectInsert() {
            axios.post('/api/project', this.form)
                .then(() => {
                    this.$router.push({
                        name: "project"
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
                    this.form.photo = e.target.result

                };
                reader.readAsDataURL(file);

            }

        },
    }
}
</script>

<style>






</style>
