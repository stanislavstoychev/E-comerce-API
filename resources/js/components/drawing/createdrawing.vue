<template>
    <div>
        <div class="row">
            <router-link to="drawing" class="btn btn-primary">All Drawings</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add New Drawing</h1>
                                    </div>
                                    <form class="user" @submit.prevent="fileInsert" enctype="multipart/form-data">
                                        
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project:</label>
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
                                                    <label for="exampleFormControlSelect1">Drawing No</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.drawing_number">
                                                    <small class="text-danger" v-if="errors.drawing_number">
                                                        {{errors.drawing_number[0]}}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Title:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.title">
                                                    <small class="text-danger" v-if="errors.title">
                                                        {{errors.title[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Revision:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.revision">
                                                    <small class="text-danger" v-if="errors.revision">
                                                        {{errors.revision[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Version:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.version">
                                                    <small class="text-danger" v-if="errors.version">
                                                        {{errors.version[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Date:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Description" v-model="form.drawing_date">
                                                    <small class="text-danger" v-if="errors.drawing_date">
                                                        {{errors.drawing_date[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Status</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.status">
                                                        <option value="for information">for information</option>
                                                        <option value="for comments">for comments</option>
                                                        <option value="approved">approved</option>
                                                        <option value="for approval">for approval</option>
                                                        <option value="for procurement">for procurement</option>
                                                        <option value="for construction">for construction</option>
                                                        <option value="superseded">superseded</option>
                                                        
                                                    </select>
                                                    <small class="text-danger" v-if="errors.status">
                                                        {{errors.status[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Remark:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.remark">
                                                    <small class="text-danger" v-if="errors.remark">
                                                        {{errors.remark[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">File</label>

                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            @change="onFileSelected">
                                                        <small class="text-danger" v-if="errors.doc">
                                                            {{errors.doc[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>

                                                    </div>
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

        axios.get('/api/part').then(({
            data
        }) => {
            this.parts = data
        })
    },

    data() {
        return {
            form: {
                project_id: null,
                part_id: null,
                structure_id: null,
                title: null,
                drawing_number: null,
                revision: null,
                version: null,
                drawing_id: null,
                drawingdet_id: null,
                drawing_date: null,
                status: null,
                remark: null,
            },
            file: null,
            errors: {},
            projects: {},
            parts: {},
            structures: {},

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
        onFileSelected(e) {
            this.file = e.target.files[0];
        },

        fileInsert() {

            let fd = new FormData();
            fd.append('img', this.file);
            fd.append('project_id', this.form.project_id);
            fd.append('part_id', this.form.part_id);
            fd.append('structure_id', this.form.structure_id);
            fd.append('title', this.form.title);
            fd.append('drawing_number', this.form.drawing_number);
            fd.append('revision', this.form.revision);
            fd.append('version', this.form.version);
            fd.append('drawing_date', this.form.drawing_date);
            fd.append('status', this.form.status);
            fd.append('remark', this.form.remark);
            
            axios.post(`/api/drawing/fileupload`, fd)
                .then(() => {
                    this.$router.push({
                        name: "drawing"
                    })
                    Notification.success()
                })
                .catch(error => {this.errors = error.response.data.errors
                                if(error.response.status == 406){
                                    Notification.drawingexist()

                                }
                })
        },

    }
}
</script>

<style>










</style>
