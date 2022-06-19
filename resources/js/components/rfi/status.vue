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
                        <table class="table table-hover align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Structure</th>
                                    <th>Sub-structure</th>
                                    <th>Part</th>
                                    <th>Step</th>
                                    <th>Date</th>
                                    <th>Inspector</th>
                                    <th>Status</th>
                                    <th>Remark</th>

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
                                    <td><tr v-for="user in rfi.users">{{user.name}}</tr></td>
                                    <td>
                                    <tr v-for="user in rfi.users">{{user.pivot.status}}
                                    </tr>
                                    </td>
                                    <td>
                                    <tr v-for="user in rfi.users">{{user.pivot.remark}}
                                    </tr>
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
        rfiid: [],
        rfis: [],
            errors: {},
            searchTerm: '',
            statusEditingId: '',
            remarkEditingId: '',
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

            axios.get('/api/allrfi')
                .then(({
                    data
                }) => {
                    this.rfis = data
                })
                .catch()

},

        statusEditing(id) {
            this.statusEditingId = id;
            setTimeout(()=> {
                document.getElementById(`status-edit-${id}`).focus()

            }, 1)
        },
        remarkEditing(id) {
            this.remarkEditingId = id;
            setTimeout(()=> {
                document.getElementById(`remark-edit-${id}`).focus()

            }, 1)
        },
        updateStatus(rfi){
            this.statusEditingId = '';

        },
        updateRemark(rfi) {
            this.remarkEditingId = '';
        },
        saveRfi(id) {
this.rfiid = this.rfis.filter(rfi => {
                                return rfi.id = id
                            })

            axios.post('/api/saverfi/' + id, this.rfiid[0].pivot)
                        .then(
                            Notification.success()
                        )

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
