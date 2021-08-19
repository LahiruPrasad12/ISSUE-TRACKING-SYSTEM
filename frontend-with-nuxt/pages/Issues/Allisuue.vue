<template>
<div>


    <section v-show="!showContent">

        <div class="row">
      <div class="col-lg-12 my-3">
        <div class="pull-right">
          <p class="title is-1"> Edite category details</p>

          <hr/>
        </div>
      </div>
    </div>



    <div  class="shadow-lg p-3 mb-5 bg-body rounded" style="width:400px; margin-left:500px; padding-left:30px">

      <div style="width:300px; margin-left:30px">


        <b-field label="Name">
            <b-input v-model="editecat.name"
                type="text"
                value="john@" maxlength="30">
            </b-input>
        </b-field>

        <b-field label="Message">
            <b-input v-model="editecat.description" maxlength="200" type="textarea"></b-input>
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

    <div class="card" style="width:400px">
  <header class="card-header" style="text-align: center">
    <p class="subtitle is-4">
      {{issue.Title}}
    </p><hr>
    <button class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content">
    <div class="content">
      {{issue.Body}}
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
    </div>
  </div>
  <footer class="card-footer">
    <button class="card-footer-item" style="color:black; border: none; background:white" @click="viewSubCategory()">View</button>
    <button class="card-footer-item"  style=" border: none; background:white" @click="editeteSubCat()">Edit</button>
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
            alert(issueID)
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
  },
}

</script>
