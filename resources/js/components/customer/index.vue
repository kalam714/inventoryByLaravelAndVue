<template>
   <div>
       <div class="row">
           <router-link to="/store-customer" class="btn btn-primary">Add customer</router-link>

       </div>
       <br>
       <input type="text" v-model="searchTerm" class="form-control" style="width:300px;" placeholder="Search">
       <br>
               <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">customer Information</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filtersearch" :key="customer.id">
                        <td>{{customer.name}}</td>
                        <td><img :src="customer.photo" width="30px" height="30px"></td>
                        <td>{{customer.phone}}</td>
                        <td>{{customer.email}}</td>
                        <td>
                          <router-link  :to="{name:'edit-customer',params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger">Delete</a>
                           
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
    
     
  
   </div>
</template>
<script>
export default {
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },
  data(){
    return{
      customers:[],
      searchTerm:''

    }
  },
  computed:{
    filtersearch(){
      return  this.customers.filter(customer =>{
        return customer.name.match(this.searchTerm)
      })
    }

  },

  methods:{
    allcustomer(){
      axios.get('/api/customer/')
      .then(({data}) => (this.customers=data))
      .catch()
    },
    deleteCustomer(id){
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
              axios.delete('api/customer/'+id)
              .then(() =>{
                this.customers =this.customers.filter(customer=>{
                return customer.id !=id
                })
              })
              .catch(() =>{
                return $router.push({name:'customer'})
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
                


    }
     
  },
  created(){
    this.allcustomer();
  }
}
</script>
<style scoped>

</style>