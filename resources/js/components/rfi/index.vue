<template>
    <div>

        <div class="row">
            <router-link to="/store-rfi" class="btn btn-primary">Add RFI</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">RFI List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Structure</th>
                                    <th>Sub-structure</th>
                                    <th>Part</th>
                                    <th>Step</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Inspector</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rfi in filterSearch" :key="rfi.id">
                                    <td>{{rfi.project}}</td>
                                    <td>{{rfi.structure}}</td>
                                    <td>{{rfi.substructure}}</td>
                                    <td>{{rfi.part}}</td>
                                    <td>{{rfi.step_no}}.{{rfi.step}}</td>
                                    <td>{{rfi.date}}</td>
                                    <td>{{rfi.time}}</td>
                                    <td>{{rfi.status}}</td>
                                    <td>{{rfi.remark}}</td>
                                    <td>
                                        <p v-for="user in rfi.users" :key="user.id">
                                            {{user.name}}
                                        </p>
                                    </td>
                                    <td>

                                        <router-link :to="{name: 'edit-rfi', params:{id: rfi.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>

<!--  <a @click="deleteRFI(rfi.id)" class="btn btn-sm btn-danger">Delete</a> -->
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
        this.AllRFI();
    },

    data() {
        return {
            rfis: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.rfis.filter(rfi => {
                return rfi.structure.toUpperCase().includes(this.searchTerm.toUpperCase())
            })
        }
    },

    methods: {
        AllRFI() {
          //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('/api/rfi')
                .then(({
                    data
                }) => {
                    this.rfis = data
                })
                .catch()
        },
        deleteRFI(id) {
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

                    axios.delete('/api/rfi/' + id)
                        .then(() => {
                            this.rfis = this.rfis.filter(rfi => {
                                return rfi.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch((data) => {
                            this.$router.push({
                                name: 'rfi',
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
