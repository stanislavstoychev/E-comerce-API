<template>
    <div>

        <div class="row">
            <router-link to="/store-transmittal" class="btn btn-primary">New Transmittal</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Transmittals List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                     <th>Number</th>
                                    <th>Date</th>
                                    <th>Sender</th>
                                    <th>Recipient</th>
                                    <th>Title </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="transmittal in filterSearch" :key="transmittal.id">
                                    <td>
                                        <router-link :to="{name: 'transmittaldetails', params:{id: transmittal.id}}"
                                                    class="btn btn-sm btn-info d-flex justify-content-center">
                                                        {{transmittal.no}}
                                        </router-link>
                                    </td>
                                    <td>{{transmittal.date}}</td>
                                    <td>{{transmittal.sender}}</td>
                                    <td>{{transmittal.recepient}}</td>
                                    <td>{{transmittal.subject}}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-transmittal', params:{id: transmittal.id}}"
                                                    class="btn btn-sm btn-success">
                                                        <i class="far fa-edit"></i>
                                        </router-link>
                                        <a @click="deleteTransmittal(transmittal.id)" class="btn btn-sm btn-danger">
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
        this.AllTransmittals();
    },

    data() {
        return {
            transmittals: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.transmittals.filter(transmittal => {
                return transmittal.subject.match(this.searchTerm) || transmittal.no.match(this.searchTerm) 
            })
        }
    },

    methods: {
        AllTransmittals() {
            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('api/transmittal')
                .then(({
                    data
                }) => {
                    this.transmittals = data
                })
                .catch()
        },
        deleteTransmittal(id) {
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

                    axios.delete('/api/transmittal/' + id)
                        .then(() => {
                            this.transmittals = this.transmittals.filter(transmittal => {
                                return transmittal.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your transmittal has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'transmittal'
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
