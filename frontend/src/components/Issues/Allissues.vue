<template>
  <div class="container">




    <!---This part used display pop up box -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> {{oneIssue.Title}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form>

              <div class="alert alert-primary" role="alert" v-show="this.primarUpdateState" >
                {{this.successMessage}}
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="recipient-name" v-model = "oneIssue.Title" />

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label" ></label>
                <textarea class="form-control" id="message-text" v-model="oneIssue.Body" ></textarea>
              </div>
              <div class="warning" v-show="this.valdateState">{{this.errMessage}}</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteInfo($event)" v-bind:id="oneIssue.id" v-bind:Title = "oneIssue.Title" >Delete</button>
            <button type="button" class="btn btn-primary"  @click="updateInfo($event)" v-bind:name="oneIssue.Title">Update</button>
          </div>
        </div>
      </div>
    </div>








    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <h1>All Issues</h1>
          <hr/>
          <div class="btn-group" id="err msg">

            <div class="alert alert-primary" role="alert" v-show="this.primaryState">
              {{this.successMessage}}
            </div>

            <div class="alert alert-danger" role="alert" v-show="this.primardeleteState">
              {{this.successMessage}}
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

      <div class="item col-xs-4 col-lg-4  "  v-for="issues in issues" >
        <div class="thumbnail card text-dark bg-light border border-5 ">
          <div class="img-event">
          </div>
          <div class="img-event">
            <h3 class="group card-title inner list-group-item-heading">
              {{issues.Title}}</h3>
          </div>
          <div class="caption card-body">
            <p class="group inner list-group-item-text"> {{issues.Body}}</p>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                                <p class="lead">
                                  {{issues.SLUG}}</p>
              </div>
              <div class="btn-group " >

                <button class="btn btn-danger" id="grid" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"  @click="editeIssue($event)" v-bind:id="issues.id" v-bind:name="issues.Title">
                  Edit
                </button>&emsp;&emsp;&emsp;&emsp;&emsp;
                <button class="btn bg-info" id="list" @click="viewComment($event)" v-bind:id="issues.id">
                  View Comments
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
  name: "Allissues",

    data() {
      return {
        issues: [],


        //This variable used to info user by his action
        errMessage : null,
        successMessage: null,
        primaryState :false,
        primarUpdateState : false,
        primardeleteState:false,
        valdateState : false,

        //This variable used to store selected details id
        selectIssue : 0,
        oneIssue : [],
      }
    },

    created() {

    try{
      this.$http.get("http://127.0.0.1:8000/api/issue").then(function (respond){
        console.log(respond.body.data);
        this.issues = respond.body.data;

        if(respond.body.data.length == 0){
          this.successMessage="No more issues ";
          this.primardeleteState=true;
        }else {
          this.successMessage="Fetched all issues ";
          this.primardeleteState=false;
          this.primaryState=true;
        }

      })
    }catch (e) {
      console.log(e)
    }

    },

    methods:{



    //This method used to get one issue data to edit
      editeIssue(event){

        try{
          this.selectIssue = event.target.id;

          this.$http.get("http://127.0.0.1:8000/api/issue/"+this.selectIssue).then(function (respond){
            console.log(respond.body.data);
            this.oneIssue = respond.body.data;
          })
        }catch (err){
          console.log(err)
        }

      },



      //This function used to update issue data
      updateInfo(event){

        try{
          if(this.oneIssue.Title.length == 0){
            this.errMessage = "Title is required"
            this.valdateState = true;

          }else if(this.oneIssue.Body.length == 0) {
            this.errMessage = "Body is required";
            this.valdateState = true;

          }else{
            this.$http.put("http://127.0.0.1:8000/api/issue/"+this.selectIssue,this.oneIssue).then(function (respond){
              this.successMessage="successfully updated  "+ '"'+ this.oneIssue.Title+'"' + " Issue";
              this.primarUpdateState = true;
              this.valdateState = false;
              this.primaryState = false;

            })
          }
        }catch (err){
          console.log(err)
        }

      },



      //This method used to delete issues
      deleteInfo(event){

        try{

          const x = confirm("Are you sure");

          if(x==true){
            this.$http.delete("http://127.0.0.1:8000/api/issue/"+event.target.id).then(function (respond){
              var postion = this.issues.findIndex(function (element){
                return element.id == event.target.id;
              })
              this.issues.splice(postion,1);
              this.primardeleteState = true;
              this.primaryState = false;
              this.successMessage="successfully deleted "+ this.oneIssue.Title+ " category";


            })
          }else {
            this.primardeleteState = true;
            this.primaryState = false;
            this.successMessage="canceled delete "+ '"'+ this.oneIssue.Title+'"' +" category"
          }
        }catch (err){
          console.log(err)
        }

      },


      viewComment(event){
        this.$router.push('/comment/'+event.target.id);
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
