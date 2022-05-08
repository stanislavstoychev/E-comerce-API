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
                        <h6 class="m-0 font-weight-bold text-primary">Open Issue List</h6>
                    </div>
                    <div class="issue-container" v-for="issue in issues" :key="issue.id">
                        <div class="issue">
                            <h3 class="issue-title">
                                {{issue.title}}
                            </h3>
                            <span class="issue-details" v-html="issue.details">
                            </span>
                            <div class="issue-att">
                            <div v-for="file in issue.files" :key="file.id">
                                    <div v-if="file.active">
                                        <a :href="file.doc" download>
                                            <i class="fas fa-download mr-3"></i>
                                        </a>
                                        {{file.description}}
                                    </div>
                            </div>
                            </div>

                                        <router-link :to="{name: 'edit-issue', params:{id: issue.id}}"
                                            class="issue-edit btn btn-sm btn-success">
                                            <i class="far fa-edit"></i>
                                        </router-link>

                            <button class="issue-toggle">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-times"></i>


                            </button>

                        </div>

                    </div>
<!--
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
                                            <div v-if="file.active">
                                                <a :href="file.doc" download>
                                                    <i class="fas fa-download mr-3"></i>
                                                </a>
                                                {{file.description}}
                                            </div>
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
-->
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
    updated() {
        this.issuesFunctionality();

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

            axios.get('/api/issue')
                .then(({
                    data
                }) => {
                    this.issues = data
                })
                .catch()
        },
        issuesFunctionality() {
            const toggles = document.querySelectorAll('.issue-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    toggle.parentNode.classList.toggle('active')
                    toggle.previousElementSibling.classList.toggle('active')

                })
            })
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

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');

* {
    box-sizing: border-box;
}

body {
    font-family: 'Muli', sans-serif;
    background-color: #f0f0f0;
}

.issue-container {
    min-width: 600px;
    margin: 0 auto;
}

.issue {
    background-color: transparent;
    border: 1px solid #9fa4a8;
    border-radius: 10px;
    margin: 5px 0;
    padding: 20px;
    position: relative;
    overflow: hidden;
    transition: 0.3s ease;
}

.issue.active {
    background-color: #fff;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
}

.issue.active::before,
.issue.active::after {
    content: '\f075';
    font-family: 'Font Awesome 5 Free';
    color: #2ecc71;
    font-size: 7rem;
    position: absolute;
    opacity: 0.2;
    top: 20px;
    left: 20px;
    z-index: 0;
}

.issue.active::before {
    color: #3498db;
    top: -10px;
    left: -30px;
    transform: rotateY(180deg);
}

.issue-title {
    margin: 0 35px 0 0;
}

.issue-details {
    display: none;
    margin: 20px 0 0;
}
.issue-att {
    display: none;
    margin: 0;
}
.issue-att.active {
    display: block;
    margin: 0;
}

.issue.active .issue-details {
    display: block;
}

.issue-edit {
    display:flex;
    position: absolute;
    top: 20px;
    right: 60px;


}
.issue-toggle {
    background-color: transparent;
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    padding: 0;
    position: absolute;
    top: 20px;
    right: 20px;
    height: 20px;
    width: 20px;
}
.issue-toggle:focus {
    outline: 0;
}
.issue-toggle .fa-times {
    display: none;
}
.issue.active .issue-toggle .fa-times {
    display: block;
    color: #fff;
}
.issue.active .issue-toggle .fa-chevron-down {
    display: none;
}
.issue.active .issue-toggle {
    background-color: #9fa4a8;
}
</style>
