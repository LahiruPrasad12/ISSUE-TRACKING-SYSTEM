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
                <input type="text" class="form-control" id="recipient-name" v-model = "oneSubCategory.Name" />

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea class="form-control" id="message-text" v-model="oneSubCategory.description"></textarea>
              </div>
              <div class="warning" v-show="this.errMsg">{{this.errMessage}}</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" @click="updateData($event)" v-bind:id="oneSubCategory.id" v-bind:name="Subcategory.name">Update Data</button>
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

      <div class="item col-xs-4 col-lg-4 " v-for="Subcategory in Subcategory" :key="Subcategory">
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
                <button class="btn btn-danger" id="grid" @click="deleteSubategory(Subcategory.id)" v-bind:name="Subcategory.name">
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
      selectedSubCategory : 0,


      //These variable used to occur error msg when user try to submit null value
      errMessage : null,
      errMsg : false,

      //This variable used to inform user by his action showing
      message : null,
      state : false,



    }
  },

  created() {
    this.$http.get("http://127.0.0.1:8000/api/Subcategory/render/"+this.$route.params.id).then(function (respond){
      this.Subcategory = respond.body;

      if(this.Subcategory.length == 0){
        this.state=true;
        this.message = "No more sub categories"
      }
    })
  },

  methods:{

    //This method used to get data for update
    editeSubCategory(event){

      try{
        this.selectedSubCategory=event.target.id;
        this.$http.get("http://127.0.0.1:8000/api/subcategory/"+event.target.id).then(function (respond){
          console.log(respond)
          this.oneSubCategory=respond.body.data;

        })
      }catch (e) {
        console.log(e)
      }

    },





    //This method used to delete some sub categories
    deleteSubategory(id){

      try{
        const x = confirm("Are you sure");

        if(x==true){
          this.$http.delete("http://127.0.0.1:8000/api/subcategory/"+id).then(function (respond){
            var postion = this.Subcategory.findIndex(function (element){
              return element.id == id;
            })
            this.Subcategory.splice(postion,1);
            this.state = true;
            this.message="successfully deleted  "+ '"'+ event.target.name+'"' + " category";

          })
        }else {
          this.state = true;
          this.message="canceled delete "+ '"'+ id+'"' +" category"
        }

      }catch (e) {
        console.log(e)
      }

    },







    //This method used to update data
    updateData(event){


      try{
        if(this.oneSubCategory.Name.length == 0){
          this.errMessage = "name is required";
          this.errMsg=true;


        }else if(this.oneSubCategory.description.length == 0){
          this.errMessage = "description is required";
          this.errMsg=true;


        }else {
          this.$http.put("http://127.0.0.1:8000/api/subcategory/"+this.selectedSubCategory,this.oneSubCategory).then(function (respond){
            this.message="successfully updated  "+ '"'+ this.oneSubCategory.Name+'"' + " category";
            this.$router.go();
          })

        }
      }catch (err){
        console.log(err);
      }


    }
  }
}
</script>

<style scoped>

body{
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
}
.info, .success, .warning, .error, .validation {
  border: 1px solid;
  margin: 10px 0px;
  padding: 15px 10px 15px 50px;
  background-repeat: no-repeat;
  background-position: 10px center;
}
.info {
  color: #00529B;
  background-color: #BDE5F8;
  background-image: url('https://i.imgur.com/ilgqWuX.png');
}
.success {
  color: #4F8A10;
  background-color: #DFF2BF;
  background-image: url('https://i.imgur.com/Q9BGTuy.png');
}
.warning {
  color: #9F6000;
  background-color: #FEEFB3;
  background-image: url('https://i.imgur.com/Z8q7ww7.png');
}
.error{
  color: #D8000C;
  background-color: #FFBABA;
  background-image: url('https://i.imgur.com/GnyDvKN.png');
}
.validation{
  color: #D63301;
  background-color: #FFCCBA;
  background-image: url('https://i.imgur.com/GnyDvKN.png');
}

</style>
