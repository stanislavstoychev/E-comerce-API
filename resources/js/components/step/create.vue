<template>
    <div>
        <div class="row">
            <router-link to="/step" class="btn btn-primary">All Steps</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Step</h1>
                                    </div>
                                    <form class="user" @submit.prevent="stepInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Step Number" v-model="form.number">
                                                    <small class="text-danger" v-if="errors.number">
                                                        {{errors.number[0]}}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Step Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name">
                                                        {{errors.name[0]}} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Template</label>

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
                                                    <label for="exampleFormControlSelect1">Part</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.part_id">
                                                        <option v-for="part in parts" :value="part.id">
                                                            {{part.name}}</option>

                                                    </select>


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
        this.getParts();
    },
    data() {
        return {
            form: {
                number: null,
                name: null,
                part_id: null,
            },
            parts: {},
            file: null,
            errors: {}
        }
    },
    methods: {
        getParts() {
            axios.get('/api/part').then(({
                data
            }) => {
                this.parts = data
            })
        },

        onFileSelected(e) {
            this.file = e.target.files[0];

        },

        stepInsert() {
            let fd = new FormData();
            fd.append('img', this.file);
            fd.append('number', this.form.number);
            fd.append('name', this.form.name);
            fd.append('part_id', this.form.part_id);
            axios.post('/api/step/file', fd)
                .then(() => {
                    this.$router.push({
                        name: "step"
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
