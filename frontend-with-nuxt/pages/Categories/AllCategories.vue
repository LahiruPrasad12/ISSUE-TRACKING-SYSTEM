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
          <p class="title is-1">All Categories</p>
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




      <div v-for="categories in categories"  :key="categories.id" class="item col-xs-4 col-lg-4  " style="margin-bottom: 20px; box-shadow: #1a202c" >

    <div class="card" style="width:400px">
  <header class="card-header" style="text-align: center">
    <p class="subtitle is-4">
      {{categories.name}}
    </p><hr>
    <button class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content">
    <div class="content">
      {{categories.description}}
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
    </div>
  </div>
  <footer class="card-footer">
    <button :id="categories.id" class="card-footer-item" style="color:black; border: none; background:white" @click="viewSubCategory($event)">View</button>
    <button class="card-footer-item"  style=" border: none; background:white" @click="editeteSubCat(categories.id)">Edit</button>
    <button :id="categories.id" class="card-footer-item"  style="color:red;border: none; background:white " @click="confirmCustomDelete(categories.id)">Delete</button>
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
        categories : [],
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
   this.mountains = await this.fetchAllCategories();
   this.categories = this.mountains.data.data;

  },

  methods:{

      async fetchAllCategories(){
         return await this.$axios.get('/category')
      },

    addData(){
        alert(this.name);
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
            await this.$axios.delete('/category/'+categoryID).then(async(res)=>{

             const postion = await this.categories.findIndex(x => x.id === categoryID)

            this.categories.splice(postion,1);
            this.$buefy.toast.open('Account deleted!')
           })
          }


        })
       }catch{
         this.$buefy.toast.open('Something went wrong!')
       }

    },



     viewSubCategory(event){
      this.$router.push('/categories/'+event.target.id);
    },




     editeteSubCat(subCatId){

          try{
            this.$axios.get('/category/'+subCatId).then(async(res)=>{
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



          updateCategory(subCatID){

                  if(this.editecat.name.length === 0){

                    this.AlertMSG = "This name is required";
                    this.worningAlert = true


                  }else if(this.editecat.description.length === 0){

                    this.AlertMSG = "This description is required";
                    this.worningAlert = true

                  }else{

                    this.worningAlert = false
                    this.$buefy.toast.open(`Your data is sending...`)
                    this.$axios.put('/category/'+subCatID, this.editecat).then((res)=>{

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
        }


  }


}
</script>

