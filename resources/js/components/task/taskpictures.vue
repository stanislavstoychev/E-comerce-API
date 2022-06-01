<template>
	<div>
		
        <div class="row">
            <router-link to="/taskpic" class="btn m-3 btn-primary">Tasks with pictures</router-link>
        </div>
        <br>
        <div class="row">
            <h5 class="card-title text-center">{{task.subcontractor.abbreviation}}  {{task.structure.name}}</h5>
            <section class="text-center">
    				    <p class="card-text">{{task.substructure.name}} - {{task.part.name}} - {{task.percent_complete}}%</p>
                        <p class="card-text" v-if="task.description">Description: {{task.description}}</p>
                        
    				    <p class="card-text">P.Start: {{task.planned_start}}; P.Finish: {{task.planned_finish}}</p>
    				    <p class="card-text">A.Start: {{task.actual_start}}; A.Finish: {{task.actual_finish}}</p>
                        <hr>
            </section>
        </div>
        
        <div class="row">
                
                <div class="card m-2" v-for="taskpicture in task.pics" :key="taskpicture.id" style="width: 18rem; display: flex;">
				  <img class="card-img-top" :src="`/${taskpicture.file}`" alt="Card image cap">
				  <div class="card-body">
				    {{taskpicture.created}}
				  </div>
                  <div class="card-footer">
                    <div class="horisontal-center">
                        <a @click="deletePicture(taskpicture.id)" id="deletePicture" class="btn btn-sm btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
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
        this.AllPics();
    },

  data () {
    return {
    	task: {},
    }
  },
      methods: {
        AllPics() {
          //security token
            let token = localStorage.getItem('token')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            // end security token
            let task_id = this.$route.params.id;
            axios.get(`/api/task/${task_id}/pic`)
                .then(({
                    data
                }) => {
                    this.task = data;
                })
                .catch()

        },
        deletePicture(id) {
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

                    axios.delete('/api/taskpicture/' + id)
                        .then(() => {
                            this.task.pics = this.task.pics.filter(pic => {
                                return pic.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'taskpic'
                            })
                        })



                }
            })
        },
}
}
</script>

<style lang="css" scoped>
.card-footer {
  height: 50px;
  position: relative;
}

.horisontal-center {
  margin: 0;
  position: absolute;
  top: 50%;
  left:50%;
  transform: translate(-50%, -50%);
}

.card-img-top {
    transition: all 1s;
}
.card-img-top:hover {
    transform: scale(1.1);
}

hr {
    border-color: b9b7a7;
    border-width: 3px;
    max-width: 350px;

}
.btn-primary {
    border-radius: 15px;
}
</style>