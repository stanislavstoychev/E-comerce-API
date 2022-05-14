<template>
    <div>

        <div class="row">
            <router-link to="/store-task" class="btn btn-primary">Add Task</router-link>
        </div>
        <br>
                <div class="form-group">
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="exampleFormControlSelect1">Search by structure name</label>

                            <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
                            
                        </div>

                        <div class="col-md-6">
                            <!-- //not working on web server -->
                            <!-- <label for="exampleFormControlSelect1">Project</label>
                            <select class="form-control custom-select" id="exampleFormControlSelect1"
                                v-model="project_id" >
                                <option v-for="project in projects" :value="project.id">
                                    {{project.abreviation}}</option>

                            </select>
                            <small class="text-danger" v-if="errors.structure_id">
                                {{errors.structure_id[0]}}
                            </small> -->
                        </div>

                    </div>
                </div>
        <br>
        <div class="row">
                
                <div class="card m-2" v-for="task in pageOfItems" :key="task.id" style="width: 18rem; display: flex;">
				  <img v-if="task.cover_pic != null" class="card-img-top" :src="task.cover_pic" alt="No image">
				  <div class="card-body">
				    <h5 class="card-title">{{task.subcontractor.abbreviation}}  {{task.structure.name}}</h5>
				    <p class="card-text">{{task.substructure.name}} - {{task.part.name}} - {{task.percent_complete}}%</p>
				    <p class="card-text">P.Finish: {{task.planned_finish}}</p>
				    <p class="card-text">A.Finish: {{task.actual_finish}}</p>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item">Priority: {{task.priority}}</li>
				    <li class="list-group-item">
				    	<div v-if="task.percent_complete == 100" class="alert alert-success" role="alert">
						  Completed
						</div>
						<div  v-if="task.percent_complete < 100"  class="alert alert-danger" role="alert">
						  In Progress
						</div>
				    </li>
				  </ul>
				  <div class="card-body">
				    <router-link :to="{name: 'taskpictures', params:{id: task.id}}"
                                            class="btn btn-sm btn-primary">
                                            Images
                    </router-link>
				    <router-link :to="{name: 'edit-task', params:{id: task.id}}"
                                            class="btn btn-sm btn-success">
                                            <i class="far fa-edit"></i>
                                        </router-link>
                    <button type="button" name="edit" class="btn btn-primary btn-sm text-white" @click="fetchData(task.id)">Upload pic</button>
				  </div>
				</div>
                <!-- vue pagination https://youtu.be/cuirNvBx8U8 -->
                <jw-pagination :pageSize=8 :items="filterSearch" @changePage="onChangePage" class="m-5"></jw-pagination>
        </div>
        <!-- Start Modal -->
        <div v-if="myModel">
    <transition name="model">
     <div class="modal-mask">
      <div class="modal-wrapper">
       <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
          <h4 class="modal-title">Upload task picture</h4>
          <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
          
          <form class="user" @submit.prevent="coverInsert"
                                        enctype="multipart/form-data">

                                        
                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            @change="onFileSelected">
                                                        <small class="text-danger" v-if="errors.photo">
                                                            {{errors.photo[0]}} </small>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            image</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <img :src="form.photo" style="height: 40px;width: 40px;">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </div>

                                    </form>


         </div>
        </div>
       </div>
      </div>
     </div>
    </transition>
   </div>
        <!-- End Modal -->
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
        this.AllTask();
        axios.get('/api/project').then(({
            data
        }) => {
            this.projects = data
        })
    },

    data() {
        return {
        myModel:false,
        tasks: [],
        taskId: null,
        projects: null,
        project_id: null,
        form: {
            photo: null,
        },
        pageOfItems: [],


        errors: {},
        searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.tasks.filter(task => {
                // return task.structure.name.match(this.searchTerm) && task.project_id === this.project_id
                return task.structure.name.toUpperCase().match(this.searchTerm.toUpperCase())

            })
        }
    },

    methods: {
        // for pagination
        onChangePage(pageOfItems) {
            console.log(pageOfItems)
            // update page of items
            this.pageOfItems = pageOfItems;
        },
        AllTask() {
          //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token

            axios.get('/api/task')
                .then(({
                    data
                }) => {
                    this.tasks = data;
                })
                .catch()

        },
        fetchData(id) {
            // to show Modal
              this.myModel = true;
              this.taskId = id;
        },
        onFileSelected(e) {
            let file = e.target.files[0];
            if (file.size > 6 * 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = e => {
                    this.form.photo = e.target.result

                };
                reader.readAsDataURL(file);

            }

        },
        coverInsert() {
            axios.post('api/task/cover/' + this.taskId, this.form)
                .then((res) => {
                    this.myModel = false;
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },    


        

    }
}
</script>

<style>
#em_photo {
    height: 40px;
    width: 40px;
}
.modal-mask {
     position: fixed;
     z-index: 9998;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, .5);
     display: table;
     transition: opacity .3s ease;
   }

   .modal-wrapper {
     display: table-cell;
     vertical-align: middle;
   }
</style>
