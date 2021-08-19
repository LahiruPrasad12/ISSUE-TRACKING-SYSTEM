<template>
<div>



  <!--This part used to diaplay pop up box to edite some details-->
      <!---This part used display pop up box -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="recipient-name" />

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
             
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Update Data</button>
          </div>
        </div>
      </div>
    </div>






  <!--All category retrieve here-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <p class="title is-1">All Categories</p>
          <hr/>
          <div class="btn-group" id="err msg">
            <div class="alert alert-danger" role="alert" v-show="this.state">
              {{this.message}}
            </div>
            <div class="alert alert-primary" role="alert" v-show="this.primarState">
              {{this.message}}
            </div>
<!--            <button class="btn btn-info" id="list">-->
<!--              List View-->
<!--            </button>-->
<!--            <button class="btn btn-danger" id="grid">-->
<!--              Grid View-->
<!--            </button>-->
          </div>
        </div>
      </div>
    </div>
    <div id="products" class="row view-group">




      <div class="item col-xs-4 col-lg-4  "  v-for="categories in categories" v-bind:key="categories.id" style="margin-bottom: 20px; box-shadow: #1a202c" >
        
    <div class="card" style="width:400px">
  <header class="card-header" style="text-align: center">
    <p class="subtitle is-4">
      {{categories.name}}
    </p><hr>
    <button class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content">
    <div class="content">
      {{categories.description}}
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
    </div>
  </div>
  <footer class="card-footer">
    <button class="card-footer-item" style="color:black; border: none; background:white" @click="viewSubCategory($event)" v-bind:id="categories.id">View</button>
    <button class="card-footer-item"  style=" border: none; background:white" >Edit</button>
    <button class="card-footer-item" style="color:red;border: none; background:white "  @click="confirmCustomDelete" v-bind:id="categories.id">Delete</button>
  </footer>
</div>
         
     

      </div>
    </div>
  </div>


</div>
</template>





<script>
export default {

    data(){
      return {
        mountains: [],
        categories : [],
        deletCate : [],
        name : "lahiru",
        message: null,
        state: false,
        primarState: false,
      }
  },
  async mounted() {
   this.mountains = await this.fetchAllCategories();
   this.categories = this.mountains.data.data;
  
  },

  methods:{

      async fetchAllCategories(){
         return await this.$axios.get('/category')
      },

    addData(){
        alert(this.name);
    },


     confirmCustomDelete(event) {

       try{
        this.$buefy.dialog.confirm({
          title: 'Deleting account',
          message: 'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
           onConfirm:async ()=>{
            await this.$axios.delete('/category/'+event.target.id).then(async(res)=>{
             const postion = await this.categories.findIndex(async function (element){
               return element.id === await event.target.id;
            })

            this.categories.splice(postion,1);
            this.$buefy.toast.open('Account deleted!')
           })
          }

         
        })
       }catch{
         this.$buefy.toast.open('Something went wrong!')
       }

    },


   
     viewSubCategory(event){
      this.$router.push('/categories/'+event.target.id);
    }


  }


}
</script>

