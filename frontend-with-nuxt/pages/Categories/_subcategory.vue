<template>
<div>

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




      <div class="item col-xs-4 col-lg-4  "  v-for="subcat in subcat" v-bind:key="subcat.id" style="margin-bottom: 20px; box-shadow: #1a202c" >
        
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
    <button class="card-footer-item" style="color:black; border: none; background:white" v-bind:id="subcat.id">View</button>
    <button class="card-footer-item"  style=" border: none; background:white" >Edit</button>
    <button class="card-footer-item" style="color:red;border: none; background:white "  v-bind:id="subcat.id">Delete</button>
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
    }
  },


    created(){
       this.$axios.get('/Subcategory/render/'+this.$route.params.subcategory).then(async function(res){
        console.log(res.data);
        this.subcat = await res.data;
    })
      
    },
}
</script>


