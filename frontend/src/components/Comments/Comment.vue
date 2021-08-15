<template>

  <div class="container">



    <!---This part used add specific comment -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabe">Publish Your Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">


                <label for="message-text" class="col-form-label">Comment:</label>
                <textarea class="form-control"  v-model="newComment.Body" ></textarea>
              </div>
              <div class="warning" v-show="this.validateDetails">{{this.message}}</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addComment($event)">Send Data</button>
          </div>
        </div>
      </div>
    </div>







    <!---This part used update specific comment -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Your Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>

              <div class="alert alert-danger" role="alert" v-show="this.upDateState">
                {{this.message}}
              </div>

              <div class="mb-3">


                <label for="message-text" class="col-form-label">Comment:</label>
                <textarea class="form-control" id="message-text" v-model="editeCom.Body" ></textarea>
              </div>
              <div class="warning" v-show="this.validateDetails">{{this.message}}</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" @click="updateComment($event)" v-bind:id="editeCom.id">Update data</button>
          </div>
        </div>
      </div>
    </div>







    <div class="col-lg-12 my-3">
        <div class="pull-right">
          <h1>All Comments</h1>
          <hr/>
          <div class="btn-group" id="err msg">
            <div class="alert alert-danger" role="alert" v-show="this.getState">
              {{this.message}}
            </div>
            <div class="alert alert-primary" role="alert" v-show="this.primarState">
              {{this.message}}
            </div>

          </div>
        </div>
      </div>


    <div class="d-flex flex-row-reverse bd-highlight">
      <button type="button" class="btn btn-dark position-relative"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
        Add Comment <svg width="1em" height="1em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1 bi bi-caret-down-fill" fill="#212529" xmlns="http://www.w3.org/2000/svg"><path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>
      </button>

    </div>


    <div class="row d-flex justify-content-center">

      <div class="w-10 p-2" v-for="comments in comments">
        <div class="shadow-lg p-1 mb-30 bg-body rounded" >

          <p class="fs-2" style="font-family: Abscissa">{{comments.body}}</p>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteComment($event)"  v-bind:id="comments.id">Delete</button>
            <button type="button" class="btn btn-primary"  @click="editeComment($event)" v-bind:id="comments.id" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Edit</button>

          </div>
        </div>

      </div>

    </div>

  </div>









</template>

<script>
export default {
  name: "Comment",

  data(){
    return{
      comments : [],
      editeCom : [],
      newComment : {
        id:'',
        Body:'',
        issue_id:''
      },
      parentId : 0,
      upDateState : false,


      //This variables used to inform user function
      getState : false,
      validateDetails : false,
      message : null,

    }

  },

  created() {

    this.parentId = this.$route.params.id
    this.$http.get("http://127.0.0.1:8000/api/comments/issue/"+this.parentId ).then(function (respond){
      this.comments = respond.body;
      console.log(respond)
      if(this.comments.length == 0){
        this.getState=true;
        this.message = "No more comments"
      }
    })
  },


  methods:{
    addComment(event){

      try {

        if(this.newComment.Body.length == 0){
          this.validateDetails = true;
          this.message = "Body is required"
        }else {
          this.$http.post("http://127.0.0.1:8000/api/comment/"+this.parentId, this.newComment ).then(function (respond){
            this.$router.go();
          })
        }

      }catch (err){
          console.log(err)
      }

    },

    editeComment(event){
      try{

        this.$http.get("http://127.0.0.1:8000/api/comment/"+event.target.id).then(function (respond){
          console.log(respond.body.data)
          this.editeCom=respond.body.data;

        })
      }catch (err){

      }
    },



    updateComment(event){
      try {

          if(this.editeCom.Body.length == 0){
            this.validateDetails=true;
            this.message="comment body is required"
          }else {
            this.$http.put("http://127.0.0.1:8000/api/comment/"+event.target.id, this.editeCom).then(function (respond){
                this.upDateState=true;
                this.validateDetails=false;
                this.message = "comment update successfully"

            })
          }

      }catch (err){

      }
    },



    deleteComment(event){
      try{

        const x = confirm("Are you sure");

        if(x==true){
          this.$http.delete("http://127.0.0.1:8000/api/comment/"+event.target.id).then(function (){

            var postion = this.comments.findIndex(function (element){
              return element.id == event.target.id;
            })

            this.comments.splice(postion,1);

            this.message = "Comment delete successful"
            this.getState = true;

          })
        }else {

          this.message = "canceled comment delete request"
          this.getState = true;
        }

      }catch (e) {
        console.log(e)
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
