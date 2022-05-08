<template>
    <div>
        <div class="row">
            <router-link to="/part" class="btn btn-primary">All Part</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Part</h1>
                                    </div>
                                    <form class="user" @submit.prevent="partInsert">
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
                                                    <small class="text-danger" v-if="errors.abreviation">
                                                        {{errors.abreviation[0]}} </small>
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
            },
            errors: {}
        }
    },
    methods: {
        partInsert() {
            axios.post('/api/part', this.form)
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
