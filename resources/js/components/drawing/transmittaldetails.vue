<template>
    <div>
        <div class="row">
            <router-link to="/transmittal" class="btn btn-primary">All Transmittals</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Drawing Transmittal</h1>
                                    </div>
                                    <div class="card shadow-sm my-5">
                                        <h5 class="h5 text-gray-900 m-4"> Transmittal Details</h5>
                                        <div class="card-body table-responsive">        
                                            <table class="table table-bordered table-hover">            
                                                <tbody>
                                                    <tr>
                                                        <th>Number</th>
                                                        <td style="min-width:115px;">
                                                            {{transmittal.no}}
                                                        </td>
                                                    </tr>
                                                    <tr><th>Project</th><td>{{transmittal.project.abreviation}}</td></tr>
                                                    <tr><th>Date</th><td>{{transmittal.date}}</td></tr>
                                                    <tr><th>Sender</th><td>{{transmittal.sender}}</td></tr>
                                                    <tr><th>Recepient</th><td>{{transmittal.recepient}}</td></tr>
                                                    <tr><th>Subject</th><td>{{transmittal.subject}}</td></tr>
                                                    <tr><th>Came by</th><td>{{transmittal.came_by}}</td></tr>
                                                    <tr><th>Use for</th><td>{{transmittal.use_for}}</td></tr>
                                                    <tr><th>Box</th><td>{{transmittal.box}}</td></tr>
                                                    <tr><th>Folder</th><td>{{transmittal.folder}}</td></tr> 
                                                </tbody></table>
                                            </div>
                                        </div>

                                        <div class="card shadow-sm my-5">
                                            <h5 class="h5 text-gray-900 m-4"> Drawings Attached</h5>
                                            <div class="card-body table-responsive"><table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Drawing Number</th>
                                                        <th>Structure</th>
                                                        <th>Title</th>
                                                        <th d-none="" d-md-table-cell="">Revision / Version</th>
                                                        <th d-none="" d-md-table-cell="">Date</th>
                                                        <th>File</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr v-for="drawingdet in transmittal.drawingsdet">
                                                        <td>{{drawingdet.drawing.drawing_number}}</td>
                                                        <td>{{drawingdet.drawing.structure.name}}</td>
                                                        <td>{{drawingdet.drawing.title}}</td>
                                                        <td>rev.{{drawingdet.revision}} / ver.{{drawingdet.version}}</td>
                                                        <td>{{drawingdet.drawing_date}}</td>
                                                        <td> 
                                                            <a v-for="file in drawingdet.drawingfiles" :href="'../' + file.file" class="btn-primary p-1 m-1"  download>{{file.extension}}</a>
                                                        </td>
                                                        <td>
                                                            <a @click="removeDrawing(drawingdet.id)" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody></table>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="card shadow-sm my-5">
                                                    <div class="card-body p-0">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="login-form">
                                                                    <div class="text-center">
                                                                        <h1 class="h4 text-gray-900 mb-4">Add Drawing</h1>
                                                                    </div>
                                                                    <form class="user" @submit.prevent="addDrawing">
                                                                        
                                                        <div class="form-group">
                                                            <div class="form-row">

                                                                <div class="col-md-6">
                                                                    <label for="exampleFormControlSelect1">Drawing No:</label>
                                                                    <input type="text" class="form-control"
                                                                    v-model="searchTerm" placeholder="Search & select ...">
                                                                    

                                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                                            v-model="form.drawing_id" @change="revisionVersion"> 
                                                                            <option v-for="drawing in filterSearch"
                                                                            :value="drawing.id">
                                                                        {{drawing.drawing_number}} - {{drawing.title}}</option>

                                                                    </select>
                                                                    <small class="text-danger" v-if="errors.drawing_id">
                                                        {{errors.drawing_id[0]}} </small>

                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="exampleFormControlSelect1">Rev. / Ver.</label>
                                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                                            v-model="form.drawingdet_id"> 
                                                                            <option v-for="drawingdet in drawingversion"
                                                                            :value="drawingdet.id">
                                                                       r. {{drawingdet.revision}} / v. {{drawingdet.version}}</option>
                                                                    </select>
                                                                    <small class="text-danger" v-if="errors.drawingdet_id">
                                                        {{errors.drawingdet_id[0]}} </small>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-block  text-white" type="submit">Submit</button>
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


        this.getDrawings()
        let id = this.$route.params.id;
        axios.get('/api/transmittal/' + id).then(({
            data
        }) => {
            this.transmittal = data
            this.form.project_id = this.transmittal.project_id

            axios.get('/api/structure/' + this.form.project_id).then(({
                data
            }) => {
                this.structures = data
            })
        })
        
        axios.get('/api/part').then(({
            data
        }) => {
            this.parts = data
        })

        

    },
    computed: {
         filterSearch() {
            return this.drawings.filter(drawing => {
                return drawing.drawing_number.match(this.searchTerm) || drawing.title.match(this.searchTerm)
            })
        },
        
    },
    data() {
        return {

            transmittal: [],
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
            parts: {},
            structures: {},
            drawings: {},
            drawingversion: {},
            searchTerm: '',
            errors: {},
        }
    },
    
    

    methods: {
        getDrawings() {
            axios.get('/api/drawing').then(({
            data
        }) => {
            this.drawings = data
        })            
        },
        revisionVersion() {
            axios.get('/api/drawingversion/' + this.form.drawing_id).then(({
            data
        }) => {
            this.drawingversion = data
        })   
        },
        
        addDrawing() {
            let id = this.$route.params.id;
            axios.post('/api/transmittal/'+ id + '/drawing', this.form).then(({data}) => {
                
                
            axios.get('/api/transmittal/' + id).then(({
                data
            }) => {
                this.transmittal = data
                this.errors = {}
                this.form.drawing_id = null
                this.form.drawingdet_id = null
            })
                Notification.success()
                
            }) 
            .catch(error => this.errors = error.response.data.errors)
            },

        removeDrawing(idd) {
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
                    let idt = this.$route.params.id;
                    axios.delete('/api/transmittal/' + idt + '/drawing/' + idd )
                        .then(() => {
                            this.transmittal.drawingsdet = this.transmittal.drawingsdet.filter(drawingdet => {
                                return drawingdet.id != idd
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your information has been deleted.',
                                'success'
                            )

                        })
                        .catch((data) => {
                            this.$router.push({
                                name: 'transmittaldetails', params: {id: idt}
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
