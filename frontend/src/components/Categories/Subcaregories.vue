<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <h1>Sub Categories</h1>
          <hr/>
          <div class="btn-group" id="err msg">
            <div class="alert alert-danger" role="alert" v-show="this.state">
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

      <div class="item col-xs-4 col-lg-4 " v-for="Subcategory in Subcategory">
        <div class="thumbnail card">
          <div class="img-event">
          </div>
          <div class="img-event">
            <h3 class="group card-title inner list-group-item-heading">
              {{Subcategory.name}}</h3>
          </div>
          <div class="caption card-body">
            <p class="group inner list-group-item-text"> {{Subcategory.description}} </p>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <!--                <p class="lead">-->
                <!--                  $21.000</p>-->
              </div>
              <div class="btn-group">
                <button class="btn btn-info" id="list" @click="viewIssue($event)" v-bind:id="Subcategory.id" >
                  View Issues
                </button>&emsp;&emsp;&emsp;&emsp;&emsp;
                <button class="btn btn-danger" id="grid" @click="deleteSubategory($event)" v-bind:id="Subcategory.id" v-bind:name="Subcategory.name">
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
  name: "Subcaregories",

  data(){
    return{
      Subcategory:[],
      message : null,
      state : false,
      catName : null,
      number : 0
    }
  },

  created() {
    this.$http.get("http://127.0.0.1:8000/api/Subcategory/render/"+this.$route.params.id).then(function (respond){
      this.Subcategory = respond.body
    })
  },

  methods:{
    viewIssue(event){
      this.state = true;
      this.message="delete "+ '"'+ event.target.name+'"' +" category";
    },

    deleteSubategory(event){
      const x = confirm("Are you sure");

      if(x==true){
        this.$http.delete("http://127.0.0.1:8000/api/subcategory/"+event.target.id).then(function (respond){
          var postion = this.Subcategory.findIndex(function (element){
            return element.id == event.target.id;
          })
          this.Subcategory.splice(postion,1);
          this.state = true;
          this.message="successfully deleted  "+ '"'+ event.target.name+'"' + " category";

        })
      }else {
        this.state = true;
        this.message="canceled delete "+ '"'+ event.target.name+'"' +" category"
      }
    }
  }
}
</script>

<style scoped>

</style>
