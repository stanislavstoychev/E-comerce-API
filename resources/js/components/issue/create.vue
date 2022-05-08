<template>
    <div>
        <div class="row">
            <router-link to="/issue" class="btn btn-primary">All Issues</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">New Issue</h1>
                                    </div>
                                    <form class="user" @submit.prevent="issueInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.project_id">
                                                        <option v-for="project in projects" :value="project.id">
                                                            {{project.abreviation}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.project_id">
                                                        {{errors.project_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Title:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.title">
                                                    <small class="text-danger" v-if="errors.title">
                                                        {{errors.title[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextarea1">Details:</label>
                                                             <vue-editor v-model='form.details'></vue-editor>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Priority</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.priority">
                                                        <option value="1-Top">1-Top</option>
                                                        <option value="2-High">2-High</option>
                                                        <option value="3-Normal">3-Normal</option>
                                                        <option value="4-Low">4-Low</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.priority">
                                                        {{errors.priority[0]}}
                                                    </small>
                                                </div>





                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Identified:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Date Identified" v-model="form.identified">
                                                    <small class="text-danger" v-if="errors.identified">
                                                        {{errors.identified[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Completed:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Completion Date" v-model="form.completed">
                                                    <small class="text-danger" v-if="errors.completed">
                                                        {{errors.completed[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Status:</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.status">
                                                        <option value="Open">Open</option>
                                                        <option value="On hold">On hold</option>
                                                        <option value="Closed">Closed</option>
                                                        <option value="Cancel">Cancel</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.ststus">
                                                        {{errors.status[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                <label for="exampleFormControlSelect1">
                                                        Responsible:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.responsible">
                                                    <small class="text-danger" v-if="errors.responsible">
                                                        {{errors.responsible[0]}}
                                                    </small>
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

        axios.get('/api/project').then(({
            data
        }) => {
            this.projects = data
        })

    },
    data() {
        return {

            form: {
                project_id: null,
                title: null,
                details: null,
                priority: null,
                identified: null,
                completed: null,
                status: null,
                responsible: null,
            },
            errors: {},
            projects: {},
        }
    },
    methods: {


        issueInsert() {

            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            // end security token

            axios.post('/api/issue', this.form)
                .then((data) => {
                    this.$router.push({
                        name: "issue",
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
