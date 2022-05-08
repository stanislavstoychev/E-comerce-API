<template>
    <div>
        <div class="row">
            <router-link to="/issue" class="btn btn-primary">All Active Issues</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit File</h1>
                                    </div>
                                    <form class="user" @submit.prevent="fileInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Description:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Description" v-model="form.description">
                                                    <small class="text-danger" v-if="errors.description">
                                                        {{errors.description[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">
                                                        Active:
                                                    </label>
                                                    <select class="form-control custom-select" id="exampleFormControlSelect1"
                                                        v-model="form.active">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>


                                                    </select>
                                                    <small class="text-danger" v-if="errors.ststus">
                                                        {{errors.active[0]}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">File</label>

                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            @change="onFileSelected">
                                                        <small class="text-danger" v-if="errors.doc">
                                                            {{errors.doc[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            template (.doc, .docx)</label>

                                                    </div>
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
        let file_id = this.$route.params.file_id;
        axios.get(`/api/issuefile/${file_id}`).then(({
            data
        }) => {
            this.form = data
        })
    },


    data() {
        return {
            form: {
                doc: '',
                description: '',
                active: '',
            },
            file: null,
            errors: {}
        }
    },
    methods: {
        onFileSelected(e) {
            this.file = e.target.files[0];
        },

        fileInsert() {
            let file_id = this.$route.params.file_id;

            let fd = new FormData();
            fd.append('doc', this.file);
            fd.append('description', this.form.description);
            fd.append('active', this.form.active);
            axios.post(`/api/issuefile/${file_id}`, fd)
                .then(() => {
                    this.$router.push({
                        name: "issue"
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
