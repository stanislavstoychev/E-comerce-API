<template>

    <div>

        <div class="row">
            <router-link to="/salary" class="btn btn-primary">Go Back </router-link>

        </div>



        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> Update Salary</h1>
                                    </div>

                                    <form class="user" @submit.prevent="salaryUpdate">

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Name:</label>

                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Full Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }}
                                                    </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <label>Email:</label>

                                                    <input type="email" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Email" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email">
                                                        {{ errors.email[0] }} </small>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">

                                                    <label>Month:</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.salary_month">
                                                        <option value="Jan">Jan</option>
                                                        <option value="Feb">Feb</option>
                                                        <option value="Mar">Mar</option>
                                                        <option value="Apr">Apr</option>
                                                        <option value="May">May</option>
                                                        <option value="Jun">Jun</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="Sept">Sept</option>
                                                        <option value="Oct">Oct</option>
                                                        <option value="Nov">Nov</option>
                                                        <option value="Dec">Dec</option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.slary_month">
                                                        {{ errors.salary_month[0] }} </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="hidden" v-model="form.employee_id">
                                                    <label>Amount:</label>

                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Sallery" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">
                                                        {{ errors.amount[0] }} </small>
                                                </div>

                                            </div>
                                        </div>






                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Edit</button>
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



<script type="text/javascript">
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        let id = this.$route.params.id
        axios.get('/api/edit/slary/' + id)
            .then(({
                data
            }) => (this.form = data))
            .catch(console.log('error'))
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                salsry_month: '',
                amount: '',
                employee_id: '',

            },
            errors: {}
        }
    },

    methods: {

        salaryUpdate() {
            let id = this.$route.params.id
            axios.post('/api/salary/update/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: 'salary'
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }

}
</script>


<style type="text/css">

</style>