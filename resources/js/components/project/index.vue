<template>
    <div>

        <div class="row">
            <router-link to="/store-project" class="btn btn-primary">Add Project</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Projects List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Address</th>
                                    <th>Cost</th>
                                    <th>Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="project in filterSearch" :key="project.id">
                                    <td>{{project.id}}</td>
                                    <td>{{project.name}}</td>
                                    <td><img :src="project.photo" id="em_photo"></td>
                                    <td>{{project.address}}</td>
                                    <td>{{project.cost}}</td>
                                    <td>{{project.start_date}}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-project', params:{id: project.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <a @click="deleteProject(project.id)" class="btn btn-sm btn-danger">Delete</a>
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
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        this.AllProjects();
    },

    data() {
        return {
            projects: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.projects.filter(project => {
                return project.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllProjects() {
            axios.get('/api/project')
                .then(({
                    data
                }) => {
                    this.projects = data
                })
                .catch()
        },
        deleteProject(id) {
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

                    axios.delete('/api/project/' + id)
                        .then(() => {
                            this.projects = this.projects.filter(project => {
                                return project.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'project'
                            })
                        })
                }
            })
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
