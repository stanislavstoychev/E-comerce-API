<template>
    <div>

        <div class="row">
            <router-link to="/store-drawing" class="btn btn-primary">Add Drawing</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Drawings List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                     <th>Project</th>
                                    <th>Part</th>
                                    <th>Drawing No</th>
                                    <th>Title</th>
                                    <th>Revision/version Date   </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="drawing in filterSearch" :key="drawing.id">
                                    <td>{{drawing.project.abreviation}}</td>
                                    <td>{{drawing.part.abreviation}}</td>
                                    <td>
                                        <router-link :to="{name: 'drawing', params:{id: drawing.id}}"
                                                    class="btn btn-sm btn-info d-flex justify-content-center">
                                                        {{drawing.drawing_number}}
                                        </router-link>
                                        
                                    </td>
                                    <td>{{drawing.title}}</td>
                                    <td>
                                        <table class="table table-nostriped">
                                            <tr v-for="drawingdet in drawing.drawingsdet" :key="drawingdet.id">
                                                <td width="20%">rev. {{drawingdet.revision}} / ver. {{drawingdet.version}}</td>
                                                <td width="20%">{{drawingdet.drawing_date}}</td>
                                                <td width="20%">{{drawingdet.status}}</td>
                                                <td width="20%">
                                                    <a v-for="file in drawingdet.drawingfiles" :href="'../' + file.file" class="btn-primary p-1 m-1"  download>{{file.extension}}</a>
                                                    
                                                </td>
                                                <td width="20%">
                                                    <router-link :to="{name: 'edit-drawing', params:{id: drawingdet.id}}"
                                                    class="btn btn-sm btn-success">
                                                        <i class="far fa-edit"></i>
                                                    </router-link>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </td>

                                    
                                    

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    mounted() {

    },
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        this.AllDrawings();
    },

    data() {
        return {
            drawings: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.drawings.filter(drawing => {
                return drawing.title.match(this.searchTerm) || drawing.drawing_number.match(this.searchTerm) || drawing.part.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllDrawings() {
            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('/api/drawing')
                .then(({
                    data
                }) => {
                    this.drawings = data
                })
                .catch()
        },

    }
}
</script>

<style>
#em_photo {
    height: 40px;
    width: 40px;
}
</style>
