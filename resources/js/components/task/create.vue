<template>
    <div>
        <div class="row">
            <router-link to="/task" class="btn btn-primary">All Tasks</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">New Task</h1>
                                    </div>
                                    <form class="user" @submit.prevent="taskInsert" enctype="multipart/form-data">

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
                                                    <label for="exampleFormControlSelect1">Subcontractor</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.subcontractor_id" >
                                                        <option v-for="subcontractor in subcontractors" :value="subcontractor.id">
                                                            {{subcontractor.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.subcontractor_id">
                                                        {{errors.subcontractor_id[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

										<div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    
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
                                                        @change="getSubstructure">
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
                                                    <label for="exampleFormControlSelect1">Planned Start:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.planned_start">
                                                    <small class="text-danger" v-if="errors.planned_start">
                                                        {{errors.planned_start[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Planned Finish:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.planned_finish">
                                                    <small class="text-danger" v-if="errors.planned_finish">
                                                        {{errors.planned_finish[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Actual Start:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.actual_start">
                                                    <small class="text-danger" v-if="errors.actual_start">
                                                        {{errors.actual_start[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Actual Finish:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.actual_finish">
                                                    <small class="text-danger" v-if="errors.actual_finish">
                                                        {{errors.actual_finish[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextarea1">Description:</label>
                                                    <textarea class="form-control" rows="3"
                                                        v-model="form.description"></textarea>
                                                    <small class="text-danger" v-if="errors.description">
                                                        {{errors.description[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Priority:</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.priority" >
                                                        <option value="High">High</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Low">Low</option>

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
                                                    <label for="exampleFormControlSelect1">Schedule ID:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="" v-model="form.schedule_id">
                                                    <small class="text-danger" v-if="errors.schedule_id">
                                                        {{errors.schedule_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">% Complete:</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" v-model="form.percent_complete">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                  </div>
                                                </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Owner:</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.user_id">
                                                        <option v-for="user in users" :value="user.id">
                                                            {{user.name}}</option>

                                                    </select>
                                                <small class="text-danger" v-if="errors.user_id">
                                                        {{errors.user_id[0]}}
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
                                                        <small class="text-danger" v-if="errors.photo">
                                                            {{errors.photo[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            image</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    

                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block text-white" type="submit">Submit</button>
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

        axios.get('/api/subcontractor').then(({
            data
        }) => {
            this.subcontractors = data
        })


    },
    data() {
        return {
            inspectors: {},

            form: {
                subcontractor_id: null,
                project_id: null,
                structure_id: null,
                part_id: null,
                substructure_id: null,
                description: null,
                actual_start: null,
                actual_finish: null,
                planned_start: null,
                planned_finish: null,
                priority: null,
                schedule_id: null,
                percent_complete: null,
                user_id: [],
                photo: null,

            },
                users: null,
            errors: {},
            projects: {},
            structures: {},
            substructures: {},
            parts: {},
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

        getSubstructure() {
            axios.get('/api/substructure/' + this.form.part_id + '/' + this.form.structure_id).then(({
                data
            }) => {
                this.substructures = data
            })
            
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

        taskInsert() {
            
            axios.post('/api/task', this.form)
                .then((data) => {
                    this.$router.push({
                        name: "task",
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
