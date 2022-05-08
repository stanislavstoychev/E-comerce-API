<template>
    <div>
        <div class="row">
            <router-link to="/task" class="btn btn-primary">Task List</router-link>
        </div>
        <div>
        <h6 class="m-3 ml-5 font-weight-bold text-primary">Upload Picture</h6>
        </div>
        <input type="file" @change="select">
        <div class="progress">
            <div class="progress-bar" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
        </div>
    </div>
</template>

<script>
    export default {
        watch: {
            chunks(n, o) {
                if (n.length > 0) {
                    this.upload();
                }
            }
        },

        data() {
            return {
                file: null,
                chunks: [],
                uploaded: 0,
                file_name: null,
            };
        },

        computed: {
            progress() {
                if (this.file !== null ) {
                    let percent = 0;
                    percent = Math.floor((this.uploaded * 100) / this.file.size);
                    if (percent >= 100) {
                        this.file_name = this.file.name
                        return 100;
                    } else 
                        {return percent;}
                // return  Math.floor((this.uploaded * 100) / this.file.size); 
            }
                else {return 0;}
            },
            formData() {
                let formData = new FormData;
                formData.set('is_last', this.chunks.length === 1);
                formData.set('file', this.chunks[0], `${this.file.name}.part`);

                return formData;
            },
            config() {
                let task_id = this.$route.params.id;
                return {
                    method: 'POST',
                    data: this.formData,
                    url: `../api/uploadfp/${task_id}`,
                    headers: {
                        'Content-Type': 'application/octet-stream'
                    },
                    onUploadProgress: event => {
                        this.uploaded += event.loaded;
                    }
                };
            }
        },

        methods: {
            select(event) {
                this.file = event.target.files.item(0);
                this.createChunks();
            },
            upload() {
                axios(this.config).then(({response}) => {
                    this.chunks.shift()
                }).catch(error => {
                    Notification.error()
                });
            },
            createChunks() {
                let size = 204800, chunks = Math.ceil(this.file.size / size);

                for (let i = 0; i < chunks; i++) {
                    this.chunks.push(this.file.slice(
                        i * size, Math.min(i * size + size, this.file.size), this.file.type
                    ));
                }
            }
        }
    }
</script>

