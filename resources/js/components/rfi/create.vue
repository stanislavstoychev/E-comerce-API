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
                                        <h1 class="h4 text-gray-900 mb-4">New RFI</h1>
                                    </div>
                                    <form class="user" @submit.prevent="rfiInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.project_id" @change="projectSelected">
                                                        <option v-for="project in projects" :value="project.id">
                                                            {{project.abreviation}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.project_id">
                                                        {{errors.project_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Structure</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.structure_id" >
                                                        <option v-for="structure in structures" :value="structure.id">
                                                            {{structure.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.structure_id">
                                                        {{errors.structure_id[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                            <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Part</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.part_id"
                                                        @change="getSteps">
                                                        <option v-for="part in parts" :value="part.id">
                                                            {{part.name}}</option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.part_id">
                                                        {{errors.part_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Substructure</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.substructure_id">
                                                        <option v-for="substructure in substructures"
                                                            :value="substructure.id">
                                                            {{substructure.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.substructure_id">
                                                        {{errors.substructure_id[0]}}
                                                    </small>
                                                 </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Step</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.step_id">
                                                        <option v-for="step in steps" :value="step.id">
                                                        {{step.number}}.{{step.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.step_id">
                                                        {{errors.step_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Inspection Date:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.date">
                                                    <small class="text-danger" v-if="errors.date">
                                                        {{errors.date[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Inspection Time:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Inspection Time" v-model="form.time">
                                                    <small class="text-danger" v-if="errors.time">
                                                        {{errors.time[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextarea1">Remark:</label>
                                                    <textarea class="form-control" rows="3"
                                                        v-model="form.remark"></textarea>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Partisipants:</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.inspectors_id" multiple="">
                                                        <option v-for="user in users" :value="user.id">
                                                            {{user.name}}</option>

                                                    </select>
                                                <small class="text-danger" v-if="errors.inspectors_id">
                                                        {{errors.inspectors_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">

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

axios.get('/api/user').then(({
            data
        }) => {
            this.users = data
        })


        axios.get('/api/part').then(({
            data
        }) => {
            this.parts = data
        })


    },
    data() {
        return {
            inspectors: {},

            form: {
                inspectors_id: [],
                project_id: null,
                structure_id: null,
                substructure_id: null,
                part_id: null,
                step_id: null,
                date: null,
                time: null,
                user_id: null,
                status: 'Open',
                remark: null,

            },
                users: null,
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
        },

        getSteps() {
            axios.get('/api/substructure/' + this.form.part_id + '/' + this.form.structure_id).then(({
                data
            }) => {
                this.substructures = data
            })
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
                .then((data) => {
                    this.$router.push({
                        name: "rfi",
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
