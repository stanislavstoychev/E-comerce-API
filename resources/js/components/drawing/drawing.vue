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
                                        <h1 class="h4 text-gray-900 mb-4">Drawings Details</h1>
                                    </div>
                                    <div class="card shadow-sm my-5">
                                        <h5 class="h5 text-gray-900 m-4"> General Drawing details</h5>
                                        <div class="card-body table-responsive">        
                                            <table class="table table-bordered table-hover">            
                                                <tbody>
                                                    <tr>
                                                        <th>Project</th>
                                                        <td style="min-width:115px;">
                                                            {{drawing.project.abreviation}}
                                                        </td>
                                                    </tr>
                                                    <tr><th>Part</th><td>{{drawing.part.abreviation}}</td></tr>
                                                    <tr><th>Structure</th><td>{{drawing.structure.name}}</td></tr>
                                                    <tr><th>Drawing number</th><td>{{drawing.drawing_number}}</td></tr>
                                                    <tr><th>Title</th><td>{{drawing.title}}</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="card shadow-sm my-5">
                                            <h5 class="h5 text-gray-900 m-4"> Revision History</h5>
                                            <div class="card-body table-responsive"><table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Drawing Number</th>
                                                        <th>Structure</th>
                                                        <th>Title</th>
                                                        <th d-none="" d-md-table-cell="">Revision / Version</th>
                                                        <th d-none="" d-md-table-cell="">Date</th>
                                                        <th>Status</th>
                                                        <th>File</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr v-for="drawingdet in drawing.drawingsdet">
                                                        <td>{{drawing.drawing_number}}</td>
                                                        <td>{{drawing.structure.name}}</td>
                                                        <td>{{drawing.title}}</td>
                                                        <td>rev.{{drawingdet.revision}} / ver.{{drawingdet.version}}</td>
                                                        <td>{{drawingdet.drawing_date}}</td>
                                                        <td>{{drawingdet.status}}</td>
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

                                        <div class="card shadow-sm my-5">
                                            <h5 class="h5 text-gray-900 m-4"> Transmittal Activity</h5>
                                            <div v-for="drawingdet in drawing.drawingsdet" class="card-body table-responsive"> 
                                                rev.{{drawingdet.revision}} / ver.{{drawingdet.version}}

                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Number</th>
                                                        <th>Date</th>
                                                        <th>Sender</th>
                                                        <th>Recipient</th>
                                                        <th>Subject</th>
                                                        <th>Came by</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    
                                                    <tr v-for="transmittal in drawingdet.drawingtransmittals">
                                                        <td>{{transmittal.no}}</td>
                                                        <td>{{transmittal.date}}</td>
                                                        <td>{{transmittal.sender}}</td>
                                                        <td>{{transmittal.recepient}}</td>
                                                        <td>{{transmittal.subject}}</td>
                                                        <td>{{transmittal.came_by}}</td>

                                                        <td>
                                                            <router-link :to="{name: 'transmittaldetails', params:{id: transmittal.id}}"
                                                                    class="btn btn-sm btn-success">
                                                                Details
                                                            </router-link>
                                                        </td>
                                                        
                                                        </tr>
                                                </tbody>
                                            </table>
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


        this.getDrawing()
        let id = this.$route.params.id;
        axios.get('/api/drawing/' + id).then(({
            data
        }) => {
            this.drawing = data

            })

        

    },
    computed: {
          
        
    },
    data() {
        return {

            drawing: {},
            error: {},
        }
    },
    
    

    methods: {
        getDrawing() {
            let id = this.$route.params.id;

            axios.get('/api/drawing/' + id).then(({
            data
        }) => {
            this.drawing = data
        })            
        },
        removeDrawing(id) {
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
                    
                    axios.delete('/api/drawingdet/' + id )
                        .then(() => {
                            this.drawing.drawingsdet = this.drawing.drawingsdet.filter(drawingdet => {
                                return drawingdet.id != idd
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your information has been deleted.',
                                'success'
                            )

                        })
                        .catch(error => {
                                if(error.response.status == 406){
                                    Notification.transmittalexist()
                                }
                                })



                }
            })
        },        
    }
}


</script>

<style>










</style>
