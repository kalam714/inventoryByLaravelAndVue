<template>
    <div>
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Today Total Sell</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{todaysell}}</div>
               
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Income</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{income}}</div>
                    
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todays Due</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$ {{due}}</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                   
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Code</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in products" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td><img :src="product.image" width="30px" height="30px"></td>
                        <td>{{product.product_code}}</td>
                        <td v-if="product.product_quantity >=1"><span class="btn btn-success">Available</span></td>
                        <td v-else=""><span class="btn btn-danger">StockOut</span></td>
                       
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
         
          </div>
          <!--Row-->

        
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
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
      todaysell:'',
      income:'',
      due:'',
      expense:'',
      products:''
    }
  },
  mounted(){
         this.todaySell()
         this.todayIncome()
         this.todayDue()
         this.todayExpense()
         this.stockOut()
  },
  methods:{
    todaySell(){
         axios.get('/api/today/sell')
        .then(({data}) =>(this.todaysell=data))
        .catch()

    },
    todayIncome(){
       axios.get('/api/today/income')
        .then(({data}) =>(this.income=data))
        .catch()
    },
    todayDue(){
       axios.get('/api/today/due')
        .then(({data}) =>(this.due=data))
        .catch()
    },
    todayExpense(){
       axios.get('/api/today/expense')
        .then(({data}) =>(this.expense=data))
        .catch()
    },
    stockOut(){
       axios.get('/api/stockout')
        .then(({data}) =>(this.products=data))
        .catch()
    },
  }
}
</script>
<style scoped>

</style>