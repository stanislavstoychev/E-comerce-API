<template>
    <div>


        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Structures and substructures</h1>
                                    </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.project_id" @change="projectSelected">
                                                        <option v-for="project in projects" :value="project.id">
                                                            {{project.abreviation}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.project_id"> {{errors.project_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                </div>

                                            </div>
                                        </div>

<div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Part</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.part_id" @change="structureSelected">
                                                        <option v-for="part in parts" :value="part.id">
                                                            {{part.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.part_id"> {{errors.part_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">

                                                </div>



                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Structure</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.structure_id" @change="structureSelected">
                                                        <option v-for="structure in structures" :value="structure.id">
                                                            {{structure.name}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.structure_id"> {{errors.structure_id[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" v-model="form.structure" placeholder="Add new structure">
                                                    <button class="btn btn-primary" @click="addStructure">Add</button>
                                                </div>



                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Substructure</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.substructure_id">
                                                        <option v-for="substructure in substructures"
                                                            :value="substructure.id">
                                                            {{substructure.name}}</option>

                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" v-model="form.substructure" placeholder="Add new substructure">
                                                    <button class="btn btn-primary" @click="addSubStr">Add</button>
                                                </div>



                                            </div>
                                        </div>


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
                part: null,
                part_id: null,
                step_id: null,
                date: null,
                time: null,
                user_id: null,
                status: 'Open',
                remark: null,
                structure: null,
                substructure: null,

            },
            users: null,
            errors: {},
            projects: {},
            parts: {},
            structures: {},
            substructures: {},
            parts: {},
            steps: {},
            subcontractors: {},
        }
    },
    methods: {
        addStructure() {
            axios.post('/api/structure/' + this.form.project_id, this.form)
                .then(({data}) => {
                    this.structures.push(data);
                    Notification.success()
                    this.form.structure = '';
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        addPart() {
            axios.post('/api/part/', this.form)
                .then(({data}) => {
                    this.parts.push(data);
                    Notification.success()
                    this.form.part = '';
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        addSubStr() {
            axios.post('/api/substructure/' + this.form.part_id + '/' + this.form.structure_id, this.form)
                .then(({data}) => {
                    this.substructures.push(data);
                    Notification.success()
                    this.form.substructure = '';
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        projectSelected() {
            axios.get('/api/structure/' + this.form.project_id).then(({
                data
            }) => {
                this.structures = data
            })
        },
        structureSelected() {
            axios.get('/api/substructure/' + this.form.part_id + '/' + this.form.structure_id).then(({
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
