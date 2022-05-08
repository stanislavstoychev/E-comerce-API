<template>
    <div>

        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Substructures List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Structure</th>
                                    <th>Part</th>
                                    <th>Substructure</th>
                                    <th>Delete substructure</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="substructure in substructures" :key="substructure.id">


                                    <td>{{substructure.id}}</td>

                                    <td>{{substructure.structure.project.abreviation}}</td>
                                    <td>{{substructure.structure.name}}</td>
                                    <td>{{substructure.part.name}}</td>

                                    <td>
                                    <div v-if="substructureEditingId == substructure.id">
                                        <v-text-field v-model="substructure.name"
                                                            :id="`substructure-edit-${substructure.id}`"
                                                            @blur="update(substructure)"
                                                            @keydown.enter="update(substructure)"/>
                                    </div>
                                    <div v-else @click="substructureEditing(substructure.id)">
                                    {{substructure.name}}
                                    </div>
                                    </td>
                                    <td>
                                        <a @click="deleteSubstructure(substructure.id)"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
                <!-- /Simple Tables -->
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Structures List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Structure</th>
                                    <th>Delete Structure</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="structure in structures" :key="structure.id">


                                    <td>{{structure.id}}</td>
                                    <td>{{structure.project.abreviation}}</td>

                                    <td>
                                    <div v-if="structureEditingId == structure.id">
                                        <v-text-field v-model="structure.name"
                                                            :id="`structure-edit-${structure.id}`"
                                                            @blur="updatestr(structure)"
                                                            @keydown.enter="updatestr(structure)"/>
                                    </div>
                                    <div v-else @click="structureEditing(structure.id)">
                                    {{structure.name}}
                                    </div>

                                    </td>
                                    <td>
                                        <a @click="deleteStructure(structure.id)"
                                            class="btn btn-sm btn-danger">Delete</a>
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
        this.AllSubstructures();
        this.AllStructures();
    },

    data() {
        return {
            substructure: '',
            substructures: [],
            structure: '',
            structures: [],
            errors: {},
            searchTerm: '',
            substructureEditingId: '',
            structureEditingId: '',

        }
    },
    computed: {},

    methods: {
        AllSubstructures() {
            axios.get('/api/substructure')
                .then(({
                    data
                }) => {
                    this.substructures = data
                })
                .catch()
        },
        AllStructures() {
            axios.get('/api/structure')
                .then(({
                    data
                }) => {
                    this.structures = data
                })
                .catch()
        },
        substructureEditing(id) {
            this.substructureEditingId = id;
            setTimeout(()=> {
                document.getElementById(`substructure-edit-${id}`).focus()

            }, 1)
        },
        update(substructure) {
            this.substructureEditingId = '';
            axios.post('/api/substructure/' + substructure.id, substructure)
                        .then(
                            Notification.success()

                        )
        },
        structureEditing(id) {
            this.structureEditingId = id;
            setTimeout(()=> {
                document.getElementById(`structure-edit-${id}`).focus()

            }, 1)
        },
        updatestr(structure) {
            this.structureEditingId = '';
            axios.post('/api/structureupdate/' + structure.id, structure)
                        .then(
                            Notification.success()

                        )
        },
        deleteSubstructure(id) {
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

                    axios.delete('/api/substructure/' + id)
                        .then(() => {
                            this.substructures = this.substructures.filter(substructure => {
                                return substructure.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'substructure'
                            })
                        })



                }
            })
        },
        deleteStructure(id) {
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

                    axios.delete('/api/structure/' + id)
                        .then(() => {
                            this.structures = this.structures.filter(structure => {
                                return structure.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'substructure'
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
