<template>
    <div>

        <div class="row">
            <router-link to="/store-item" class="btn btn-primary">Add Items</router-link>
        </div>
        <br>
        <input type="text" placeholder="Search ..." class="form-control" style="width: 300px;" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Part</th>
                                    <th>Sub-contractor</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Buying Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in filterSearch" :key="item.id">
                                    <td>{{item.code}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.part}}</td>
                                    <td>{{item.subcontractor}}</td>
                                    <td><img :src="item.image" id="em_photo"></td>
                                    <td>{{item.quantity}}</td>
                                    <td>{{item.buying_date}}</td>
                                    <td>

                                        <router-link :to="{name: 'edit-item', params:{id: item.id}}"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <a @click="deleteItem(item.id)" class="btn btn-sm btn-danger">Delete</a>
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
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: '/'
            })
        }
        this.AllItems();
    },

    data() {
        return {
            items: [],
            errors: {},
            searchTerm: '',
        }
    },
    computed: {
        filterSearch() {
            return this.items.filter(item => {
                return item.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        AllItems() {
            axios.get('/api/item')
                .then(({
                    data
                }) => {
                    this.items = data
                })
                .catch()
        },
        deleteItem(id) {
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

                    axios.delete('/api/item/' + id)
                        .then(() => {
                            this.items = this.items.filter(item => {
                                return item.id != id
                            })

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'item'
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
