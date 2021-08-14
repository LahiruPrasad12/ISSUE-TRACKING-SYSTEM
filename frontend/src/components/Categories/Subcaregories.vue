<template>
  <div class="container">



    <!---This part used display pop up box -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{oneSubCategory.Name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="recipient-name" v-model = "oneSubCategory.Name">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea class="form-control" id="message-text" v-model="oneSubCategory.description">{{oneSubCategory.description}}</textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateData($event)" v-bind:id="oneSubCategory.id" v-bind:name="Subcategory.name">Send message</button>
          </div>
        </div>
      </div>
    </div>







    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <h1>Sub Categories</h1>
          <hr/>
          <div class="btn-group" id="err msg">
            <div class="alert alert-danger" role="alert" v-show="this.state">
              {{this.message}}
            </div>

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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" @click="editeSubCategory($event)" v-bind:id="Subcategory.id" v-bind:name="Subcategory.name">
                  Edit</button>&emsp;&emsp;&emsp;&emsp;&emsp;
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
import Vue from "vue";

export default {
  name: "Subcaregories",

  data(){
    return{
      Subcategory:[],
      oneSubCategory:[],
      message : null,
      state : false,
      catName : null,
      selectedSubCategory : 0,
    }
  },

  created() {
    this.$http.get("http://127.0.0.1:8000/api/Subcategory/render/"+this.$route.params.id).then(function (respond){
      this.Subcategory = respond.body;
    })
  },

  methods:{

    //This method used to get data for update
    editeSubCategory(event){
      this.selectedSubCategory=event.target.id;
      this.$http.get("http://127.0.0.1:8000/api/subcategory/"+event.target.id).then(function (respond){
        console.log(respond)
        this.oneSubCategory=respond.body.data;

      })
    },


    //This method used to delete some sub categories
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
    },


    //This method used to update data
    updateData(event){
      this.$http.put("http://127.0.0.1:8000/api/subcategory/"+this.selectedSubCategory,this.oneSubCategory).then(function (respond){
        this.message="successfully updated  "+ '"'+ this.oneSubCategory.Name+'"' + " category";

        this.$router.go();
      })
    }
  }
}
</script>

<style scoped>

</style>
