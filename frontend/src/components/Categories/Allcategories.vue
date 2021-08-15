<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <h1>All Categories</h1>
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

      <div class="item col-xs-4 col-lg-4  "  v-for="category in category" >
        <div class="thumbnail card text-dark bg-light border border-5 ">
          <div class="img-event">
          </div>
          <div class="img-event">
            <h3 class="group card-title inner list-group-item-heading">
              {{category.name}}</h3>
          </div>
          <div class="caption card-body">
            <p class="group inner list-group-item-text"> {{category.description}} </p>
            <div class="row">
              <div class="col-xs-12 col-md-6">
<!--                <p class="lead">-->
<!--                  $21.000</p>-->
              </div>
              <div class="btn-group " >
                <button class="btn bg-info" id="list" @click="viewSubCategory($event)" v-bind:id="category.id" >
                  View Subcategories
                </button>&emsp;&emsp;&emsp;&emsp;&emsp;
                <button class="btn btn-danger" id="grid" @click="deleteCategory($event)" v-bind:id="category.id" v-bind:name="category.name">
                  Delete
                </button>
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
  name: "Allcategories",


  data(){
    return{
      category:[],
      message : null,
      state : false,
      primarState : false,

    }
  },

  created() {

    try{
      this.$http.get("http://127.0.0.1:8000/api/category").then(function (respond){
        this.category = respond.body.data

        if(this.category.length == 0){
          this.message="No more categories "
          this.state = true;

        }else{
          this.message="Fetched all categories "
          this.primarState = true;
        }
      })

    }catch (err){
      console.log(err)
    }

  },

  methods:{
    deleteCategory(event){

      try{

        const x = confirm("Are you sure");

        if(x==true){
          this.$http.delete("http://127.0.0.1:8000/api/category/"+event.target.id).then(function (respond){
            var postion = this.category.findIndex(function (element){
              return element.id == event.target.id;
            })
            this.category.splice(postion,1);
            this.state = true;
            this.primarState=false;
            this.message="successfully delete "+ '"'+ event.target.name+'"' + " category";

          })
        }else {
          this.state = true;
          this.primarState=false;
          this.message="canceled delete "+ '"'+ event.target.name+'"' +" category"
        }

      }catch (e) {
        console.log(e)
      }

    },

    viewSubCategory(event){
      this.$router.push('/subcategory/'+event.target.id);
    }
  }

}
</script>

<style scoped>

</style>
