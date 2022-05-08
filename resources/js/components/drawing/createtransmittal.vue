<template>
    <div>
        <div class="row">
            <router-link to="/issue" class="btn btn-primary">All Issues</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">New Transmittal</h1>
                                    </div>
                                    <form class="user" @submit.prevent="createTransmittal" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        No:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.no">
                                                    <small class="text-danger" v-if="errors.no">
                                                        {{errors.no[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Project</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.project_id">
                                                        <option v-for="project in projects" :value="project.id">
                                                            {{project.abreviation}}</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.project_id">
                                                        {{errors.project_id[0]}}
                                                    </small>
                                                </div>  
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">In/Out</label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.in_out">
                                                        <option value="In">In</option>
                                                        <option value="Out">Out</option>

                                                    </select>
                                                    <small class="text-danger" v-if="errors.in_out">
                                                        {{errors.in_out[0]}}
                                                    </small>
                                                </div>  

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Sender:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.sender">
                                                    <small class="text-danger" v-if="errors.sender">
                                                        {{errors.sender[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Recepient:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.recepient">
                                                    <small class="text-danger" v-if="errors.recepient">
                                                        {{errors.recepient[0]}}
                                                    </small>
                                                </div>  

                                                <div class="col-md-6">
                                                    
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Came by(email, Change order ...)</label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.came_by">
                                                    <small class="text-danger" v-if="errors.came_by">
                                                        {{errors.came_by[0]}}
                                                    </small>
                                                </div>  

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Date:
                                                    </label>
                                                    <input type="date" class="form-control" placeholder=""
                                                        v-model="form.date">
                                                    <small class="text-danger" v-if="errors.date">
                                                        {{errors.date[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Use for (contractural,execution,unofficial, as-built)</label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.use_for">
                                                    <small class="text-danger" v-if="errors.use_for">
                                                        {{errors.use_for[0]}}
                                                    </small>
                                                </div>  

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Subject:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.subject">
                                                    <small class="text-danger" v-if="errors.subject">
                                                        {{errors.subject[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Box:
                                                    </label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.box">
                                                    <small class="text-danger" v-if="errors.box">
                                                        {{errors.box[0]}}
                                                    </small>
                                                </div>  

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">folder</label>
                                                    <input type="text" class="form-control" placeholder=""
                                                        v-model="form.folder">
                                                    <small class="text-danger" v-if="errors.folder">
                                                        {{errors.folder[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>             


                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block text-white" type="submit">Submit</button>
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

        axios.get('/api/project').then(({
            data
        }) => {
            this.projects = data
        })
        


    },
    data() {
        return {

            form: {
                no: null,
                project_id: null,
                sender: null,
                recepient: null,
                came_by: null,
                date: null,
                use_for: null,
                box: null,
                folder: null,
                subject: null,
                

            },
            errors: {},
            projects: {},
        }
    },
 
    

    methods: {

    createTransmittal() {
         axios.post(`/api/transmittal/`, this.form)
                .then(({data}) => {
                    this.$router.push({
                        name: "transmittaldetails",
                        params: { id: data.id }
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
    },

    }
}


</script>

<style>










</style>
