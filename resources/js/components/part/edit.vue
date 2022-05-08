<template>
    <div>
        <div class="row">
            <router-link to="/part" class="btn btn-primary">All Parts</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Part Update</h1>
                                    </div>
                                    <form class="user" @submit.prevent="partUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Part Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{errors.name[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter abreviation" v-model="form.abreviation">
                                                    <small class="text-danger" v-if="errors.part">
                                                        {{errors.abreviation[0]}} </small>
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
        axios.get('/api/part/' + id)
            .then(({
                data
            }) => {
                this.form = data
            })
            .catch(console.log('error'))
    },
    data() {
        return {
            form: {
                name: '',
                abreviation: '',

            },
            errors: {}
        }
    },
    methods: {
        partUpdate() {
            let id = this.$route.params.id;

            axios.patch('/api/part/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "part"
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },

    }
}
</script>

<style>



</style>
