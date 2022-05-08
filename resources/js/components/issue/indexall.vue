<template>
    <div>

        <div class="row">
            <router-link to="/store-issue" class="btn btn-primary">Add Issue</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Drawing List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Title</th>
                                    <th>Details</th>
                                    <th>Priority</th>
                                    <th>Identifed</th>
                                    <th>Completed</th>
                                    <th>Status</th>
                                    <th>Responsible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="issue in issues" :key="issue.id">
                                    <td>{{issue.project.abreviation}}</td>
                                    <td>{{issue.title}}</td>
                                    <td><span v-html="issue.details"></span>
                                        <div v-for="file in issue.files">
                                            <a :href="file.doc" download>
                                                <i class="fas fa-download mr-3"></i>
                                            </a>
                                            {{file.description}}
                                        </div>
                                    </td>
                                    <td>{{issue.priority}}</td>
                                    <td>{{issue.identified}}</td>
                                    <td>{{issue.completed}}</td>
                                    <td>{{issue.status}}</td>
                                    <td>{{issue.responsible}}</td>

                                    <td>
                                        <router-link :to="{name: 'attach-issue', params:{issue_id: issue.id}}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-paperclip"></i>
                                        </router-link>
                                        <router-link :to="{name: 'edit-issue', params:{id: issue.id}}"
                                            class="btn btn-sm btn-success">
                                            <i class="far fa-edit"></i>
                                        </router-link>

                                        <a @click="deleteIssue(issue.id)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
        this.AllIssues();
    },

    data() {
        return {
            issues: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.issues.filter(issue => {
                return issue.title.match(this.searchTerm) || issue.description.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllIssues() {
            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('/api/issueall')
                .then(({
                    data
                }) => {
                    this.issues = data
                })
                .catch()
        },
        deleteIssue(id) {
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

                    axios.delete('/api/issue/' + id)
                        .then(() => {
                            this.issues = this.issues.filter(issue => {
                                return issue.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your information has been deleted.',
                                'success'
                            )

                        })
                        .catch((data) => {
                            this.$router.push({
                                name: 'issue',
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
