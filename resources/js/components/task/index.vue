<template>
    <div>

        <div class="row">
            <router-link to="/store-task" class="btn btn-primary">Add Task</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Task List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Subcontractor</th>
                                    <th>Structure</th>
                                    <th>Sub-structure</th>
                                    <th>Description</th>
                                    <th>% Complete</th>
                                    <th>Planned Start</th>
                                    <th>Actual Start</th>
                                    <th>Planned Finish</th>
                                    <th>Actual Finish</th>
                                    <th>Checked by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in filterSearch" :key="task.id">
                                    <td>{{task.project.abreviation}}</td>
                                    <td>{{task.subcontractor.abbreviation}}</td>
                                    <td>{{task.structure.name}}</td>
                                    <td>{{task.substructure.name}}</td>
                                    <td>{{task.description}}</td>
                                    <td>{{task.percent_complete}}</td>
                                    <td>{{task.planned_start}}</td>
                                    <td>{{task.actual_start}}</td>
                                    <td>{{task.planned_finish}}</td>
                                    <td>{{task.actual_finish}}</td>
                                    <td>{{task.user.name}}</td>
                                    <td>
                                        
                                        <router-link :to="{name: 'edit-task', params:{id: task.id}}"
                                            class="btn btn-sm btn-success">
                                            <i class="far fa-edit"></i>
                                        </router-link>

                                        <a @click="deleteTask(task.id)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i></a>
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
    mounted(){

    },
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        this.AllTask();
    },

    data() {
        return {
        rfiid: [],
        tasks: [],
        errors: {},
        searchTerm: '',
        statusEditingId: '',
        remarkEditingId: '',
        }
    },
    computed: {
        filterSearch() {
            return this.tasks.filter(task => {
                return task.structure.name.toUpperCase().includes(this.searchTerm.toUpperCase())
            })
        }
    },

    methods: {
        AllTask() {
          //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('/api/task')
                .then(({
                    data
                }) => {
                    this.tasks = data;
                })
                .catch()

},
        deleteTask(id) {
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

                    axios.delete('/api/task/' + id)
                        .then(() => {
                            this.tasks = this.tasks.filter(task => {
                                return task.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'task'
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
