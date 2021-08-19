<template>
<div>

  <!--All category retrieve here-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <p class="title is-1">Sub Categories</p>
          <hr/>
          <div id="err msg" class="btn-group">
            <div v-show="state" class="alert alert-danger" role="alert">
              {{message}}
            </div>
            <div v-show="primarState" class="alert alert-primary" role="alert">
              {{message}}
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




      <div v-for="subcat in subcat"  :key="subcat.id" class="item col-xs-4 col-lg-4  " style="margin-bottom: 20px; box-shadow: #1a202c" >

    <div class="card" style="width:400px">
  <header class="card-header" style="text-align: center">
    <p class="subtitle is-4">
      {{subcat.name}}
    </p><hr>
    <button class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content">
    <div class="content">
      {{subcat.description}}
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
    </div>
  </div>
  <footer class="card-footer">
    <button :id="subcat.id" class="card-footer-item" style="color:black; border: none; background:white">View</button>
    <button class="card-footer-item"  style=" border: none; background:white" >Edit</button>
    <button class="card-footer-item" style="color:red;border: none; background:white "  @click="confirmCustomDelete(subcat.id)">Delete</button>
  </footer>
</div>



      </div>
    </div>
  </div>


</div>
</template>





<script>
export default {



  validate({params}){
    return  /^\d+$/.test(params.subcategory);
  },



  data(){
    return{
      slug : this.$route.params,
      subcat : [],
      allSubCat : []
    }
  },


    async fetch(){

      this.allSubCat = await this.fetchAllSubCategories();

      if(this.allSubCat.data.length !== 0){
        this.subcat = this.allSubCat.data
      }else{
        this.alertCustom();
      }


    },

    methods:{

          async fetchAllSubCategories(){
              return await this.$axios.get('Subcategory/render/'+this.$route.params.subcategory);
          },

          alertCustom() {
            this.$buefy.dialog.alert({
                title: 'Title Alert',
                message: '<b>There have no more sub categories </b>, for this main category!',
                confirmText: 'Cool!'
                })
            },



          confirmCustomDelete(categoryID) {

                try{
                  this.$buefy.dialog.confirm({
                    title: 'Deleting account',
                    message: 'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
                    confirmText: 'Delete Account',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm:async ()=>{
                      await this.$axios.delete('/subcategory/'+categoryID).then(async(res)=>{

                      const postion = await this.subcat.findIndex(x => x.id === categoryID)

                      this.subcat.splice(postion,1);
                      this.$buefy.toast.open('Account deleted!')
                      this.$router.go();
                    })
                    }


                  })
                }catch{
                  this.$buefy.toast.open('Something went wrong!')
                }

           },
    }
}
</script>


