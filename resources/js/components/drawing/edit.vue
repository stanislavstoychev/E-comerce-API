<template>
    <div>
        <div class="row">
            <router-link to="../drawing" class="btn btn-primary">All Drawings</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Drawing</h1>
                                    </div>
                                    <form class="user" @submit.prevent="fileInsert" enctype="multipart/form-data">
                                        
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project:</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.drawing.project_id" @change="projectSelected">
                                                        <option v-for="project in projects" :value="project.id">
                                                            {{project.abreviation}}</option>

                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Structure</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.drawing.structure_id" >
                                                        <option v-for="structure in structures" :value="structure.id">
                                                            {{structure.name}}</option>

                                                    </select>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                            <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Part</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.drawing.part_id"
                                                        >
                                                        <option v-for="part in parts" :value="part.id">
                                                            {{part.name}}</option>
                                                    </select>
                                                    
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Drawing No</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.drawing.drawing_number">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Title:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.drawing.title">
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
                                                        superseded

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
                                                    <table class="table table-hover">
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">File</th>
                                                          <th scope="col">Action</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr v-for="file in form.drawingfiles" :key="file.id">
                                                          <td>
                                                              <a :href="'../' + file.file" class="btn-primary p-1 m-1"  download>{{file.extension}}</a>
                                                          </td>
                                                          <td>
                                                            <a @click="deleteFile(file.id)" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>  
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                      <div class="custom-file">
                                                        <input type="file" class="custom-file-input"  id="customFile" @change="onFileSelected">
                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02" >Choose file</label>

                                                      </div>
                                                      <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04" @click="clerFile">Clear</button>
                                                    </div>
                                                      
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        


                                        

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block text-white" type="submit">Update</button>
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
        axios.get('/api/drawingdet/' + id).then(({
            data
        }) => {
            this.form = data
            this.getStructures()
        })

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
                drawing_id: '',
                revision: '',
                version: '',
                drawing_date: '',
                status: '',
                remark: '',
                drawingfiles: [],
                drawing:{},
                project_id: '',
                part_id: '',
                structure_id: '',
                title: '',
                drawing_number: '',
                drawingdet_id: '',
            },
            file: {},
            errors: {},
            projects: {},
            parts: {},
            structures: {},
            message:{},

        }
    },
    methods: {
        getStructures() {
            axios.get('/api/structure/' + this.form.drawing.project_id).then(({
                data
            }) => {
                this.structures = data
            })
        },
        projectSelected() {
            axios.get('/api/structure/' + this.form.drawing.project_id).then(({
                data
            }) => {
                this.structures = data
            })
        },
        onFileSelected(e) {
            this.file = e.target.files[0];
        },
        clerFile() {
            this.$refs.myFileInput.value = '';
        },

        fileInsert() {

            let fd = new FormData();
            fd.append('img', this.file);
            fd.append('project_id', this.form.drawing.project_id);
            fd.append('part_id', this.form.drawing.part_id);
            fd.append('structure_id', this.form.drawing.structure_id);
            fd.append('title', this.form.drawing.title);
            fd.append('drawing_number', this.form.drawing.drawing_number);
            fd.append('revision', this.form.revision);
            fd.append('version', this.form.version);
            fd.append('drawing_date', this.form.drawing_date);
            fd.append('status', this.form.status);
            fd.append('remark', this.form.remark);
            
            let id = this.$route.params.id;
            axios.post(`/api/drawingdet/update/` + id, fd)
                .then(() => {
                    axios.get('/api/drawingdet/' + id).then(({
                        data
                    }) => {
                        this.form = data
                        this.getStructures()
                    })
                    Notification.success()
                })
                .catch(error => {
                                this.errors = error.response.data.errors
                                if(error.response.status == 406){
                                    Notification.drawingexist()
                                }
                                })
        },

        deleteFile(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.delete('/api/drawingfile/' + id)
                        .then(() => {
                            this.form.drawingfiles = this.form.drawingfiles.filter(file => {
                                return file.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your information has been deleted.',
                                'success'
                            )

                        })
                        .catch((data) => {
                            this.$router.push({
                                name: 'drawing',
                            })
                        })



                }
            })
        },

    }
}
</script>

<style>










</style>
