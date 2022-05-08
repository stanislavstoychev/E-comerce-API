<template>
    <div>
        <div class="row">
            <router-link to="/rfi" class="btn btn-primary">All RFI's</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update RFI</h1>
                                    </div>
                                    <form class="user" @submit.prevent="rfiUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Project: {{form.project}}
                                                    </label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Structure: {{form.structure}}
                                                    </label>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Substructure:
                                                        {{form.substructure}}</label>



                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Part: {{form.part}}
                                                    </label>
                                                </div>



                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Step: {{form.step_no}}.{{form.step}}
                                                    </label>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Inspection Date:</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Inspection Date" v-model="form.date">
                                                    <small class="text-danger" v-if="errors.date">
                                                        {{errors.date[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Inspection Time:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Inspection Time" v-model="form.time">
                                                    <small class="text-danger" v-if="errors.time">
                                                        {{errors.time[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Status</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.status">
                                                        <option value="Open">
                                                            Open
                                                        </option>
                                                        <option value="Cancel">
                                                            Cancel
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">

                                                    <label for="exampleFormControlTextarea1">Remark:</label>
                                                    <textarea class="form-control" rows="3"
                                                        v-model="form.remark">{{form.remark}}</textarea>

                                                </div>

                                                <div class="col-md-6">

                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </div>

                                    </form>
                                    <hr>
                                    <div class="text-center">

                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        //security token
        let token = localStorage.getItem('token')

        axios.defaults.headers.common['Content-Type'] = 'application/json'
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


        // end security token
        let id = this.$route.params.id;
        axios.get('/api/rfi/' + id)
            .then(({
                data
            }) => {
                this.form = data.data
            })
            .catch(console.log('error'))

        axios.get('/api/user').then(({
            data
        }) => {
            this.users = data
        })



        axios.get('/api/part').then(({
            data
        }) => {
            this.parts = data
        })

        this.getInspectors();
        Reload.$on('AfterAddInsp', () => {
            this.getInspectors()
        });
    },
    mounted() {


    },
    data() {
        return {
            form: {
                project: '',
                structure: '',
                substructure: '',
                part: '',
                step_no: '',
                step: '',
                date: '',
                time: '',
                user: '',
                remark: '',
                status: '',
                inspector_id: '',

            },
            errors: {},
            projects: {},
            structures: {},
            substructures: {},
            inspectors: {},
            parts: {},
            steps: {},
            users: {},
            subcontractors: {},
        }
    },
    methods: {
        getInspectors() {
            let id = this.$route.params.id;
            axios.get('/api/rfi/' + id + '/inspector')
                .then(({
                    data
                }) => {
                    this.inspectors = data
                })
                .catch(console.log('error'))
        },


        addInspector() {

            let id = this.$route.params.id;
            axios.post('/api/rfi/inspector/' + id + '/' + this.form.inspector_id, this.form)
                .then(() => {
                    Reload.$emit('AfterAddInsp');
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)

        },
        deleteInspector(inspector_id) {
            let id = this.$route.params.id;
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

                    axios.delete('/api/rfi/' + id + '/inspector/' + inspector_id)
                        .then(() => {
                            this.inspectors = this.inspectors.filter(inspector => {
                                return inspector.id != inspector_id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'rfi'
                            })
                        })



                }
            })
        },
        projectSelected() {
            axios.get('/api/structure/' + this.form.project_id).then(({
                data
            }) => {
                this.structures = data
            })

            axios.get('/api/substructure/' + this.form.project_id).then(({
                data
            }) => {
                this.substructures = data
            })
        },
        getSteps() {
            axios.get('/api/step/' + this.form.part_id).then(({
                data
            }) => {
                this.steps = data
            })
        },
        rfiUpdate() {

            //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            // end security token
            let id = this.$route.params.id;
            axios.post('/api/rfi/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "rfi"
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        onFileSelected(e) {
            let file = e.target.files[0];
            if (file.size > 6 * 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = e => {
                    this.form.image = e.target.result

                };
                reader.readAsDataURL(file);

            }

        },

    }
}
</script>

<style>












</style>
