<template>
    <div>

        <div class="row">
            <router-link to="/store-subcontractor" class="btn btn-primary">Add Sub-contractor</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Subcontractors List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Abbr.</th>
                                    <th>Part</th>
                                    <th>Job</th>
                                    <th>Foreman</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="subcontractor in filterSearch" :key="subcontractor.id">
                                    <td>{{subcontractor.id}}</td>
                                    <td>{{subcontractor.name}}</td>
                                    <td>{{subcontractor.abbreviation}}</td>
                                    <td>{{subcontractor.part}}</td>
                                    <td>{{subcontractor.job}}</td>
                                    <td>{{subcontractor.foreman}}</td>
                                    <td><img :src="subcontractor.photo" id="em_photo"></td>
                                    <td>{{subcontractor.phone}}</td>
                                    <td>{{subcontractor.email}}</td>
                                    <td>

                                        <router-link :to="{name: 'edit-subcontractor', params:{id: subcontractor.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <a @click="deleteSubcontractor(subcontractor.id)"
                                            class="btn btn-sm btn-danger">Delete</a>
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
        this.AllSubcontractors();
    },

    data() {
        return {
            subcontractors: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.subcontractors.filter(subcontractor => {
                return subcontractor.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllSubcontractors() {
            axios.get('/api/subcontractor')
                .then(({
                    data
                }) => {
                    this.subcontractors = data
                })
                .catch()
        },
        deleteSubcontractor(id) {
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

                    axios.delete('/api/subcontractor/' + id)
                        .then(() => {
                            this.subcontractors = this.subcontractors.filter(subcontractor => {
                                return subcontractor.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'subcontractor'
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