<template>
    <div>
        <div class="row">
            <router-link to="/rfi" class="btn btn-primary">All RFI's</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Show RFI</h1>
                                    </div>
                                    <form class="user" @submit.prevent="rfiInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Project: {{rfi.project}}
                                                    </label>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Structure: {{rfi.structure}}
                                                    </label>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Substructure: {{rfi.substructure}}
                                                    </label>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Part: {{rfi.part}}
                                                    </label>

                                                </div>



                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Step: {{rfi.step}}</label>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Inspection Date: {{rfi.date}}
                                                    </label>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Inspection Time: {{rfi.time}}
                                                    </label>

                                                </div>


                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">
                                                Submit
                                            </button>
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
        //security token
        let token = localStorage.getItem('token')

        axios.defaults.headers.common['Content-Type'] = 'application/json'
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
        // end security token
        let id = this.$route.params.id

        axios.get('/api/rfi/' + id).then(({
            data
        }) => {
            this.rfi = data
        })



        axios.get('/api/part').then(({
            data
        }) => {
            this.parts = data
        })


    },
    data() {
        return {
            rfi: [],
            errors: {},
            projects: {},
            structures: {},
            substructures: {},
            parts: {},
            steps: {},
            subcontractors: {},
        }
    },
    methods: {
        projectSelected() {
            axios.get('/api/structure/' + this.form.project_id).then(({
                data
            }) => {
                this.structures = data
            })

            axios.get('/api/substructure/' + this.form.project_id).then(({
                data
            }) => {
                this.substructures = data
            })
        },
        getSteps() {
            axios.get('/api/step/' + this.form.part_id).then(({
                data
            }) => {
                this.steps = data
            })
        },
        rfiInsert() {

            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            // end security token

            axios.post('/api/rfi', this.form)
                .then((rfi) => {
                    this.$router.push({
                        name: "show-rfi",
                        params: {
                            id: rfi.id
                        }
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
                    this.form.image = e.target.result

                };
                reader.readAsDataURL(file);

            }

        },

    }
}
</script>

<style>










</style>