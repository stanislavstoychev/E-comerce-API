<template>
    <div>

        <div class="row">
            <router-link to="/store-part" class="btn btn-primary">Add Part</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Parts List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Abr.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="part in filterSearch" :key="part.id">
                                    <td>{{part.id}}</td>
                                    <td>{{part.name}}</td>
                                    <td>{{part.abreviation}}</td>
                                    <td>

                                        <router-link :to="{name: 'edit-part', params:{id: part.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <a @click="deletePart(part.id)" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
                <!-- /Simple Tables -->

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
        this.AllParts();
    },

    data() {
        return {
            parts: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.parts.filter(part => {
                return part.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllParts() {
            axios.get('/api/part')
                .then(({
                    data
                }) => {
                    this.parts = data
                })
                .catch()
        },
        deletePart(id) {
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

                    axios.delete('/api/part/' + id)
                        .then(() => {
                            this.parts = this.parts.filter(part => {
                                return part.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'part'
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
