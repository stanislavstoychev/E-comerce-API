<template>
    <div>

        <div class="row">
            <router-link to="/store-step" class="btn btn-primary">Add Step</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Steps List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Part</th>
                                    <th>Template</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="step in filterSearch" :key="step.id">
                                    <td>{{step.number}}</td>
                                    <td>{{step.name}}</td>
                                    <td>{{step.part}}</td>
                                    <td>{{step.doc}}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-step', params:{id: step.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <a @click="deleteStep(step.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.AllSteps();
    },

    data() {
        return {
            steps: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.steps.filter(step => {
                return step.name.toUpperCase().match(this.searchTerm.toUpperCase())
            })
        }
    },

    methods: {
        AllSteps() {
            axios.get('/api/step')
                .then(({
                    data
                }) => {
                    this.steps = data
                })
                .catch()
        },
        deleteStep(id) {
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

                    axios.delete('/api/step/' + id)
                        .then(() => {
                            this.steps = this.steps.filter(step => {
                                return step.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'step'
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
