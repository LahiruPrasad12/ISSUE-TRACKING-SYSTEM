<template>
<div>


    <section v-show="!showContent">

        <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <p class="title is-1" style="text-align : center"> Edite issue details</p>

          <hr/>
        </div>
      </div>
    </div>



    <div  class="shadow-lg p-3 mb-5 bg-body rounded" style="width:400px; margin-left:570px; padding-left:30px">

      <div style="width:300px; margin-left:30px">


        <b-field label="Name">
            <b-input v-model="editecat.Title"
                type="text"
                value="john@" maxlength="30">
            </b-input>
        </b-field>

        <b-field label="Message">
            <b-input v-model="editecat.Body" maxlength="200" type="textarea"></b-input>
        </b-field>


        <div v-show="worningAlert" class="alert alert-danger" role="alert">
            {{AlertMSG}}
        </div>


          <div class="buttons" style="margin-left:90px">

            <b-button type="is-success" outlined @click="cancelRequest()">Cancel</b-button>
           <b-button type="is-danger" outlined @click="updateCategory(editecat.id)">Update data</b-button>


        </div>



      </div>
    </div>
    </section>





  <!--All category retrieve here-->
  <div v-show="showContent" class="container">
    <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <p class="title is-1">All Issues</p>
          <hr/>

        </div>
      </div>
    </div>
    <div id="products" class="row view-group">




      <div v-for="issue in issues"  :key="issue.id" class="item col-xs-4 col-lg-4  " style="margin-bottom: 20px; box-shadow: #1a202c" >

    <div class="card" style="width:400px; background-color:#C0C0C0">
  <header class="card-header" style="text-align: center">
    <p class="subtitle is-4" style="color: black;">
      <b>{{issue.Title}}</b>
    </p><hr>
    <button class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content" style="color: black;">
    <div class="content">
      {{issue.Body}}
      <br> <br>
      <time class="float-left" datetime="2016-1-1"> {{issue.SLUG}} </time> <b><time class="float-right" datetime="2016-1-1"> User ID :{{issue.UUID}} </time></b>
    </div>
  </div>
  <footer class="card-footer">
    <button class="card-footer-item" style="color:black; border: none; background:white" @click="viewComment(issue.id)">View</button>
    <div class="verticalLine"></div>
    <button class="card-footer-item"  style=" border: none; background:white" @click="editeIssue(issue.id)">Edit</button>
    <div class="verticalLine"></div>
    <button class="card-footer-item"  style="color:red;border: none; background:white " @click="confirmCustomDelete(issue.id)">Delete</button>
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
        issues : [],
        deletCate : [],

     editecat : {
        id : 0,
        name : '',
        description : ''
      },
        name : "lahiru",
        message: null,
        state: false,
        primarState: false,

        showContent : true,
        worningAlert : false,
        AlertMSG : null
      }
  },

    async mounted() {
   this.mountains = await this.fetchAllissue();
    this.issues = this.mountains.data.data
    /* eslint-disable no-console */
   console.log(this.mountains.data.data)



  },


  methods: {
          async fetchAllissue(){
         return await this.$axios.get('/issue')
      },




        confirmCustomDelete(issueID) {

            try{
              this.$buefy.dialog.confirm({
                title: 'Deleting account',
                message: 'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
                confirmText: 'Delete Account',
                type: 'is-danger',
                hasIcon: true,
                onConfirm:async ()=>{
                  await this.$axios.delete('/issue/'+issueID).then(async(res)=>{

                  const postion = await this.issues.findIndex(x => x.id === issueID)

                  this.issues.splice(postion,1);
                  this.$buefy.toast.open('Account deleted!')
                })
                }


              })
            }catch{
              this.$buefy.toast.open('Something went wrong!')
            }

    },


      editeIssue(issueID){

          try{
            this.$axios.get('/issue/'+issueID).then(async(res)=>{
              /* eslint-disable no-console */
                console.log(res.data.data);
                this.editecat = await res.data.data;

                if(this.editecat.length === 0){
                  alert("something going else")

                }else{
                  this.showContent = false
                }

            })
          }catch{

          }

        },




         updateCategory(issueID){

                  if(this.editecat.Title.length === 0){

                    this.AlertMSG = "This name is required";
                    this.worningAlert = true


                  }else if(this.editecat.Body.length === 0){

                    this.AlertMSG = "This description is required";
                    this.worningAlert = true

                  }else{

                    this.worningAlert = false
                    this.$buefy.toast.open(`Your data is sending...`)
                    this.$axios.put('/issue/'+issueID, this.editecat).then((res)=>{

                      if(res.status === 200){
                          this.$buefy.toast.open(`Update success!`)
                      }else{
                        this.$buefy.toast.open(`Something went wrong... plz try again!`)
                      }

                  })
                  }
        },


        cancelRequest(){
          this.$router.go();
        },


        viewComment(issueID){
          this.$router.push('/comments/'+issueID);
       },
  },
}

</script>





<style scoped>
.verticalLine {
        border-left: 4px solid #4b42f5;
        height: fit-content;
      }
</style>
